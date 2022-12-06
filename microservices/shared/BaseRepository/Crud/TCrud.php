<?php

namespace App\BaseRepository\Crud;

use App\BaseRepository\Exceptions\ErrorBaseRepositoryException;
use App\BaseRepository\Exceptions\ErrorCrudValidationException;

trait TCrud {
    use TCreate, TUpdate, TLoad, TDestroy;

    // ICrudValidation
    private Array $validationList = [];

    public function addValidationList(Array $list) {
        $this->validationList = $list;
    }

    private function crudValidation()
    {
        if (!isset($this->request)) {
            throw new ErrorBaseRepositoryException("Parâmetros não definidos");
        }

        try {
            foreach ($this->validationList as $validation) {
                if ($validation instanceof ICrudValidation) {
                    $validation->execute();
                }
            }
        } catch (ErrorCrudValidationException $th) {
            throw $th;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}