<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionsImport;
use App\Imports\AnswersImport;
use App\Http\Controllers\ReportScheduleController;
use App\Models\ReportSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function display()
    {
        $title = 'Reports';
        $activePage = 'report';
        // Retrieve all report schedules
        $reportSchedules = ReportSchedule::all();
        
        // Pass data to the index view
        return view('reports.index', compact('title', 'activePage', 'reportSchedules'));
    }
    
    //will show form to upload a reportid
    public function showForm()
    {
        $title = 'Reports';
        $activePage = 'report';
        return view('reports.schedule_report', compact('title', 'activePage'));
    }

    //storing the data
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'challengeid' => 'required|string',
            'timetosend' => 'required|string',
        ]);
    
        $challengeId = $validated['challengeid'];
        $timeToSend = $validated['timetosend'];
    
        // Assuming you want to use the current date with the time provided
        $datetimeToSend = Carbon::now()->setTimeFromTimeString($timeToSend);
    
        // Insert into the database
        DB::table('report_schedules')->insert([
            'challengeid' => $challengeId,
            'timetosend' => $datetimeToSend->format('H:i:s'), // Store in time format if that's your column type
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    
        return redirect('/report/view')->with('success', 'Report scheduled successfully!');
    }

    

    public function edit($reportid)
    {
        $title = 'Reports';
        $activePage = 'report';
        // Retrieve the specific report schedule by reportid$reportid
        $reportSchedule = ReportSchedule::findOrFail($reportid);
         dd('reportSchedule');
        // Pass the data to the edit view
        return view('reports.edit', compact('reportSchedule','title','activePage'));
    }

    public function update(Request $request, $reportid)
    {
        // Validate the request data
        $request->validate([
            'challengeid' => 'required|string',
            'timetosend' => 'required|string',
        ]);

        // Retrieve the specific report schedule by ID
        $reportSchedule = ReportSchedule::findOrFail($reportid);

        // Update the report schedule with new data
        $reportSchedule->update([
            'challengeid' => $request->challengeid,
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
