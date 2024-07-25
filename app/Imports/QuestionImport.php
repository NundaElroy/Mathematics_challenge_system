<?php
// QuestionImport.php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Question;
use Illuminate\Support\Facades\Log;

class QuestionImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Clear any existing question map from the session
        session()->forget('questionMap');

        $questionMap = [];

        foreach ($rows as $row) 
        {
            try {
                // Log the row being processed
                Log::info('Processing question row:', $row->toArray());

                $question = Question::create([
                    'question_text' => $row['question_text'],
                    'marks' => $row['marks'],
                    'challengeId' => $row['challengeid'],
                ]);

                // Store the mapping
                $questionMap[$row['question_text']] = $question->questionid;

                // Log successful creation
                Log::info('Created question:', ['questionid' => $question->questionid, 'text' => $row['question_text']]);
            } catch (\Exception $e) {
                // Log any errors
                Log::error('Error creating question:', ['error' => $e->getMessage(), 'row' => $row->toArray()]);
            }
        }

        // Store the mapping in session
        session(['questionMap' => $questionMap]);
    }
}
