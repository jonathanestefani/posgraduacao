<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Person extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('person')->insert([
            [
                "id" => 1,
                "city_id" => 4201406,
                "state_id" => 24,
                "country_id" => 1,
                "name" => "JONATHAN",
                "type" => "F",
                "cnpj_cpf" => "12345678901",
                "street" => "Rua de teste",
                "neighborhood" => "Mato Alto",
                "zip_code" => "88904180",
                "number" => "150",
                "complement" => "Complemento de teste",
                "phone" => "48999340600",
                "email" => "jonathan.estefani@gmail.com",
                "status" => 1,
                "created_at" => "2022-11-06T15:43:05.000Z",
                "updated_at" => "2022-11-06T15:43:05.000Z",
                "deleted_at" => null
            ],
            [
                "id" => 2,
                "city_id" => 4201406,
                "state_id" => 24,
                "country_id" => 1,
                "name" => "JONATHAN",
                "type" => "F",
                "cnpj_cpf" => "12345678901",
                "street" => "Rua de teste",
                "neighborhood" => "Mato Alto",
                "zip_code" => "88904180",
                "number" => "150",
                "complement" => "Complemento de teste",
                "phone" => "48999340600",
                "email" => "jonathan.estefani@gmail.com",
                "status" => 1,
                "created_at" => "2022-11-06T15:43:05.000Z",
                "updated_at" => "2022-11-06T15:43:05.000Z",
                "deleted_at" => null
            ]
        ]);
    }
}
