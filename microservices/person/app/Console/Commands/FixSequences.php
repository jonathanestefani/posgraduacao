<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FixSequences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fix_sequences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fix sequences database';

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

        $query = "
            SELECT 'SELECT SETVAL(' ||
                quote_literal(quote_ident(PGT.schemaname) || '.' || quote_ident(S.relname)) ||
                ', COALESCE(MAX(' ||quote_ident(C.attname)|| '), 1) ) FROM ' ||
                quote_ident(PGT.schemaname)|| '.'||quote_ident(T.relname)|| ';' as qry
            FROM pg_class AS S,
                pg_depend AS D,
                pg_class AS T,
                pg_attribute AS C,
                pg_tables AS PGT
            WHERE S.relkind = 'S'
                AND S.oid = D.objid
                AND D.refobjid = T.oid
                AND D.refobjid = C.attrelid
                AND D.refobjsubid = C.attnum
                AND T.relname = PGT.tablename
                AND PGT.schemaname = '$schemaName'
            ORDER BY S.relname;
        ";

        $querys = DB::select($query);

        foreach ($querys as $query) {
            DB::statement($query->qry);
        }
    }
}
