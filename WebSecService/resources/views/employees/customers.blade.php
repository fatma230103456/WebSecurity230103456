@extends('layouts.app')

@section('content')
    <h1>Manage Customers</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Credit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->credit }}</td>
                    <td>
                        <form action="{{ route('employees.add_credit', $customer) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="number" name="credit" step="0.01" min="0" placeholder="Add Credit" required>
                            <button type="submit" class="btn btn-success">Add Credit</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection