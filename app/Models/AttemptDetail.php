<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptDetail extends Model
{
    use HasFactory;

    protected $table = 'attempt_details';
    protected $fillable = [
        'attemptid', 
        'questionid', 
        'participantid', 
        'challengeId', 
        'selected_answer', 
        'correct_answer', 
        'score', 
        'time_taken_per_question', 
        'is_correct'
    ];
    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'questionid');
    }
}
