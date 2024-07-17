@extends('layouts.app')

@section('content')
<div class="container">
    <h1>School Details</h1>
    <div class="card">
        <div class="card-header">
            School regNo: {{ $school->registration_no}}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $school->name }}</h5>
            <p class="card-text">District: {{ $school->district }}</p>
            <p class="card-text">Name of Representative: {{ $school->name_of_representative }}</p>
            <p class="card-text">Email of Representative: {{ $school->email_of_representative }}</p>
            <a href="{{ route('schools.edit', $school->registration_no) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('schools.destroy', $school->registration_no) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
