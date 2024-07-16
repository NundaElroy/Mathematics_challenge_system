@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Analytics Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('analytics.most_correct_questions') }}" class="btn btn-primary">Most Correctly Answered Questions</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('analytics.school_rankings') }}" class="btn btn-primary">School Rankings</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('analytics.performance_over_time') }}" class="btn btn-primary">Performance Over Time</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('analytics.repetition_percentage') }}" class="btn btn-primary">Repetition Percentage</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('analytics.worst_performing_schools') }}" class="btn btn-primary">Worst Performing Schools</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('analytics.best_performing_schools') }}" class="btn btn-primary">Best Performing Schools</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('analytics.incomplete_challenges') }}" class="btn btn-primary">Incomplete Challenges</a>
        </div>
    </div>
</div>
@endsection
