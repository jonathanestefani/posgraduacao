<?php

namespace App\BaseRepository\Filters;

use stdClass;

class ListFilter
{
    private stdClass $filterClass;
    private string $filterKey = "";

    public function __construct($filterClass, String $filterKey)
    {
        $this->filterClass = $filterClass;
        $this->filterKey = $filterKey;
    }

    public function getFilterClass() {
        return $this->filterClass;
    }

    public function getFilterKey() {
        return $this->filterKey;
    }
}
