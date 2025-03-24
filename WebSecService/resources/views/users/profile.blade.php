@extends('layouts.app')

@section('content')
    <h1>Profile</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Credit:</strong> ${{ $user->credit }}</p>
    @if ($user->hasRole('Customer'))
        <h2>Purchased Products</h2>
        <ul>
            @foreach ($purchases as $purchase)
                <li>{{ $purchase->product->name }} (Purchased on {{ $purchase->created_at->format('Y-m-d') }})</li>
            @endforeach
        </ul>
    @endif
    <h2>Permissions</h2>
    <ul>
        @foreach ($permissions as $permission)
            <li>{{ $permission->name }}</li>
        @endforeach
    </ul>
    <a href="{{ route('edit', $user) }}" class="btn btn-primary">Edit Profile</a>
    <a href="{{ route('editPassword', $user) }}" class="btn btn-secondary">Change Password</a>
@endsection