<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class);
    }
}
