@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row">
        <!-- Profile Information -->
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Profile</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>

                    <hr>

                    <h4 class="mt-4">Change Password</h4>
                    <form action="{{ route('users.update-password', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if(Auth::id() === $user->id)
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Roles and Permissions -->
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">User Information</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Name</h5>
                        <p class="mb-0">{{ $user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Email</h5>
                        <p class="mb-0">{{ $user->email }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Roles</h5>
                        @if($user->role)
                            <span class="badge bg-primary">{{ $user->role->name }}</span>
                        @else
                            <p class="text-muted mb-0">No roles assigned</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <h5>Direct Permissions</h5>
                        @if($user->role && $user->role->permissions->isNotEmpty())
                            @foreach($user->role->permissions as $permission)
                                <span class="badge bg-success me-1">{{ $permission->name }}</span>
                            @endforeach
                        @else
                            <p class="text-muted mb-0">No direct permissions</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
