<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
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
