<?php

namespace App\BaseRepository\Crud;

trait TUpdate {

    public function update()
    {
        try {
            $this->data->fill($this->request);
            $this->data->save();
            return $this->data->refresh();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function upsert($keys)
    {
        try {
            $this->modelClass::upsert($this->request, $keys);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}