<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'opening_date',
        'closing_date',
        'challenge_name',
        'number_of_questions',
        'duration',
    ];
}
