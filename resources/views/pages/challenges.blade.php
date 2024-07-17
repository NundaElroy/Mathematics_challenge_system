@extends('layouts.app', ['activePage' => 'table', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'challenges', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">CHALLENGE MANAGEMENT</h4>
                        <p class="card-category">Enter information about challenges to be attempted by students</p>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Challenge Name</th>
                                <th>Number Of Questions</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Pythagorus theorem</td>
                                    <td>10</td>
                                    <td>2024-07-15</td>
                                    <td>2024-07-16</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Algebra</td>
                                    <td>10</td>
                                    <td>2024-07-17</td>
                                    <td>2024-07-18</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Geometry</td>
                                    <td>10</td>
                                    <td>2024-07-19</td>
                                    <td>2024-07-20</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Data analysis</td>
                                    <td>10</td>
                                    <td>2024-07-21</td>
                                    <td>2024-07-22</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Measurement</td>
                                    <td>10</td>
                                    <td>2024-07-23</td>
                                    <td>2024-07-24</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Integers</td>
                                    <td>10</td>
                                    <td>2024-08-01</td>
                                    <td>2024-08-02</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Multiplication</td>
                                    <td>10</td>
                                    <td>2024-08-03</td>
                                    <td>2024-08-04</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Division</td>
                                    <td>10</td>
                                    <td>2024-08-05</td>
                                    <td>2024-08-06</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Subtraction</td>
                                    <td>10</td>
                                    <td>2024-08-07</td>
                                    <td>2024-08-08</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Patterns</td>
                                    <td>10</td>
                                    <td>2024-08-09</td>
                                    <td>2024-08-10</td>
                                    <td>30</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection