@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Schools</h1>
    <a href="{{ route('schools.create') }}" class="btn btn-info">Add New School</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th><b>School Registration Number</b></th>
                <th><b>School Name</b></th>
                <th><b>District</b></th>
                <th><b>Name of Representative</b></th>
                <th><b>Email of Representative</b></th>
                <th><B>Actions</B></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->registration_no }}</td>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->district }}</td>
                    <td>{{ $school->representative_name }}</td>
                    <td>{{ $school->representative_email }}</td>
                    <td>
                        <a href="{{ route('schools.show', $school->registration_no) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('schools.edit', $school->registration_no) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('schools.destroy', $school->registration_no) }}" method="POST" style="display:inline;">
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
