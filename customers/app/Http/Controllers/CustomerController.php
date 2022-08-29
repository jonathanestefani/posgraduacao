<?php

namespace App\Http\Controllers;

use App\Exceptions\BaseRepositoryException;
use App\Models\Customer;
use App\Services\Customers\DestroyService;
use App\Services\Customers\ListIndexService;
use App\Services\Customers\StoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        try {
            (new ListIndexService(Customer::class))->setRequest($request)->execute();
        } catch (BaseRepositoryException $th) {
            Log::info();
        } catch (\Throwable $th) {
            throw $th;
        }
        return response()->json($request->all());
    }

    public function store(Request $request)
    {
        try {
            (new StoreService(Customer::class))->setRequest($request)->execute();
        } catch (BaseRepositoryException $th) {
            
        } catch (\Throwable $th) {
            throw $th;
        }
        return response()->json($request->all());
    }

    public function destroy(Request $request)
    {
        try {
            (new DestroyService(Customer::class))->setRequest($request)->execute();
        } catch (BaseRepositoryException $th) {
            
        } catch (\Throwable $th) {
            throw $th;
        }
        return response()->json($request->all());
    }
}
