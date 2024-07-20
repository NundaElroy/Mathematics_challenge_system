<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;
    protected $table = 'attempts';
    protected $fillable = [
      'attemptid',
      'participantid',
      'school_registration_no',
        'challengeId',
        'timetaken',
        'attempt_date',
        'score',

    ];
}
