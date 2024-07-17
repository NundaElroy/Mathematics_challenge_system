@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <a href="{{ route('questions.upload-form') }}" class="btn btn-primary">Upload Questions and Answers</a>
    </div>
</div>
@endsection
