<?php

namespace App\BaseRepository;

use Illuminate\Http\Request;

trait THttpRequest
{
    protected Array $request = [];

    public function setRequest(Request &$request)
    {
        $this->request = $request->all();

        if (method_exists($this, 'executeFilters')) {
            $this->filtersRequest = isset($this->request['filters']) && count($this->request['filters']) > 0 ? $this->request['filters'] : [];
        }

        return $this;
    }
}
