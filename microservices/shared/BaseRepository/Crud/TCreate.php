<?php

namespace App\BaseRepository\Crud;

trait TCreate {

    public function create()
    {
        try {
            $this->crudValidation();
            $this->data = $this->modelClass::create($this->request)->refresh();
            return $this->data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}