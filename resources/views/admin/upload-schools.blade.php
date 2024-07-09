@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Upload Schools</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('admin.upload.schools') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="schools_file">Schools File (Excel)</label>
            <input type="file" name="schools_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection