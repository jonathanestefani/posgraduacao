<?php

namespace App\BaseRepository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

trait TFilters
{
    /* Define filters at Class */
    protected Array $filters = [];

    /* Internal use */
    protected Array $filtersRequest = [];

    private function executeFilters(): Builder
    {
        if (count($this->filtersRequest) > 0) 
        {
            foreach($this->filtersRequest as $key => $value) {
                $listFilterClass = $this->filters[$key];

                Log::info($key);

                $class = $listFilterClass->getFilterClass();

                $this->instance = (new $class($this->instance))->execute( $listFilterClass->getFilterKey() , $value);
            }
        }

        return $this->instance;
    }

}
