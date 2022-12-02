<?php

namespace App\Services\ScheduleWeek\Aggregates;

use App\BaseRepository\Api\LoadApi;

trait TDefaultAggregates
{
    private function defineAggregate()
    {
        $this->with = [
            'api' => new LoadApi('jobs', 'job_id', 'job'),
        ];
    }
}
