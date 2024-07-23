<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSchedule extends Model
{
    use HasFactory;

    protected $table = 'report_schedules';

    // Specify the primary key
    protected $primaryKey = 'reportid';

    protected $fillable = [
        'reportid',
        'challengeid',
        'timetosend',
    ];
}
