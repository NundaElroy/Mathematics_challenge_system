@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Analytics</h1>

            <h3>Most Correctly Answered Questions</h3>
            <ul>
                @foreach($mostCorrectlyAnsweredQuestions as $question)
                    <li>{{ $question->text }} - {{ $question->correct_answers_count }} correct answers</li>
                @endforeach
            </ul>

            <h3>School Rankings</h3>
            <ul>
                @foreach($schoolRankings as $school)
                    <li>{{ $school->name }} - Average Score: {{ $school->participants->avg('score') }}</li>
                @endforeach
            </ul>

            <h3>Performance Over Years</h3>
            <ul>
                @foreach($performanceOverYears as $data)
                    <li>Year: {{ $data->year }} - Average Score: {{ $data->average_score }}</li>
                @endforeach
            </ul>

            <h3>Best Performing Schools</h3>
            <ul>
                @foreach($bestPerformingSchools as $school)
                    <li>{{ $school->name }} - Average Score: {{ $school->participants->avg('score') }}</li>
                @endforeach
            </ul>

            <h3>Worst Performing Schools</h3>
            <ul>
                @foreach($worstPerformingSchools as $school)
                    <li>{{ $school->name }} - Average Score: {{ $school->participants->avg('score') }}</li>
                @endforeach
            </ul>

            <h3>Participants with Incomplete Challenges</h3>
            <ul>
                @foreach($incompleteChallenges as $participant)
                    <li>{{ $participant->name }} - School: {{ $participant->school->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

