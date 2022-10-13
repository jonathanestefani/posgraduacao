<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = "schedule";

    protected $fillable = [
        'id',
        'job_id',
        'date',
        'time',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'date' => 'date:d/m/Y',
        'time' => 'date:h:i:s'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'id', 'job_id');
    }
}
