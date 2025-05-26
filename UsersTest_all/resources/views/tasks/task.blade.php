@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">My To-Do List</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Add a new task..." required>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </div>
        @error('name')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </form>
    @if ($tasks->isEmpty())
        <p class="text-center">No tasks yet. Add one above!</p>
    @else
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="{{ $task->status ? 'text-decoration-line-through text-muted' : '' }}">
                        {{ $task->name }}
                    </span>
                    @if (!$task->status)
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Complete</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection