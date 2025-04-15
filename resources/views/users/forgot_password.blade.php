@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <div class="container">
        <h2>Reset Password</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('password.reset.send') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="use_temp_password" id="use_temp_password">
                    <label class="form-check-label" for="use_temp_password">
                        Send me a temporary password instead of a reset link
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Send Reset Instructions</button>
        </form>

        <div class="mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
        </div>
    </div>
@endsection
