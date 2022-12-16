<?php

namespace App\Services\User;

use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\Services\StoreService as ServicesStoreService;
use App\Exceptions\ErrorServiceException;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class StoreService extends ServicesStoreService
{
    public function execute()
    {
        try {
            if (!empty($this->request['password'])) {
                $this->request['password'] = password_hash($this->request['password'], null);
            }

            if ($this->operation == EOperation::CREATE) {
                $this->validUser();
            }

            return parent::execute();
        } catch (\Throwable $th) {
            Log::error($th);

            throw $th;
        }

        throw new ErrorServiceException("Não foi possível definir o tipo de operação!");
    }

    private function validUser()
    {
        $user = User::where('email', $this->request['email']);
        
        if ($this->operation == EOperation::UPDATE) {
            $user->where('id', '!=', $this->data->id);
        }

        $user = $user->get();

        if (count($user) > 0) {
            throw new ErrorServiceException('Usuário já cadastrado com esse e-mail!');
        }
    }
}
