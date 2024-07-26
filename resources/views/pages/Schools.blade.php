@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Schools</h1>
    <a href="{{ route('schools.create') }}" class="btn btn-info mb-3">Add New School</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>School Registration Number</th>
                <th>Name</th>
                <th>District</th>
                <th>Name of Representative</th>
                <th>Email of Representative</th>
                <th>Actions</th>
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

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
    }
    h1 {
        font-family: 'Arial', sans-serif;
        color: #333;
    }
    .table {
        background-color: #fff;
    }
    .table th, .table td {
        vertical-align: middle !important;
    }
    .btn {
        border-radius: 50px;
    }
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn-sm {
        padding: 5px 10px;
    }
</style>
@endsection
