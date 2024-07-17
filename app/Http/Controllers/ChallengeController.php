<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::all();
        return view('challenges.index', compact('challenges'));
    }

    public function create()
    {

        $activePage = 'create';
        return view('challenges.create' ,  ['title' => 'Add Challenge'], compact('activePage'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'opening_date' => 'required|date',
            'closing_date' => 'required|date',
            'challenge_name' => 'required|string|max:255',
            'duration' => 'required',
            'number_of_questions' => 'required|integer|min:10',
        ]);

        Challenge::create($request->all());

        return redirect()->route('challenges.index')->with('success', 'Challenge created successfully.');
    }

    public function show($id)
    {
        $activePage = 'challenges';
        $challenge = Challenge::findOrFail($id);
        return view('challenges.show',['title' => 'View Challenge'], compact('challenge', 'activePage'));

    }

    public function edit($id)
    {
        $activePage = 'challenges';
        $title = 'Edit Challenge';
        $challenge = Challenge::findOrFail($id);
        return view('challenges.edit', compact('title','challenge', 'activePage'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'opening_date' => 'required|date',
            'closing_date' => 'required|date',
            'challenge_name' => 'required|string|max:255',
            'duration' => 'required',
            'number_of_questions' => 'required|integer|min:10',
        ]);

        $challenge = Challenge::findOrFail($id);
        $challenge->update($request->all());

        return redirect()->route('challenges.index')->with('success', 'Challenge updated successfully.');
    }

    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->delete();

        return redirect()->route('challenges.index')->with('success', 'Challenge deleted successfully.');
    }
}
