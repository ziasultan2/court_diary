<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChamberResource;
use App\Laravue\Models\Chamber;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ChamberController extends Controller
{
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $courtQuery = Chamber::query();
        $limit = Arr::get($searchParams, 'limit');
        $keyword = Arr::get($searchParams, 'keyword', '');
        if(!empty($keyword)){
            $courtQuery->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return ChamberResource::collection($courtQuery->orderBy('id', 'desc')->paginate($limit));
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
