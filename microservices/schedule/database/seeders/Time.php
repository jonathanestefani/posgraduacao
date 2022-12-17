<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Time extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule_time')->upsert(
            [
                [
                    "id" => 1,
                    "job_id" => 1,
                    "schedule_week_id" => 1,
                    "time" => 1671274800,
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 2,
                    "job_id" => 1,
                    "schedule_week_id" => 2,
                    "time" => 1671310800,
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 3,
                    "job_id" => 2,
                    "schedule_week_id" => 3,
                    "time" => 1671274800,
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 4,
                    "job_id" => 2,
                    "schedule_week_id" => 4,
                    "time" => 1671289200,
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 5,
                    "job_id" => 3,
                    "schedule_week_id" => 5,
                    "time" => 1671294600,
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 6,
                    "job_id" => 3,
                    "schedule_week_id" => 6,
                    "time" => 1671310800,
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
            ],
            [
                "id"
            ]
        );
    }
}
