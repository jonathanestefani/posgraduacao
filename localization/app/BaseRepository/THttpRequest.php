<?php

namespace App\BaseRepository;

use App\Exceptions\ErrorServiceBaseRepositoryException;
use Illuminate\Http\Request;

trait THttpRequest
{
    protected Array $request = [];
    protected String $operation = "";

    public function setRequest(Request &$request)
    {
        $this->request = $request->all();

        if (method_exists($this, 'executeFilters')) {
            $this->filtersRequest = isset($this->request['filters']) && count($this->request['filters']) > 0 ? $this->request['filters'] : [];
        }

        if (isset($this->request["id"]) && $this->request["id"] != '0') {
            $this->openModelInstance($this->request["id"]);
        } else {
            $this->operation = "create";
        }

        return $this;
    }

    protected function openModelInstance($id)
    {
        if (method_exists($this, 'defineAggregate')) {
            $this->defineAggregate();
        }

        $this->data = $this->instance->find($id);

        if (empty($this->data)) {
            throw new ErrorServiceBaseRepositoryException("Não foi possível encontrar os dados na base de dados!");
        }

        $this->operation = "update";
    }
}
