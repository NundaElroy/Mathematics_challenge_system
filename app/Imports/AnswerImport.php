<?php

namespace App\Imports;

use App\Models\Answer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswerImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Retrieve the questionMap from the session
        $questionMap = session('questionMap', []);

        foreach ($rows as $row) 
        {
            // Check if the question text exists in the map
            if (isset($questionMap[$row['question_text']])) {
                Answer::create([
                    'correct_answer' => $row['correct_answer'],
                    'question' => $questionMap[$row['question_text']],  // Use the question id from the map
                ]);
            } else {
                // Optionally handle cases where the question does not exist
                // e.g., log a warning or skip the row
            }
        }
    }
}
