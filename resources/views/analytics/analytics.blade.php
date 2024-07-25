@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Analytics'])

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Analytics Overview</h1>
        <ul class="nav nav-tabs" id="analyticsTabs" role="tablist" style = " margin-bottom: 5px;">
            <li class="nav-item nav-item-spaced" style = " margin-right: 8px;  margin-bottom: 5px;">
                <a class="nav-link active bg-info text-white" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Top Performers</a>
            </li>
            <li class="nav-item nav-item-spaced"  style = " margin-right: 8px;  margin-bottom: 5px;">
                <a class="nav-link bg-info text-white" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">School Rankings</a>
            </li>
            <li class="nav-item nav-item-spaced" style = " margin-right: 8px;  margin-bottom: 5px;">
                <a class="nav-link bg-info text-white" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Worst Performing Schools</a>
            </li>
            <li class="nav-item nav-item-spaced" style = " margin-right: 8px;  margin-bottom: 5px;">
                <a class="nav-link bg-info text-white" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Best Performing Schools</a>
            </li>
            <li class="nav-item nav-item-spaced" style = " margin-right: 8px;  margin-bottom: 5px;">
                <a class="nav-link bg-info text-white" id="tab5-tab" data-toggle="tab" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Performance Over Years</a>
            </li>
            <li class="nav-item nav-item-spaced" style = " margin-right: 8px;  margin-bottom: 5px;">
                <a class="nav-link bg-info text-white" id="tab6-tab" data-toggle="tab" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false"> Most Correctly Answered</a>
            </li>
        </ul>
        <div class="tab-content mt-3" id="analyticsTabsContent">
            <!-- Tab 1 Content -->
<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
    <h2 class="mt-4">Top Winners</h2>
    @foreach($topWinners as $challengeId => $winners)
        <h3 class="mt-4">Challenge ID: {{ $challengeId }}</h3>
        <table class="table table-bordered mt-2">
            <thead class="bg-dark text-white" style="font-size: 1.1rem;">
                <tr>
                    <th>Image</th>
                    <th>Full Name</th>
                    <th>School Name</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($winners->take(2) as $winner) <!-- Show top 2 winners -->
                    <tr>
                        <td>
                            <img src="data:image/jpeg;base64,{{ base64_encode($winner->image) }}" alt="Image" style="width: 50px; height: 50px;" />
                            
                            <!-- $winner->image -->
                        </td>
                        <td>{{ $winner->fullname }}</td>
                        <td>{{ $winner->school_name }}</td>
                        <td>{{ $winner->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>


            <!-- Tab 2 Content -->
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
            <h2 class="mt-4">School Rankings</h2>
            <table class="table table-bordered mt-2">
                    <thead class="bg-dark text-white" style="font-size: 1.1rem;">
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
                        <thead class="bg-dark text-white" style="font-size: 1.1rem;">
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
            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                <h2 class="mt-4">Best Per Challenge</h2>
                @foreach($bestPerformingSchools->groupBy('challengeId') as $challengeId => $schools)
                    <h3 class="mt-4">Challenge ID: {{ $challengeId }}</h3>
                    <table class="table table-bordered mt-2">
                        <thead class="bg-dark text-white" style="font-size: 1.1rem;">
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

            <!-- Tab 5 Content -->
            <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                <h2 class="mt-4">School Performance Over Years</h2>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var canvas = document.getElementById('schoolPerformanceChart');
                        if (!canvas) {
                            console.error('Canvas element not found');
                            return;
                        }
                        var chartDataStr = canvas.dataset.chartData;
                        if (!chartDataStr) {
                            console.error('No chart data found');
                            return;
                        }
                        try {
                            var chartData = JSON.parse(chartDataStr);
                            console.log('Chart Data:', chartData);
                            if (Object.keys(chartData).length === 0) {
                                console.error('Chart data is empty');
                                return;
                            }
                            var ctx = canvas.getContext('2d');
                            
                            // Extract years
                            var years = [...new Set(Object.values(chartData).flatMap(school => school.map(item => item.year)))].sort();
                            
                            // Prepare datasets for bar chart
                            var datasets = Object.keys(chartData).map((school, index) => {
                                var color = `hsl(${index * 360 / Object.keys(chartData).length}, 70%, 50%)`;
                                return {
                                    label: school,
                                    data: years.map(year => {
                                        var dataPoint = chartData[school].find(item => item.year == year);
                                        return dataPoint ? dataPoint.rank : null;
                                    }),
                                    backgroundColor: color,
                                    borderColor: color,
                                    borderWidth: 1
                                };
                            });

                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: years,
                                    datasets: datasets
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            reverse: false, // Changed from true to false
                                            title: {
                                                display: true,
                                                text: 'Rank'
                                            },
                                            ticks: {
                                                callback: function(value) {
                                                    return value === 0 ? '' : value;
                                                }
                                            }
                                        },
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Year'
                                            }
                                        }
                                    },
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    let label = context.dataset.label || '';
                                                    if (label) {
                                                        label += ': Rank ';
                                                    }
                                                    if (context.parsed.y !== null) {
                                                        label += context.parsed.y;
                                                    }
                                                    return label;
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        } catch (error) {
                            console.error('Error parsing chart data:', error);
                        }
                    });
                </script>
                <canvas id="schoolPerformanceChart" data-chart-data="{{ json_encode($performanceOverYears) }}" style="height: 200px;"></canvas>
            </div>
                <!-- Tab 6 Content -->
            <div class="tab-pane fade show " id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
            <h2 class="mt-4">Most Correctly Answered per Challenge</h2>
            @foreach ($mostCorrectlyAnsweredQuestions as $challengeId => $questions)
                    <h3>Challenge ID: {{ $challengeId }}</h3>
                    <table class="table table-bordered mt-2">
                        <thead   class="bg-dark text-white" style="font-size: 1.1rem;">
                            <tr>
                                <th>Question ID</th>
                                <th>Question Text</th>
                                <th>Total Correct</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
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

        </div>
        
    </div>
@endsection
    @push('styles')
    <style>
        .nav-tabs .nav-link {
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
        }
        .nav-tabs .nav-link.active {
            background-color: #ffffff !important;
            color: #17a2b8 !important;
            border-color: #17a2b8 #17a2b8 #fff;
        }
        .tab-content {
            border: 1px solid #17a2b8;
            border-top: none;
            border-radius: 0 0 .25rem .25rem;
            padding: 15px;
        }
        .nav-item-spaced {
            margin-right: 10px; /* Adjust this value to increase or decrease spacing */
        }
    
    </style>
    @endpush

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Your existing scripts -->
    @endpush

