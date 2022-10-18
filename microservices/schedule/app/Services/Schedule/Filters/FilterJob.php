<?php

namespace App\Services\Schedule\Filters;

use App\BaseRepository\Filters\ListFilter;
use Illuminate\Database\Eloquent\Builder;

class FilterJob extends ListFilter
{
    public function apply($key, $value): Builder
    {
        return $this->query->whereHas('', function($query) use ($value) {
            $query->where('name', 'like', "%$value%");
        });
    }
}