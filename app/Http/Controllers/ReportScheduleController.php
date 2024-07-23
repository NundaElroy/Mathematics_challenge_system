<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ReportSchedule;

class ReportScheduleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'challengeid' => 'required|string',
            'enddate' => 'required|date',
            'timetosend' => 'required|date_format:H:i',
        ]);

        $challengeId = $validated['challengeid'];
        $endDate = $validated['enddate'];
        $timeToSend = $validated['timetosend'];

        $timetosend = Carbon::parse($endDate)->setTimeFromTimeString($timeToSend);

        DB::table('report_schedules')->insert([
            'challengeid' => $challengeId,
            'timetosend' => $timetosend,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('/report-schedules')->with('success', 'Report scheduled successfully!');
    }
    public function display()
    {
        // Retrieve all report schedules
        $reportSchedules = ReportSchedule::all();
        
        // dd($reportSchedules);
        // Pass data to the create view
        return view('reports.index', compact('reportSchedules'));
    }
    public function edit($reportid)
    {
        // Retrieve the specific report schedule by reportid$reportid
        $reportSchedule = ReportSchedule::findOrFail($reportid);

        // Pass the data to the edit view
        return view('reports.edit', compact('reportSchedule'));
    }

    public function update(Request $request, $reportid)
    {
        // Validate the request data
        $request->validate([
            'challengeid' => 'required|integer',
            'enddate' => 'required|date',
            'timetosend' => 'required|date_format:H:i',
        ]);

        // Retrieve the specific report schedule by ID
        $reportSchedule = ReportSchedule::findOrFail($reportid);

        // Update the report schedule with new data
        $reportSchedule->update([
            'challengeid' => $request->challengeid,
            'enddate' => $request->enddate,
            'timetosend' => $request->timetosend,
        ]);

        // Redirect back to the report schedules list with a success message
        return redirect()->route('report.scheduleshow')->with('success', 'Report schedule updated successfully.');
    }
    public function destroy($reportid)
    {
        // Retrieve the specific report schedule by ID
        $reportSchedule = ReportSchedule::findOrFail($reportid);

        // Delete the report schedule
        $reportSchedule->delete();

        // Redirect back to the report schedules list with a success message
        return redirect()->route('report.scheduleshow')->with('success', 'Report schedule deleted successfully.');
    }

}
