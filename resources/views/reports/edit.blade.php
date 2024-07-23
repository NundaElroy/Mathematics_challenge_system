@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-primary text-white" style="border-bottom: 2px solid #ffffff;">
                    <h1 class="card-title" style="font-size: 1.5rem; font-weight: bold;">Edit Report Schedule</h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('report.scheduleupdate', $reportSchedule->reportid) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="challengeid">Challenge ID</label>
                            <input type="number" class="form-control" id="challengeid" name="challengeid" value="{{ $reportSchedule->challengeid }}" required>
                        </div>

                        <div class="form-group">
                            <label for="timetosend">Time to Send</label>
                            <input type="time" class="form-control" id="timetosend" name="timetosend" value="{{ $reportSchedule->timetosend }}" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Update Schedule</button>
                            <a href="{{ route('report.scheduleupdate') }}" class="btn btn-secondary" style="border-radius: 20px; padding: 10px 20px;">Back to Report Schedules</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
