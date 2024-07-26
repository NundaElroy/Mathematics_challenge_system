@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit School</h1>
    <form action="{{ route('schools.update', $school->registration_no) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="registration_number">Registration Number</label>
            <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ $school->registration_no }}" required>
        </div>
        <div class="form-group">
            <label for="name">School Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $school->name }}" required>
        </div>
        <div class="form-group">
            <label for="district">District</label>
            <input type="text" class="form-control" id="district" name="district" value="{{ $school->district }}" required>
        </div>
        <div class="form-group">
            <label for="representative_name">Representative Name</label>
            <input type="text" class="form-control" id="representative_name" name="representative_name" value="{{ $school->representative_name }}" required>
        </div>
        <div class="form-group">
            <label for="representative_email">Representative Email</label>
            <input type="email" class="form-control" id="representative_email" name="representative_email" value="{{ $school->representative_email }}" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg">Update</button>
        </div>
    </div>
    </form>
</div>
@endsection
