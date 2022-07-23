<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourtResource;
use App\Laravue\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CourtController extends Controller
{
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $courtQuery = Court::query();
        $limit = Arr::get($searchParams, 'limit');
        $keyword = Arr::get($searchParams, 'keyword', '');
        if(!empty($keyword)){
            $courtQuery->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return CourtResource::collection($courtQuery->orderBy('id', 'desc')->paginate($limit));
    }

    public function store(Request $request)
    {
        Court::create(['name' => $request->name]);
    }


    public function update(Request $request, Court $court)
    {
        return $court->update(['name' => $request->name]);
    }

    public function destroy(Court $court)
    {
        return $court->delete();
    }
}
