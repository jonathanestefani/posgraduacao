<?php

namespace App\Services\User;

use App\BaseRepository\Services\LoadService as ServicesLoadService;
use App\Services\User\Filters\TDefaultFilters;

class LoadService extends ServicesLoadService
{
    use TDefaultFilters;
}
