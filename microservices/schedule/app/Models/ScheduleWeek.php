<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleWeek extends Model
{
    use SoftDeletes;

    protected $table = "schedule_week";

    protected $fillable = [
        'id',
        'job_id',
        'day_week',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y',
        'updated_at' => 'date:d/m/Y',
        'deleted_at' => 'date:d/m/Y',
    ];

    public function times()
    {
        return $this->hasMany(ScheduleTime::class, 'schedule_week_id', 'id');
    }
}
