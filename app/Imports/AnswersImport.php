<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $question = Question::where('question_text', $row['question_text'])->first();
        if ($question) {
            return new Answer([
                'question_id' => $question->id,
                'answer_text' => $row['answer_text'],
                'marks' => $row['marks'],
            ]);
        }
    }
}
