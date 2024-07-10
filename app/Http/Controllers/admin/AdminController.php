<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Question;
use App\Models\Challenge;



class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showUploadSchoolsForm()
    {
        return view('admin.upload-schools');
    }

    public function uploadSchools(Request $request)
    {
        // Validate and process the uploaded file
        $request->validate([
            'schools_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('schools_file');
        $data = array_map('str_getcsv', file($file->getRealPath()));

        foreach ($data as $row) {
            School::create([
                'name' => $row[0],
                'district' => $row[1],
                'registration_number' => $row[2],
                'representative_name' => $row[3],
                'representative_email' => $row[4],
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Schools uploaded successfully.');
    }

    public function showUploadQuestionsForm()
    {
        return view('admin.upload-questions');
    }

    public function uploadQuestions(Request $request)
    {
        // Validate and process the uploaded files
        $request->validate([
            'questions_file' => 'required|file|mimes:xlsx',
            'answers_file' => 'required|file|mimes:xlsx',
        ]);

        // Implement file processing logic here
        return redirect()->route('admin.dashboard')->with('success', 'Questions and answers uploaded successfully.');
    }

    public function showSetCompetitionForm()
    {
        return view('admin.set-competition');
    }

    public function setCompetition(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'duration' => 'required|integer',
            'question_count' => 'required|integer',
        ]);

        Challenge::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Competition set successfully.');

}
}