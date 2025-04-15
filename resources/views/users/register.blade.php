@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container">
        <h2>Register</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('do_register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mobile_number" class="form-label">Mobile Number (Optional):</label>
                <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}">
                @error('mobile_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="mb-3">
                <label for="security_question" class="form-label">Security Question:</label>
                <input type="text" class="form-control @error('security_question') is-invalid @enderror" name="security_question" required>
                @error('security_question')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="security_answer" class="form-label">Security Answer:</label>
                <input type="text" class="form-control @error('security_answer') is-invalid @enderror" name="security_answer" required>
                @error('security_answer')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
