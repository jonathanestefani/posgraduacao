<?php

namespace App\Services\Attendance\Ordenations;

trait TDefaultOrdenations
{
    public function executeOrder() {
        $this->instance->orderBy('id', 'desc');
    }
}
