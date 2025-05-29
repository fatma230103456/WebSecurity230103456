<?php

namespace App\Http\Controllers\Web;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    // List all users (with optional filtering)
    public function list(Request $request)
    {
        // Start the query
        $query = User::query();

        // Filter by name
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filter by email
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        // Filter by role
        if ($request->has('role')) {
            $query->where('role', $request->input('role'));
        }

        // Get the filtered users
        $users = $query->get();

        // Pass the filters to the view
        $filters = $request->only(['name', 'email', 'role']);

        return view("users.list", compact('users', 'filters'));
    }

    // Show the form to create/edit a user
    public function edit(Request $request, User $user = null)
    {
        $user = $user ?? new User();
        return view("users.edit", compact('user'));
    }

    // Save a user (create or update)
    public function save(Request $request, User $user = null)
    {
        $user = $user ?? new User();
        $user->fill($request->all());
        $user->save();
        return redirect()->route('users_list');
    }

    // Delete a user
    public function delete(Request $request, User $user)
    {
        $user->delete();
        return redirect()->route('users_list');
    }

    use ValidatesRequests;

    public function register(Request $request) {
        return view('users.register');
    }



    public function doRegister(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->save();
        return redirect("/");
     }

     public function login(Request $request) {
        return view('users.login');
    }

    public function doLogin(Request $request) {
        if(!Auth::attempt(['email'=> $request->email,'password'=> $request->password])) {
            return redirect()->back()->withInput($request->input())->withErrors('Invalid login information.');
        }
            $user = User::where('email', $request->email)->first();
        Auth::setUser($user);
        return redirect("/");
    }

    public function doLogout(Request $request) {
        Auth::logout();
            return redirect("/");
    }
}
