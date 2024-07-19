<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AnswerImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $rows = $rows->skip(1);
        foreach ($rows as $row) 
        {
             Answer::create([
                'answerid' => $row[0],
                'correct_answer' => $row[1],
                'question' => $row[2],
            ]);
        }
    }
}
