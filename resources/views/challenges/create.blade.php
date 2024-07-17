@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-primary text-white" style="border-bottom: 2px solid #ffffff;">
                    <h1 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Add New Challenge</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('challenges.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="opening_date" style="font-weight: bold;">Opening Date</label>
                            <input type="date" class="form-control" id="opening_date" name="opening_date" required>
                        </div>
                        <div class="form-group">
                            <label for="closing_date" style="font-weight: bold;">Closing Date</label>
                            <input type="date" class="form-control" id="closing_date" name="closing_date" required>
                        </div>
                        <div class="form-group">
                            <label for="challenge_name" style="font-weight: bold;">Challenge Name</label>
                            <input type="text" class="form-control" id="challenge_name" name="challenge_name" required>
                        </div>
                        <div class="form-group">
                            <label for="duration" style="font-weight: bold;">Duration</label>
                            <input type="time" class="form-control" id="duration" name="duration" required>
                            <small class="form-text text-muted" style="font-size: 0.9rem; color: #6c757d;">Please enter the duration in HH:MM format (e.g., 01:15 for 1 hour 15 minutes).</small>
                        </div>
                        <div class="form-group">
                            <label for="number_of_questions" style="font-weight: bold;">Number of Questions</label>
                            <input type="number" class="form-control" id="number_of_questions" name="number_of_questions" required min="1">
                            <small class="form-text text-muted" style="font-size: 0.9rem; color: #6c757d;">Enter the total number of questions for the challenge.</small>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 20px; padding: 10px 20px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
