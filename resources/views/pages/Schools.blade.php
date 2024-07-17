@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-12">
            <h1 class="mb-4" style="font-size: 2.5rem; font-weight: 600; color: #333333;">Schools</h1>
            <a href="{{ route('schools.create') }}" class="btn btn-primary btn-lg" style="background-color: #28a745; border-color: #28a745; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">Add New School</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover" style="background-color: #f8f9fa; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <thead class="bg-dark text-white" style="font-size: 1.1rem;">
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
                            <a href="{{ route('schools.show', $school->id) }}" class="btn btn-info btn-sm" style="background-color: #17a2b8; border-color: #17a2b8; color: #ffffff;">View</a>
                            <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-warning btn-sm" style="background-color: #fd7e14; border-color: #fd7e14; color: #ffffff;">Edit</a>
                            <form action="{{ route('schools.destroy', $school->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this school? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="background-color: #dc3545; border-color: #dc3545; color: #ffffff;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
