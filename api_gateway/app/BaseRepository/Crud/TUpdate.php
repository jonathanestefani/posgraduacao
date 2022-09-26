<?php

namespace App\BaseRepository\Crud;

trait TUpdate {

    public function update()
    {
        try {
            $this->modelClassInstance->fill($this->request);
            $this->modelClassInstance->save();
            return $this->modelClassInstance->refresh();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function upsert($keys)
    {
        try {
            $this->modelClassInstance->upsert($this->request, $keys);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}