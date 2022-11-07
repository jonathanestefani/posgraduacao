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

                $class = $listFilterClass->getFilterClass();

                Log::info((array) $class);

                $this->instance = (new $class($this->instance))->setFilters($this->filtersRequest)->execute( $listFilterClass->getFilterKey(), $value);
            }
        }

        return $this->instance;
    }

}
