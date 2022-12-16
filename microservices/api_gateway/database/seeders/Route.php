<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Route extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('route')->upsert(
            [
                [
                    "id" => 2,
                    "name" => "cities",
                    "protocol" => "http",
                    "route" => "posbackend_localization",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
                [
                    "id" => 3,
                    "name" => "states",
                    "protocol" => "http",
                    "route" => "posbackend_localization",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
                [
                    "id" => 4,
                    "name" => "countries",
                    "protocol" => "http",
                    "route" => "posbackend_localization",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
                [
                    "id" => 7,
                    "name" => "schedules",
                    "protocol" => "http",
                    "route" => "posbackend_schedule",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
                [
                    "id" => 1,
                    "name" => "persons",
                    "protocol" => "http",
                    "route" => "posbackend_person",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
                [
                    "id" => 5,
                    "name" => "jobs",
                    "protocol" => "http",
                    "route" => "posbackend_job",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
                [
                    "id" => 6,
                    "name" => "attendances",
                    "protocol" => "http",
                    "route" => "posbackend_attendance",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
                [
                    "id" => 8,
                    "name" => "users",
                    "protocol" => "http",
                    "route" => "posbackend_apigateway",
                    "port" => 80,
                    "endpoint" => "",
                    "status" => 1,
                    "created_at" => "2022-11-04T06:19:48.000Z",
                    "updated_at" => "2022-11-04T06:19:48.000Z",
                    "deleted_at" => null
                ],
            ],
            [
                "id"
            ]            
        );
    }
}
