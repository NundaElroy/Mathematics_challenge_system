<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Question;
use App\Models\Answer;

class ExcelController extends Controller
{
    public function uploadExcel(Request $request)
    {
        $request->validate([
            'questions' => 'required|file|mimes:xlsx',
            'answers' => 'required|file|mimes:xlsx',
        ]);

        $this->importQuestions($request->file('questions'));
        $this->importAnswers($request->file('answers'));

        return back()->with('success', 'Questions and answers uploaded successfully.');
    }

    private function importQuestions($file)
    {
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $row) {
            Question::create([
                'question_text' => $row[0],
            ]);
        }
    }

    private function importAnswers($file)
    {
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $row) {
            Question::create([
                'question_text' => $row[0],
            ]);
        }
    }

    private function importAnswers($file)
    {
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $row) {
            Answer::create([
                'question_id' => $row[0], // Ensure this corresponds to the ID of the question
                'answer_text' => $row[1],
                'marks' => $row[2],
            ]);
        }
}
}
