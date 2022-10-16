<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $table = 'person';

    protected $fillable = [
        'id',
        'city_id',
        'state_id',
        'country_id',
        'name',
        'type',
        'cnpj_cpf',
        'street',
        'neighborhood',
        'zip_code',
        'number',
        'complement',
        'phone',
        'email',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
