@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Schools</h1>
    <a href="{{ route('schools.create') }}" class="btn btn-info">Add New School</a>
    <table class="table table-bordered table-striped table-hover mt-3 bg-white rounded shadow-sm">
     <!--<thead style="background-color:darkturquoise; color: #007bff;">-->
    <thead style="background-color:#17a2b8;color:black;"> 
        <tr>
            <th><b>RegNo.</b></th>
            <th><b>School Name</b></th>
            <th><b>District</b></th>
            <th><b>Rep Name</b></th>
            <th><b>Rep Email</b></th>
            <th><b>Actions</b></th>
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
                    <form action="{{ route('schools.destroy', $school->registration_no) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this school?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@push('css')
    <style>
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }
    </style>
@endpush

</div>
@endsection
