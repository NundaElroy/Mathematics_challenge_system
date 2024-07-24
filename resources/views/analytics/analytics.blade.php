@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics'])

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Analytics Overview</h1>
    <ul class="nav nav-tabs" id="analyticsTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Most Correct Answers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">School Rankings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Worst Performing Schools</a>
        </li>
    </ul>
    <div class="tab-content mt-3" id="analyticsTabsContent">
        <!-- Tab 1 Content -->
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
            @if (!empty($groupedByChallenge))
                @foreach($groupedByChallenge as $challenge)
                    <h2 class="mt-4">Challenge ID: {{ $challenge->challengeId }}</h2>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Question ID</th>
                                <th>Question Text</th>
                                <th>Total Correct</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groupedByChallenge as $question)
                                <tr>
                                    <td>{{ $question->questionid }}</td>
                                    <td>{{ $question->question_text }}</td>
                                    <td>{{ $question->total_correct }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            @else
                <p>No data available for this challenge.</p>
            @endif
        </div>

        <!-- Tab 2 Content -->
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
            <h2 class="mt-4">School Rankings</h2>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Registration No</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Average Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schoolRankings as $ranking)
                        <tr>
                            <td>{{ $ranking->registration_no }}</td>
                            <td>{{ $ranking->name }}</td>
                            <td>{{ $ranking->district }}</td>
                            <td>{{ number_format($ranking->average_score, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tab 3 Content -->
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
            <h2 class="mt-4">Worst Per Challenge</h2>
            @foreach($worstPerformingSchools->groupBy('challengeId') as $challengeId => $schools)
                <h3 class="mt-4">Challenge ID: {{ $challengeId }}</h3>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Registration No</th>
                            <th>Name</th>
                            <th>District</th>
                            <th>Average Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools->take(3) as $school) <!-- Take top 3 worst performers -->
                            <tr>
                                <td>{{ $school->registration_no }}</td>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->district }}</td>
                                <td>{{ number_format($school->average_score, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>

      <!-- Tab 4 Content -->
      <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
            <h2 class="mt-4">Best Per Challenge</h2>
            @foreach($bestPerformingSchools->groupBy('challengeId') as $challengeId => $schools)
                <h3 class="mt-4">Challenge ID: {{ $challengeId }}</h3>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Registration No</th>
                            <th>Name</th>
                            <th>District</th>
                            <th>Average Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools->take(3) as $school) <!-- Take top 3 best performers -->
                            <tr>
                                <td>{{ $school->registration_no }}</td>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->district }}</td>
                                <td>{{ number_format($school->average_score, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>

    </div>
</div>
@endsection
