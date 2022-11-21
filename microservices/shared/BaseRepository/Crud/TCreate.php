<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Enum\EOperation;

trait TCreate {

    public function create()
    {
        try {
            $this->crudValidation();

            $this->beforeExecute(EOperation::CREATE);

            $this->data = $this->modelClass::create($this->request)->refresh();

            $this->afterExecute(EOperation::CREATE);

            return $this->data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}