<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobInfo extends Model
{
    use SoftDeletes;

    protected $table = "job_info";

    protected $fillable = [
        'id',
        'job_id',
        'name',
        'text',
        'value',
        'type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
