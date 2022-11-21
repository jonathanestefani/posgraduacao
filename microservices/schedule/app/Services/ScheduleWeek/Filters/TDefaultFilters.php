<?php

namespace App\Services\ScheduleWeek\Filters;

use App\BaseRepository\Filters\ListFilter;

trait TDefaultFilters
{
    private function defineFilters()
    {
        $this->filters = [
            "job_id" => new ListFilter(FilterNumber::class, "job_id"),
            "day_week" => new ListFilter(FilterString::class, "day_week")
        ];
    }
}
