<?php

namespace App\Services\User;

use App\BaseRepository\Abs\ARepository;
use App\BaseRepository\Crud\TCrud;
use App\BaseRepository\Enum\EOperation;
use App\BaseRepository\THttpRequest;
use App\Exceptions\ErrorServiceException;
use App\Models\User;
use App\Services\IServices\IService;
use Illuminate\Support\Facades\Log;

class StoreService extends ARepository implements IService
{
    use THttpRequest, TCrud;

    public function execute()
    {
        try {
            if (!empty($this->request['password'])) {
                $this->request['password'] = password_hash($this->request['password'], null);
            }

            switch ($this->operation) {
                case EOperation::CREATE:
                    $this->validUser();
                    return $this->create();
                    break;
                case EOperation::UPDATE:
                    return $this->update();
                    break;
            }
        } catch (\Throwable $th) {
            Log::error($th);

            throw $th;
        }

        throw new ErrorServiceException("Não foi possível definir o tipo de operação!");
    }

    private function validUser() {
        $user = User::where('email', $this->request['email'])->get();

        if (count($user) > 0) {
            throw new ErrorServiceException('Usuário já cadastrado com esse e-mail!');
        }
    }
}
