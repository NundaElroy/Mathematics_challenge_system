@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics'])

@section('content')
<div class="container">
    <!--<div class="row">
        <div class="col-md-12">-->
            <h1>Analytics</h1>

            <!--<h3>School Rankings</h3>
            <ul>
                @foreach($schoolRankings as $school)
                    <li>{{ $school->name }} - Average Score: {{ $school->participants->avg('score') }}</li>
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
-->
            
      <!--  </div>
    </div>-->
    <h2>Most Correctly Answered Questions</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Question ID</th>
                <th>Question Text</th>
                <th>Correct Answers</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->question_text }}</td>
                <td>{{ $question->correct_answers }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

