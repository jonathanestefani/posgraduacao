<?php

namespace App\Services\UserType\Filters;

use App\BaseRepository\Filters\FilterStringLike;
use App\BaseRepository\Filters\ListFilter;

trait TDefaultFilters
{
    protected function defineFilters()
    {
        $this->filters = [
            "name" => new ListFilter(FilterStringLike::class, "name")
        ];
    }
}
