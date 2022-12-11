<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorServiceException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\AuthService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
            'user_type_id' => 'required|integer',
        ]);

        $credentials = $request->only(['email', 'password', 'user_type_id']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh(): ?array
    {
        return $this->token(auth()->refresh());
    }

    protected function token($token): array
    {
        $auth = auth()->user();
        $user = User::with('userType')->find($auth->id);

        if ($user) {
            $user->last_login = new DateTime('now');
            $user->save();
        }
        
        Log::info($user->toArray());

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'token_validity' => auth()->guard()->factory()->getTTL(),
            'user' => $user,
        ];
    }
}
