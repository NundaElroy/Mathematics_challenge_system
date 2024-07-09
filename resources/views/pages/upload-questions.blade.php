@extends('layouts.app', ['activePage' => 'question', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'Upload Question', 'activeButton' => 'laravel'])


@section('content')
<div class="container">
    <h1>Upload Questions and Answers</h1>
    <form action="{{ route('admin.upload.questions') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="questions_file">Questions File (Excel)</label>
            <input type="file" name="questions_file" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="answers_file">Answers File (Excel)</label>
            <input type="file" name="answers_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
<li> 
                <a href=" {{ route('admin.upload.questions')}}">
                <li>
@endsection