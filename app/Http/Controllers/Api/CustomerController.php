<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Laravue\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $courtQuery = Customer::query();
        $limit = Arr::get($searchParams, 'limit');
        $keyword = Arr::get($searchParams, 'keyword', '');
        if(!empty($keyword)){
            $courtQuery->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return CustomerResource::collection($courtQuery->orderBy('id', 'desc')->paginate($limit));
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
