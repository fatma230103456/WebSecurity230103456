@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Welcome to Laravel Exercises</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Math Exercises -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">Math Exercises</h5>
                            <div class="list-group">
                                <a href="{{ url('/multable') }}" class="list-group-item list-group-item-action">Multiplication Table</a>
                                <a href="{{ url('/even') }}" class="list-group-item list-group-item-action">Even Numbers</a>
                                <a href="{{ url('/prime') }}" class="list-group-item list-group-item-action">Prime Numbers</a>
                                <a href="{{ url('/Calculator') }}" class="list-group-item list-group-item-action">Calculator</a>
                            </div>
                        </div>

                        <!-- Data Display -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">Data Display</h5>
                            <div class="list-group">
                                <a href="{{ url('/bill') }}" class="list-group-item list-group-item-action">Bill Display</a>
                                <a href="{{ url('/Transcript') }}" class="list-group-item list-group-item-action">Transcript</a>
                                <a href="{{ url('/Products') }}" class="list-group-item list-group-item-action">Products</a>
                                <a href="{{ route('products_list') }}" class="list-group-item list-group-item-action">Products List</a>
                            </div>
                        </div>

                        <!-- User Management -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">User Management</h5>
                            <div class="list-group">
                                @auth
                                    <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">My Profile</a>
                                    @if(auth()->user()->canEditUsers())
                                        <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">Manage Users</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="list-group-item list-group-item-action">Login</a>
                                    <a href="{{ route('register') }}" class="list-group-item list-group-item-action">Register</a>
                                @endauth
                            </div>
                        </div>

                        <!-- Academic Features -->
                        <div class="col-md-4 mb-4">
                            <h5 class="mb-3">Academic Features</h5>
                            <div class="list-group">
                                <a href="{{ route('questions_list') }}" class="list-group-item list-group-item-action">Questions</a>
                                <a href="{{ route('questions_exam') }}" class="list-group-item list-group-item-action">Take Exam</a>
                                <a href="{{ route('grades_list') }}" class="list-group-item list-group-item-action">Grades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 