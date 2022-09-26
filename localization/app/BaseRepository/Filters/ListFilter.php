<?php

namespace App\BaseRepository\Filters;

class ListFilter
{
    private $filterClass;
    private string $filterKey = "";

    public function __construct($filterClass, String $filterKey)
    {
        $this->filterClass = $filterClass;
        $this->filterKey = $filterKey;
    }

    public function getFilterClass() {
        $this->filterClass;
    }

    public function getFilterKey() {
        $this->filterKey;
    }
}
