<?php

namespace App\BaseRepository\Crud;

use DateTime;

trait TDestroy {

    public function destroy()
    {
        try {
            $this->modelClassInstance->deleted_at = new DateTime('now');
            $this->modelClassInstance->save();
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}