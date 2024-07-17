@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h1>Edit School</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('schools.update', $school->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">School Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $school->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" class="form-control" id="district" name="district" value="{{ $school->district }}" required>
                        </div>
                        <div class="form-group">
                            <label for="registration_number">School Registration Number</label>
                            <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ $school->registration_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="representative_name">Name of Representative</label>
                            <input type="text" class="form-control" id="representative_name" name="representative_name" value="{{ $school->representative_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="representative_email">Email of Representative</label>
                            <input type="email" class="form-control" id="representative_email" name="representative_email" value="{{ $school->representative_email }}" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg">Update School</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
