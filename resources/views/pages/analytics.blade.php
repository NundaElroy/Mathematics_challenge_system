@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics'])


@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Analytics Overview</h1>
    <ul class="nav nav-tabs" id="analyticsTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Most Correct Answers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Another Analytics</a>
        </li>
        <!-- Add more tabs as needed -->
    </ul>
    <div class="tab-content mt-3" id="analyticsTabsContent">
        <!-- Tab 1 Content -->
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
            @foreach($groupedByChallenge as $challengeId => $questions)
                <h2 class="mt-4">Challenge ID: {{ $challengeId }}</h2>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Question ID</th>
                            <th>Question Text</th>
                            <th>Total Correct</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{ $question->questionid }}</td>
                                <td>{{ $question->question_text }}</td>
                                <td>{{ $question->total_correct }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>

        <!-- Tab 2 Content -->
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
            <!-- Content for "Another Analytics" -->
            <p>No data available for this section yet.</p>
        </div>

        <!-- Add more tab panes as needed -->
    </div>
</div>
@endsection

@push('styles')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endpush
