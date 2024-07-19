<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $table = 'challenge'; // Specify the correct table name

    protected $primaryKey = 'challengeid'; // Specify the correct primary key

    protected $fillable = [
        'challengeid',
        'opening_date',
        'closing_date',
        'challenge_name',
        'number_of_questions',
        'duration',
    ];
    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }
}
