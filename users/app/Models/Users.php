<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
