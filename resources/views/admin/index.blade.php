<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <!-- Form to upload schools -->
    <form action="{{ route('admin.uploadSchools') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="schools_file" required>
        <button type="submit">Upload Schools</button>
    </form>

    <!-- Form to upload questions -->
    <form action="{{ route('admin.uploadQuestions') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="questions_file" required>
        <input type="file" name="answers_file" required>
        <button type="submit">Upload Questions</button>
    </form>

    <!-- Form to set competition parameters -->
    <form action="{{ route('admin.setCompetition') }}" method="POST">
        @csrf
        <input type="datetime-local" name="start_date" required>
        <input type="datetime-local" name="end_date" required>
        <input type="number" name="duration" required>
        <button type="submit">Set Competition</button>
    </form>
</div>
@endsection