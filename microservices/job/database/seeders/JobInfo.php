<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_info')->insert(
            [
                [
                    "id" => 1,
                    "job_id" => 1,
                    "name" => "Especialista",
                    "text" => "Pediatra",
                    "value" => 0,
                    "type" => "desc",
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 2,
                    "job_id" => 2,
                    "name" => "Especialista",
                    "text" => "Oftalmologista",
                    "value" => 0,
                    "type" => "desc",
                    "created_at" => new DateTime("now")
                ],
                [
                    "id" => 3,
                    "job_id" => 3,
                    "name" => "Especialista",
                    "text" => "Cardiologista",
                    "value" => 0,
                    "type" => "desc",
                    "created_at" => new DateTime("now")
                ],
            ]
        );
    }
}
