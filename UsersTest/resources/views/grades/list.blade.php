@extends('layouts.master')

@section('title', 'Grades List')

@section('content')
<div class="container">
    <h1>Grades List</h1>
    <a href="{{ route('grades_edit') }}" class="btn btn-success mb-3">Add Grade</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Course ID</th>
                <th>Grade</th>
                <th>Term</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>{{ $grade->id }}</td>
                    <td>{{ $grade->student_id }}</td>
                    <td>{{ $grade->course_id }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{{ $grade->term }}</td>
                    <td>
                        <a href="{{ route('grades_edit', $grade->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('grades_delete', $grade->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection