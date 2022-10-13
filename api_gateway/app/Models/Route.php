<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;

    protected $table = 'route';

    protected $fillable = [
        'id',
        'name',
        'protocol',
        'route',
        'port',
        'endpoint',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
