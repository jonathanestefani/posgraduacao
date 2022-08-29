<?php

namespace App\Http\Controllers;

use App\Exceptions\BaseRepositoryException;
use App\Models\Customer;
use App\Services\Customers\ListIndexService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        try {
            Log::info('adasdsdsa');

            (new ListIndexService(Customer::class))->setRequest($request)->execute();
        } catch (BaseRepositoryException $th) {
            
        } catch (\Throwable $th) {
            throw $th;
        }
        return response()->json($request->all());
    }
}
