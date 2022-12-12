<?php

namespace App\Services\Attendance\Filters;

use App\BaseRepository\Abs\AbsFilter;
use Illuminate\Support\Facades\Log;

class Search extends AbsFilter
{
    public function execute(String $key, $value)
    {
        if (empty($value)) return;

        $this->builder->whereRaw("obs ILIKE '%$value%'");
    }

}
