<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UsersController::class, 'register'])->name('register');
Route::post('/register', [UsersController::class, 'doRegister'])->name('do_register');
Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login', [UsersController::class, 'doLogin'])->name('do_login');
Route::get('/logout', [UsersController::class, 'doLogout'])->name('do_logout');
Route::get('/users', [UsersController::class, 'list'])->name('users');
Route::get('/profile/{user?}', [UsersController::class, 'profile'])->name('profile');
Route::get('/customer-profile', [UsersController::class, 'customerProfile'])->name('customer_profile');
Route::get('/users/edit/{user?}', [UsersController::class, 'edit'])->name('users_edit');
Route::post('/users/edit/{user?}', [UsersController::class, 'doEdit'])->name('users_do_edit');
Route::get('/users/edit_password/{user?}', [UsersController::class, 'editPassword'])->name('users_edit_password');
Route::post('/users/edit_password/{user?}', [UsersController::class, 'doEditPassword'])->name('users_do_edit_password');
Route::get('/users/delete/{user}', [UsersController::class, 'delete'])->name('users_delete');

Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::post('/products/{product}/buy', [ProductsController::class, 'buy'])->name('products.buy');

Route::get('/employees/customers', [EmployeesController::class, 'customers'])->name('employees.customers');

Route::get('/admin/create-employee', [AdminController::class, 'createEmployee'])->name('admin.create_employee');
Route::post('/admin/create-employee', [AdminController::class, 'storeEmployee'])->name('admin.store_employee');

// WebSecTest routes
Route::get('/multable', function () { return view('multable'); });
Route::get('/even', function () { return view('even'); });
Route::get('/prime', function () { return view('prime'); });
Route::get('/test', function () { return view('test'); });