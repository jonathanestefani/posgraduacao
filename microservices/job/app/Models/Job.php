<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $table = "job";

    protected $fillable = [
        'id',
        'person_id',
        'name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function info()
    {
        return $this->hasMany(JobInfo::class, 'job_id', 'id');
    }
}
