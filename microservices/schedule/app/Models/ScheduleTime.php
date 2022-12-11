<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleTime extends Model
{
    use SoftDeletes;

    protected $table = "schedule_time";

    protected $fillable = [
        'id',
        'job_id',
        'schedule_week_id',
        'time',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y',
        'updated_at' => 'date:d/m/Y',
        'deleted_at' => 'date:d/m/Y',
        'time' => 'date:H:i:s'
    ];
}
