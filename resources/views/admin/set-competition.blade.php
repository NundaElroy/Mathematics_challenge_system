@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Set Competition Parameters</h1>
    <form action="{{ route('admin.set.competition') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="duration">Duration (minutes)</label>
            <input type="number" name="duration" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="question_count">Number of Questions</label>
            <input type="number" name="question_count" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Set Competition</button>
    </form>
</div>
@endsection