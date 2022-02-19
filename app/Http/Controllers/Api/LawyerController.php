<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LawyerResource;
use App\Laravue\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LawyerController extends Controller
{
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $courtQuery = Lawyer::query();
        $limit = Arr::get($searchParams, 'limit');
        $keyword = Arr::get($searchParams, 'keyword', '');
        if(!empty($keyword)){
            $courtQuery->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return LawyerResource::collection($courtQuery->orderBy('id', 'desc')->paginate($limit));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
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
