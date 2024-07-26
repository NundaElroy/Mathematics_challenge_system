@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h1>School Details</h1>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">School Name:</dt>
                        <dd class="col-sm-8">{{ $school->name }}</dd>

                        <dt class="col-sm-4">District:</dt>
                        <dd class="col-sm-8">{{ $school->district }}</dd>

                        <dt class="col-sm-4">School Registration Number:</dt>
                        <dd class="col-sm-8">{{ $school->registration_no }}</dd>

                        <dt class="col-sm-4">Name of Representative:</dt>
                        <dd class="col-sm-8">{{ $school->representative_name }}</dd>

                        <dt class="col-sm-4">Email of Representative:</dt>
                        <dd class="col-sm-8">{{ $school->representative_email }}</dd>
                    </dl>
                    <div class="text-center">
                        <a href="{{ route('schools.edit', $school->registration_no) }}" class="btn btn-warning btn-lg">Edit</a>
                        <a href="{{ route('schools.index') }}" class="btn btn-secondary btn-lg">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
