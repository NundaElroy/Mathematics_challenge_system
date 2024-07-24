<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = 'participants';

    protected $fillable = [
        'participantid',
        'username',
        'firstname',
        'lastname',
        'email',
        'DOB',
        'image',
        'school_registration_no',

    ];
    public function school()
    {
        return $this->belongsTo(School::class, 'school_registration_no', 'school_registration_number');
    }
    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }


}
