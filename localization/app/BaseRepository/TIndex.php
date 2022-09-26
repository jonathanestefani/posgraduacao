<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\ETypeCall;
use Illuminate\Contracts\Pagination\Paginator;

// use \Illuminate\Pagination\Paginator;

trait TIndex 
{
    protected $perPageAttribute;
    protected $perPageDefault;
    protected $limit = 25;

    public function Index()
    {
        $this->instanceModel = $this->modelClass::query();
        $this->defineAggregate();

        $this->beforeExecute(ETypeCall::INDEX);

        if (method_exists($this, 'executeFilters')) {
            $this->executeFilters($this->request);
        }

        if (method_exists($this, 'executeOrder')) {
            $this->applyOrder();
        }

        $this->data = $this->executePagination();

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

        $result = $this->instanceModel->paginate($perPage);

        return $result;
    }

    public function setPagination()
    {
        $currentPage = isset($this->request["page"]) ? $this->request["page"] : 1;

        $this->instanceModel->skip($this->limit)->take($currentPage);

        /*
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        */
    }

    private function getStructPagination() {
        return [
            "data" => $this->instanceModel->get(),
            "total" => $this->instanceModel->count(),
            "last_page" => 1,
            "from" => 1,
            "to" => 1,
            "per_page" => -1
        ];
    }
}
