<?php

namespace App\Services\Job\filters;

use App\BaseRepository\Abs\AbsFilter;
use App\BaseRepository\Api\LoadApi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class filterSearch extends AbsFilter {

    public function execute($key, $value): Builder {
        if (empty($value)) return $this->builder;

        $ids = [];

        try {
            $persons = (new LoadApi("persons", "person_id", "person"))
                    ->setValue($value)
                    ->setParams([
                        "filters" => [
                            "name" => $value
                        ],
                        "all" => true
                    ])
                    ->loadData();

            Log::info($persons);

            if (count($persons)) {
                foreach ($persons as $person) {
                    $ids[] = $person->id;
                }

               
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $this->builder->whereIn('person_id', $ids);
    }
}