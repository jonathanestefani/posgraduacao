<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_type_id',
        'name',
        'email',
        'password',
        'status',
        'user_type_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
