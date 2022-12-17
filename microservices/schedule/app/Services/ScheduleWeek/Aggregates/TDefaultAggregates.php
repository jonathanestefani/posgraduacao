<?php

namespace App\Services\ScheduleWeek\Aggregates;

use App\BaseRepository\Api\LoadApi;
use Illuminate\Support\Facades\Log;

trait TDefaultAggregates
{
    protected function defineAggregate()
    {
        Log::info('defineAggregate');

        $this->with = [
            'times',
            'api' => new LoadApi('jobs', 'job_id', 'job'),
        ];
    }
}
