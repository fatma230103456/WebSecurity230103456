<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller {

    public function __construct()
    {
        // Only apply auth middleware to protected routes
        $this->middleware('auth')->except(['register', 'doRegister', 'login', 'doLogin', 'forgotPassword', 'verifySecurityAnswer', 'resetPassword']);
        
        // Apply role-based middleware to specific routes
        $this->middleware('user.access:view_profile')->only(['show', 'profile']);
        $this->middleware('user.access:edit_profile')->only(['edit', 'update']);
        $this->middleware('user.access:edit_users')->only(['index', 'destroy']);
    }

    public function register() {
        return view('users.register');
    }

    public function doRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'nullable|string|max:20',
            'password' => 'required|confirmed|min:6',
            'security_question' => 'required|string',
            'security_answer' => 'required|string|min:3',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->password = bcrypt($request->password);
        $user->security_question = $request->security_question;
        $user->security_answer = $request->security_answer; // Store as plain text for verification
        $user->admin = 0;
        $user->save();
    
        // Assign Customer role to the new user
        $customerRole = Role::where('name', 'Customer')->first();
        if ($customerRole) {
            $user->roles()->attach($customerRole->id);
        }
    
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
    
    public function login() {
        return view('users.login');
    }

    public function doLogin(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors('Invalid login information.');
        }

        $user = Auth::user();

        // Check if user is using a temporary password
        if ($user->is_temporary_password) {
            return redirect()->route('password.change')->with('warning', 'Please change your temporary password.');
        }

        return redirect()->route('home');
    }

    public function doLogout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function show(User $user) {
        return view('users.show', compact('user'));
    }

    public function destroy(User $user) {
        if (Auth::user()->id === $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function forgotPassword() {
        return view('users.forgot_password');
    }

    public function verifySecurityAnswer(Request $request) {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found.');
        }

        return view('users.verify_security_answer', compact('user'));
    }

    public function resetPassword(User $user) {
        return view('users.reset_password', compact('user'));
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('profile', $user->id)->with('success', 'Password updated successfully!');
    }

    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function profile(User $user) {
        return view('users.profile', compact('user'));
    }
    
    public function changePassword() {
        return view('users.change_password');
    }
}
