<?php

namespace App\Console\Commands;

use App\Models\Route as Routes;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Route extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update route';

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
        $file_api_name = base_path() . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'api_gateway.php';

        $routes = Routes::get();

        $content = "<?php\n\nreturn [\n\t\"api_names\" => [\n";

        foreach ($routes as $value) {
            $content .= "\t\t \"$value->name\" => \"$value->protocol://$value->route" . (!empty($value->port) ? ':' . (string) $value->port : '') . '/' . (!empty($value->endpoint) ? (string) $value->endpoint : '') . "\",\n";
        }

        $content .= "\t]\n];";

        @unlink($file_api_name);
        file_put_contents($file_api_name, $content);
    }
}
