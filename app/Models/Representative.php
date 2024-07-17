<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $fillable = ['representative_name', 'representative_email', 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}

