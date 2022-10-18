<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;

trait TCrud {
    use TCreate, TUpdate, TLoad, TDestroy;

    private function crudValidation()
    {
        if (!isset($this->request)) {
            throw new ErrorBaseRepositoryException("Parâmetros não definidos");
        }
    }
}