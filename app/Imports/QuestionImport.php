<?php

namespace App\Imports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Question;
class QuestionImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $rows = $rows->skip(1);
        foreach ($rows as $row) 
        {
            Question::create([
                'questionid' => $row[0],
                'question_text' => $row[1],
                'marks' => $row[2],
                'challengeId' => $row[3],
            ]);
        }
    }
}
