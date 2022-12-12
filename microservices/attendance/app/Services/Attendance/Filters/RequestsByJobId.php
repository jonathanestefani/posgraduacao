<?php

namespace App\Services\Attendance\Filters;

use App\BaseRepository\Abs\AbsFilter;
use App\BaseRepository\Api\LoadApi;
use App\BaseRepository\Exceptions\ErrorApiCallException;
use Illuminate\Support\Facades\Log;

class RequestsByJobId extends AbsFilter
{
    public function execute(String $key, $value)
    {
        try {
            $jobs = $this->getJobsByPersonId($value);

            $this->builder->whereIn('job_id', $jobs);
            // Log::info((array) $loadApi);
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
        }
        
    }

    private function getJobsByPersonId($person_id) {
        $params = [
            "filters" => [
                "person_id" => $person_id
            ],
            "all" => true
        ];

        try {
            $jobs = (new LoadApi('jobs', 'person_id', 'jobs'))->setParams($params)->loadRelation();

            $items = array_column($jobs, 'id');

            return $items;
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
        }

        return [];
    }

}
