<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Job extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job')->upsert(
            [
                [
                    "id" => 1,
                    "person_id" => 1,
                    "name" => "Dr. Juliano",
                    "status" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 2,
                    "person_id" => 1,
                    "name" => "Dr. Ricardo",
                    "status" => 1,
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 3,
                    "person_id" => 1,
                    "name" => "Dr. João",
                    "status" => 1,
                    "created_at" => new DateTime("now")
                ],
            ],
            [
                "id"
            ]
        );
    }
}
