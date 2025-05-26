@extends('layouts.master')

@section('title', 'Even Numbers')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="mb-0">Even Numbers (1-100)</h4>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                @foreach (range(1, 100) as $number)
                    <span class="badge {{ $number % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                        {{ $number }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection