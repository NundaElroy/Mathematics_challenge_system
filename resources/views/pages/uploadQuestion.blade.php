@extends('layouts.app', ['activePage' => 'question', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'Upload Question', 'activeButton' => 'laravel'])


@section('content')
    <h1>Ask a Question</h1>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
        <label for="body">Body:</label>
        <textarea name="body" id="body"></textarea>
        <button type="submit">Submit</button>
    </form>
@endsection
