<!-- resources/views/pages/schools/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Schools</h1>
    <a href="{{ route('schools.create') }}" class="btn btn-primary">Add New School</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>District</th>
                <th>School Registration Number</th>
                <th>Name of Representative</th>
                <th>Email of Representative</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->id }}</td>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->district }}</td>
                    <td>{{ $school->registration_number }}</td>
                    <td>{{ $school->representative_name }}</td>
                    <td>{{ $school->representative_email }}</td>
                    <td>
                        <a href="{{ route('schools.show', $school->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('schools.destroy', $school->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
