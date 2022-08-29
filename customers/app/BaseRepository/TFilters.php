<?php

namespace App\BaseRepository;

use Illuminate\Database\Eloquent\Builder;

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
                $listFilterClass = $this->customFilters[$key];

                $class = $listFilterClass->getFilterClass();

                $this->instanceModel = (new $class($this->instanceModel))->execute( $listFilterClass->getFilterKey() , $value);
            }
        }

        return $this->instanceModel;
    }

}
