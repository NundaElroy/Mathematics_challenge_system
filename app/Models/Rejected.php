<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejected extends Model
{
    use HasFactory;
    protected $table = 'rejected';

    protected $fillable = [
        'rejectedid',
        'username',
        'firstname',
        'lastname',
        'email',
        'DOB',
        'image',
        'school_registration_no',
    ];
}
