<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            [
                "id"=> 1,
                "name"=> "Admin",
                "type"=> "admin",
                "status" => 1,
                "created_at" => new DateTime("now")
            ],
            [
                "id"=> 2,
                "name"=> "Pessoa",
                "type"=> "person",
                "status" => 1,
                "created_at" => new DateTime("now")
            ],
            [
                "id"=> 3,
                "name"=> "Empresa",
                "type"=> "company",
                "status" => 1,
                "created_at" => new DateTime("now")
            ],
        ]);
    }
}
