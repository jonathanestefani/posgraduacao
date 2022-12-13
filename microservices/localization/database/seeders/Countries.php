<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Countries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->upsert(
            [
                [
                    "id" => 1,
                    "name" => "Brasil",
                    "abbrev" => "BR",
                    "created_at" => new DateTime("now")
                ]
            ],
            [
                'id'
            ]
        );
    }
}
