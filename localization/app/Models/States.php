<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $fillable = [
        'id',
        'country_id',
        'name',
        'uf'
    ];
}
