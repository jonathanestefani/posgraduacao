<?php

namespace App\BaseRepository;

use Illuminate\Database\Eloquent\Builder;

trait TFilters
{
    /* Define filters at Class */
    protected Array $filters = [];

    /* Internal use */
    protected Array $filtersRequest = [];

    public function setFilters(Array $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    private function executeFilters(): Builder
    {
        if (method_exists($this, 'defineFilters')) {
            $this->defineFilters();
        }

        if (count($this->filtersRequest) > 0) 
        {
            foreach($this->filtersRequest as $key => $value) {
                $listFilterClass = $this->filters[$key];

                $listFilterClass->setFilters($this->filtersRequest)->setValue($value)->execute($this->instance);

                /*
                $ListFilterInstance = $listFilterClass->getclass();

                (new $ListFilterInstance($this->instance))->setFilters($this->filtersRequest)->execute( $listFilterClass->getKey(), $value);
                */
            }
        }

        return $this->instance;
    }

}
