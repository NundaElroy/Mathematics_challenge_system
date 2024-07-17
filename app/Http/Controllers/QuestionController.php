<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionsImport;
use App\Imports\AnswersImport;

class QuestionController extends Controller
{
    public function showUploadForm()
    {
        $title = 'upload_questions_and_answers';
        $activePage = 'upload';
        return view('pages.questions', compact('title',  'activePage'));

    }

    public function uploadQuestions(Request $request)
    {
        $request->validate([
            'questions_file' => 'required|file|mimes:xlsx',
            'answers_file' => 'required|file|mimes:xlsx',
        ]);


        Excel::import(new QuestionsImport(), $request->file('questions_file'));
        Excel::import(new AnswersImport(), $request->file('answers_file'));

        return redirect()->route('questions.questions-form')->with('success', 'Questions and Answers uploaded successfully.');
    }
}
