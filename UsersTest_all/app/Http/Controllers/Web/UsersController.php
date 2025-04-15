<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role as SpatieRole;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Auth::user()->canViewUsers()) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function viewProfile(User $user)
    {
        // Check if user can view other profiles
        if (!Auth::user()->canViewUsers() && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('users.profile', compact('user'));
    }

    public function edit(User $user)
    {
        // Check if user is trying to edit their own profile or has permission to edit others
        if (!Auth::user()->canEditUsers() && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $roles = SpatieRole::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        
        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        // Check if user is trying to edit their own profile or has permission to edit others
        if (!Auth::user()->canEditUsers() && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ];

        // Only admin and employee can change roles
        if (Auth::user()->canEditUsers()) {
            $rules['roles'] = ['array'];
        }

        $validatedData = $request->validate($rules);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Only admin and employee can change roles
        if (Auth::user()->canEditUsers() && isset($validatedData['roles'])) {
            $user->syncRoles($validatedData['roles']);
        }

        return redirect()->route('users.edit', $user)
            ->with('success', 'User updated successfully');
    }

    public function delete(User $user)
    {
        if (!Auth::user()->canDeleteUsers()) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    use ValidatesRequests;

    public function register(Request $request) {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('users.register');
    }

    public function doRegister(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        
        try {
            // Attempt to assign default role (normal user)
            $defaultRole = Role::where('slug', 'user')->first();
            if ($defaultRole) {
                $user->role_id = $defaultRole->id;
            }
        } catch (\Exception $e) {
            // If roles table doesn't exist yet, continue without setting role
            \Log::warning('Could not assign default role: ' . $e->getMessage());
        }
        
        $user->save();

        Auth::login($user);
        return redirect("/");
    }

    public function login(Request $request) {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('users.login');
    }

    public function doLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function doLogout(Request $request) {
        Auth::logout();
            return redirect("/");
    }

    public function updatePassword(Request $request, User $user)
    {
        // Check if user is changing their own password or has permission to change others
        if (!Auth::user()->canChangePassword() && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'current_password' => ['required_if:user_id,' . Auth::id()],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // If user is changing their own password, verify current password
        if (Auth::id() === $user->id) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.edit', $user)
            ->with('success', 'Password updated successfully');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string'
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
    
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    public function save(Request $request, ?User $user = null)
    {
        // If no user is provided, we're creating a new one
        $isNew = is_null($user);
        
        // Validate the request data
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($user ? $user->id : 'NULL'),
        ];

        // Only require password for new users
        if ($isNew) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        // Only admin can set role_id
        if (Auth::user()->canEditUsers()) {
            $rules['role_id'] = 'required|exists:roles,id';
        }

        $validatedData = $request->validate($rules);

        // If creating a new user
        if ($isNew) {
            $user = new User();
            $user->password = Hash::make($validatedData['password']);
        }

        // Update user data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Only update role_id if user has permission
        if (Auth::user()->canEditUsers() && isset($validatedData['role_id'])) {
            $user->role_id = $validatedData['role_id'];
        }

        $user->save();

        $message = $isNew ? 'User created successfully' : 'User updated successfully';
        return redirect()->route('users.profile', $user)->with('success', $message);
    }
}