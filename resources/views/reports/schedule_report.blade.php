@extends('layouts.app')
@section('content')
<div class="container mt-5 mb-5 p-4 border rounded shadow-sm" style="background-color: azure;">
    <h2 class="mb-4 text-primary">Schedule Report</h2>
    <form action="{{ route('report.scheduleview') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="challengeid" class="form-label"><b>Challenge ID</b></label>
            <input type="number" class="form-control" id="challengeid" name="challengeid" required>
        </div>
       
        <div class="mb-3">
            <label for="timetosend" class="form-label"><b>Time to Send Report</b></label>
            <input type="text" class="form-control" id="timetosend" name="timetosend" value="23:59:00" required>
        </div>
        <button type="submit" class="btn btn-primary">Schedule Report</button>
    </form>
</div>
@endsection
