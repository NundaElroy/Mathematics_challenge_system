@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h1>Add New School</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('schools.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">School Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" class="form-control" id="district" name="district" value="{{ old('district') }}" required>
                            @error('district')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="registration_number">School Registration Number</label>
                            <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number') }}" required>
                            @error('registration_number')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="representative_name">Name of Representative</label>
                            <input type="text" class="form-control" id="representative_name" name="representative_name" value="{{ old('representative_name') }}" required>
                            @error('representative_name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="representative_email">Email of Representative</label>
                            <input type="email" class="form-control" id="representative_email" name="representative_email" value="{{ old('representative_email') }}" required>
                            @error('representative_email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Add School</button>
                            <a href="{{ route('schools.index') }}" class="btn btn-secondary btn-lg">Back to List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
