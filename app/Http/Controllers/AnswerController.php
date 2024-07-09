<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'body' => 'required',
        ]);

        $question->answers()->create($validated);

        return redirect()->route('questions.show', $question);
    }
}
