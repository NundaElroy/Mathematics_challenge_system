<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class School extends Model
{
    

    protected $fillable = [
        'registration_no',
        'name',
         'district',
           'representative_name',
            'representative_email'
    ];
}

