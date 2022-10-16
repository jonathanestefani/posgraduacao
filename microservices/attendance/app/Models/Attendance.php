<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;

    protected $table = 'attendance';

    protected $fillable = [
        'id',
        'person_id',
        'job_id',
        'schedule_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
