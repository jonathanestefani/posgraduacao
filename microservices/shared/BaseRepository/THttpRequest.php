<?php

namespace App\BaseRepository;

use App\BaseRepository\Enum\EOperation;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;

trait THttpRequest
{
    protected Array $request = [];
    protected String $operation = "";

    public function setRequest(Request &$request)
    {
        $this->request = $request->all();

        $this->loadHttpFilters();
        $this->loadHttpAggregate();

        if (isset($this->request["id"]) && $this->request["id"] != '0') {
            $this->openModelInstance($this->request["id"]);
        } else {
            unset($this->request['id']);

            $this->operation = EOperation::CREATE;
        }

        return $this;
    }

    public function importRequest(Array $request)
    {
        $this->request = $request;

        $this->loadHttpFilters();
        $this->loadHttpAggregate();

        if (isset($this->request["id"]) && $this->request["id"] != '0') {
            $this->openModelInstance($this->request["id"]);
        } else {
            unset($this->request['id']);

            $this->operation = EOperation::CREATE;
        }

        return $this;
    }

    private function loadHttpFilters() {
        if (method_exists($this, 'executeFilters')) {
            $this->filtersRequest = isset($this->request['filters']) && count($this->request['filters']) > 0 ? $this->request['filters'] : [];
        }
    }

    private function loadHttpAggregate() {
        if (method_exists($this, 'executeAggregate') && isset($this->request['with'])) {
            $this->with = isset($this->request['with']) && count($this->request['with']) > 0 ? $this->request['with'] : [];
        }
    }

    protected function openModelInstance($id)
    {
        if (method_exists($this, 'defineAggregate')) {
            $this->defineAggregate();
        }

        $this->data = $this->instance->find($id);

        if (empty($this->data)) {
            throw new ErrorServiceException("Não foi possível encontrar os dados na base de dados!");
        }

        $this->operation = EOperation::UPDATE;
    }
}
