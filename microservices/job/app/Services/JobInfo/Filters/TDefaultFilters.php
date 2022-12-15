<?php

namespace App\Services\JobInfo\Filters;

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
