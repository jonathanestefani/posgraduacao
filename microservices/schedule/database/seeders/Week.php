<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Week extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule_week')->upsert(
            [
                [
                    "id" => 1,
                    "job_id" => 1,
                    "day_week" => "monday",
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 2,
                    "job_id" => 1,
                    "day_week" => "tuesday",
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 3,
                    "job_id" => 2,
                    "day_week" => "monday",
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 4,
                    "job_id" => 2,
                    "day_week" => "tuesday",
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 5,
                    "job_id" => 3,
                    "day_week" => "monday",
                    "created_at" => new DateTime("now"),
                    "updated_at" => new DateTime("now"),
                    "deleted_at" => null
                ],
                [
                    "id" => 6,
                    "job_id" => 3,
                    "day_week" => "tuesday",
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
