<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                "id"=> 1,
                "user_type_id" => 1,
                "name"=> "admin",
                "email"=> "jonathan.estefani@gmail.com",
                "password" => password_hash('admin', null),
                "status" => 1,
                "created_at" => new DateTime("now")
            ],
            [
                "id"=> 2,
                "user_type_id" => 2,
                "name"=> "cliente",
                "email"=> "jonathan.estefani@gmail.com",
                "password" => password_hash('cliente', null),
                "status" => 1,
                "created_at" => new DateTime("now")
            ],
            [
                "id"=> 3,
                "user_type_id" => 3,
                "name"=> "empresa",
                "email"=> "jonathan.estefani@gmail.com",
                "password" => password_hash('empresa', null),
                "status" => 1,
                "created_at" => new DateTime("now")
            ],
        ]);
    }
}
