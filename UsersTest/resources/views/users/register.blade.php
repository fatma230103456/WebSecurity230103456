@extends('layouts.master')

@section('title', 'Register')

@section('content')

<div class="container">
<form action="{{route('do_register')}}" method="post">
  {{ csrf_field() }}
  <div class="form-group mb-2">
    <label for="code" class="form-label">Name:</label>
    <input type="text" class="form-control" placeholder="name" name="name" required>
  </div>
  <div class="form-group mb-2">
    <label for="model" class="form-label">Email:</label>
    <input type="email" class="form-control" placeholder="email" name="email" required>
  </div>
  <div class="form-group mb-2">
    <label for="model" class="form-label">Password:</label>
    <input type="password" class="form-control" placeholder="password" name="password" required>
  </div>
  <div class="form-group mb-2">
    <label for="model" class="form-label">Password Confirmation:</label>
    <input type="password" class="form-control" placeholder="Confirmation" name="password_confirmation" required>
  </div>
  <div class="form-group mb-2">
    <button type="submit" class="btn btn-primary">Register</button>
  </div>
    @if(request()->error)
    <div class="alert alert-danger">
        <strong> Error!</strong> {{request()->error}}
    </div>
    @endif
 </form>
</div>
@endsection