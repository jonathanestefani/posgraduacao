<?php

namespace App\BaseRepository\Crud;

trait TCreate {

    public function create()
    {
        try {
            $this->crudValidation();
            $this->modelClassInstance = $this->modelClass::create($this->request)->refresh();
            return $this->modelClassInstance;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}