<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class States extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->upsert(
            [
                [
                    "id" => 1,
                    "name" => "Acre",
                    "uf" => "AC",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 2,
                    "name" => "Alagoas",
                    "uf" => "AL",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 3,
                    "name" => "Amapá",
                    "uf" => "AP",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 4,
                    "name" => "Amazonas",
                    "uf" => "AM",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 5,
                    "name" => "Bahia",
                    "uf" => "BA",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 6,
                    "name" => "Ceará",
                    "uf" => "CE",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 7,
                    "name" => "Distrito Federal",
                    "uf" => "DF",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 8,
                    "name" => "Espírito Santo",
                    "uf" => "ES",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 9,
                    "name" => "Goiás",
                    "uf" => "GO",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 10,
                    "name" => "Maranhão",
                    "uf" => "MA",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 11,
                    "name" => "Mato Grosso",
                    "uf" => "MT",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 12,
                    "name" => "Mato Grosso do Sul",
                    "uf" => "MS",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 13,
                    "name" => "Minas Gerais",
                    "uf" => "MG",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 14,
                    "name" => "Pará",
                    "uf" => "PA",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 15,
                    "name" => "Paraíba",
                    "uf" => "PB",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 16,
                    "name" => "Paraná",
                    "uf" => "PR",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 17,
                    "name" => "Pernambuco",
                    "uf" => "PE",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 18,
                    "name" => "Piauí",
                    "uf" => "PI",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 19,
                    "name" => "Rio de Janeiro",
                    "uf" => "RJ",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 20,
                    "name" => "Rio Grande do Norte",
                    "uf" => "RN",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 21,
                    "name" => "Rio Grande do Sul",
                    "uf" => "RS",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 22,
                    "name" => "Rondônia",
                    "uf" => "RO",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 23,
                    "name" => "Roraima",
                    "uf" => "RR",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 24,
                    "name" => "Santa Catarina",
                    "uf" => "SC",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 25,
                    "name" => "São Paulo",
                    "uf" => "SP",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 26,
                    "name" => "Sergipe",
                    "uf" => "SE",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 27,
                    "name" => "Tocantins",
                    "uf" => "TO",
                    "country_id" => 1,
                    "created_at" => new DateTime("now")
                ]
            ],
            [
                'uf'
            ]
        );
    }
}
