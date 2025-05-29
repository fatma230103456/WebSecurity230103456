<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
abstract 
class 
Controller extends \Illuminate\Routing\Controller{}
 
class UsersController extends Controller {
    public function register(Request $request) {
        return view('users.register');
    }
    public function doRegister(Request $request) {
        return redirect('/');
    }
    public function login(Request $request) {
        return view('users.login');
    }
    public function doLogin(Request $request) {
        return redirect('/');
    }
    public function doLogout(Request $request) {
        return redirect('/');
    }
 }
