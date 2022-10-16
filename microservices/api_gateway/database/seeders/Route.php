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
        DB::table('route')->insert([
            [
                "id"=> 1,
                "name" => "customers",
                "protocol"=> "http",
                "route"=> "posbackend_customers",
                "port"=> "80",
                "endpoint"=> "/api/",
                "status" => 1,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
            ],
            [
                "id"=> 2,
                "name" => "cities",
                "protocol"=> "http",
                "route"=> "posbackend_localization",
                "port"=> "80",
                "endpoint"=> "/api/",
                "status" => 1,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
            ],
            [
                "id"=> 3,
                "name" => "states",
                "protocol"=> "http",
                "route"=> "posbackend_localization",
                "port"=> "80",
                "endpoint"=> "/api/",
                "status" => 1,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
            ],
            [
                "id"=> 4,
                "name" => "countries",
                "protocol"=> "http",
                "route"=> "posbackend_localization",
                "port"=> "80",
                "endpoint"=> "/api/",
                "status" => 1,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
            ],
            [
                "id"=> 5,
                "name" => "job",
                "protocol"=> "http",
                "route"=> "posbackend_job",
                "port"=> "80",
                "endpoint"=> "/api/",
                "status" => 1,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
            ],
            [
                "id"=> 6,
                "name" => "attendance",
                "protocol"=> "http",
                "route"=> "posbackend_attendance",
                "port"=> "80",
                "endpoint"=> "/api/",
                "status" => 1,
                "created_at" => new DateTime("now"),
                "updated_at" => new DateTime("now"),
            ],
        ]);
    }
}
