<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    protected $table = 'user_type';

    use SoftDeletes;

    protected $fillable = [
        'id',
        'type',
        'name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
