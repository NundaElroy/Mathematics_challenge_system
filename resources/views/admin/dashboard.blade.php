@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.upload.schools') }}" class="btn btn-primary">Upload Schools</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.upload.questions') }}" class="btn btn-primary">Upload Questions and Answers</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.set.competition') }}" class="btn btn-primary">Set Competition Parameters</a>
        </div>
    </div>
</div>
@endsection
