<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class School extends Model
{
    use HasFactory;
    protected $primaryKey = 'registration_no';
    protected $fillable = [
        'registration_no',
        'name',
         'district',
           'representative_name',
            'representative_email'
    ];
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

}

