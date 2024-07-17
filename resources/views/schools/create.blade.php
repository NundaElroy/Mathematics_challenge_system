

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add School</h1>
    <form action="{{ route('schools.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="registration_no">Registration Number</label>
            <input type="text" class="form-control" id="registration_no" name="registration_no" required>
        </div>
        <div class="form-group">
            <label for="name">School Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="district">District</label>
            <input type="text" class="form-control" id="district" name="district" required>
        </div>
        <div class="form-group">
            <label for="representative_name">Representative Name</label>
            <input type="text" class="form-control" id="representative_name" name="representative_name" required>
        </div>
        <div class="form-group">
            <label for="representative_email">Representative Email</label>
            <input type="email" class="form-control" id="representative_email" name="representative_email" required>
        </div>
        <button type="submit" class="btn btn-info">Add School</button>
    </form>
</div>
@endsection
