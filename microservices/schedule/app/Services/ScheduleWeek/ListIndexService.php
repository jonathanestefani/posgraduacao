<?php

namespace App\Services\ScheduleWeek;

use App\BaseRepository\Api\LoadApi;
use App\BaseRepository\Filters\ListFilter;
use App\BaseRepository\Services\ListIndexService as ServicesListIndexService;

class ListIndexService extends ServicesListIndexService
{
    private function defineAggregate()
    {
        $this->with = [
            'times',
            'api' => new LoadApi('jobs', 'job_id', 'job'),
        ];
    }

    private function defineFilters()
    {
        $this->filters = [
            "job_id" => new ListFilter(FilterNumber::class, "job_id"),
            "job" => new ListFilter(FilterJob::class, "date"),
            "date" => new ListFilter(FilterDate::class, "date")
        ];
    }
}
