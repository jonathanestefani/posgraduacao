<?php

namespace App\Services\ScheduleWeek\Aggregates;

use App\BaseRepository\Api\LoadApi;

trait TDefaultAggregates
{
    protected function defineAggregate()
    {
        $this->with = [
            'times',
            'api' => new LoadApi('jobs', 'job_id', 'job'),
        ];
    }
}
