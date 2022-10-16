<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\ETypeCall;

trait TIndex 
{
    protected $perPageAttribute;
    protected $perPageDefault;
    protected $limit = 25;

    public function Index()
    {
        if (method_exists($this, 'defineAggregate')) {
            $this->defineAggregate();
        }

        $this->beforeExecute(ETypeCall::INDEX);

        if (method_exists($this, 'executeFilters')) {
            $this->executeFilters($this->request);
        }

        if (method_exists($this, 'executeOrder')) {
            $this->applyOrder();
        }

        $this->data = $this->executePagination();

        if (method_exists($this, 'loadRelationsByApi')) {
            $this->loadRelationsByApi();
        }

        $this->afterExecute(ETypeCall::INDEX);

        return $this->data;
    }

    private function executePagination()
    {
        $this->setPagination();

        $perPage = isset($this->request[$this->perPageAttribute])
            ? $this->request[$this->perPageAttribute]
            : $this->perPageDefault;

        if ($perPage == -1) {
            return $this->getStructPagination();
        }

        $result = $this->instance->paginate($perPage);

        return $result;
    }

    public function setPagination()
    {
        $currentPage = isset($this->request["page"]) ? $this->request["page"] : 1;

        $this->instance->skip($this->limit)->take($currentPage);
    }

    private function getStructPagination() {
        return [
            "data" => $this->instance->get(),
            "total" => $this->instance->count(),
            "last_page" => 1,
            "from" => 1,
            "to" => 1,
            "per_page" => -1
        ];
    }
}
