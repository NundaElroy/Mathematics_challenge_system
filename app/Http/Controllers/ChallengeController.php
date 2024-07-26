<?php
namespace App\Http\Controllers;


use App\Imports\AnswerImport;
use App\Imports\QuestionImport;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenge = Challenge::all();
        return view('challenges.index', compact('challenges'));
    }

    public function create()
    {
        $activePage = 'create';
        return view('challenges.create', ['title' => 'Add Challenge'], compact('activePage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'challengeid' => 'required|integer|unique:challenge,challengeid',
            'opening_date' => 'required|date',
            'closing_date' => 'required|date',
            'challenge_name' => 'required|string|max:255',
            'duration' => 'required',
            'number_of_questions' => 'required|integer|min:5',
        ]);

        Challenge::create($request->all());

        return response()->json(['success' => true, 'message' => 'Challenge created successfully']);
    }

    public function show($challengeid)
    {
        $activePage = 'challenges';
        $challenge = Challenge::findOrFail($challengeid);
        return view('challenges.show', ['title' => 'View Challenge'], compact('challenge', 'activePage'));
    }

    public function edit($challengeid)
    {
        $activePage = 'challenges';
        $title = 'Edit Challenge';
        $challenge = Challenge::findOrFail($challengeid);
        return view('challenges.edit', compact('title', 'challenge', 'activePage'));
    }

    public function update(Request $request, $challengeid)
    {
        $request->validate([
            'challengeid' => 'required|integer|unique:challenge,challengeid,'.$challengeid.',challengeid',
            'opening_date' => 'required|date',
            'closing_date' => 'required|date',
            'challenge_name' => 'required|string|max:255',
            'duration' => 'required',
            'number_of_questions' => 'required|integer|min:5',
        ]);

        $challenge = Challenge::findOrFail($challengeid);
        $challenge->update($request->all());

        return redirect()->route('challenges.index')->with('success', 'Challenge updated successfully.');
    }

    public function destroy($challengeid)
    {
        $challenge = Challenge::findOrFail($challengeid);
        $challenge->delete();

        return redirect()->route('challenges.index')->with('success', 'Challenge deleted successfully.');
    }

    //submit question file funtions
    public function uploadQuestions(Request $request)
    {
        $request->validate([
            'import_question_file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Clear previous mapping from session
        session()->forget('questionMap');

        Excel::import(new QuestionImport, $request->file('import_question_file'));

        return response()->json(['success' => true, 'message' => 'Questions imported successfully']);
    }

    public function uploadAnswers(Request $request)
    {
        $request->validate([
            'import_answer_file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new AnswerImport, $request->file('import_answer_file'));

        return response()->json(['success' => true, 'message' => 'Answers imported successfully']);
    }
}
