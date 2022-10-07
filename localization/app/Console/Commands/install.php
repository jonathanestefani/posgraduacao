<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = config("database.default");
        $schemaName = config("database.connections.$connection.schema");
        $charset = config("database.connections.$connection.charset",'utf8mb4');

        $query = "CREATE SCHEMA IF NOT EXISTS $schemaName;";

        DB::statement($query);
    }
}
