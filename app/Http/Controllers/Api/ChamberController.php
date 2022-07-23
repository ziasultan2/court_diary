<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChamberResource;
use App\Laravue\Models\Chamber;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

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
        $file = Storage::disk('s3')->put('chambers', $request->file('cv'));
        Chamber::create([
            'name' => $request['name'],
            'designation' => $request['designation'],
            'joining_date' => $request['joining_date'],
            'cv' => $file,
            'mobile' => $request['mobile'],
            'salary' => $request['salary'],
            'type' => $request['type'],
            'comments' => $request['comments'],
            'working_days' => $request['working_days'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $chamber = Chamber::find($id);
        $chamber->update($request->all());
        return $chamber;
    }

    public function destroy($id)
    {
        $chamber = Chamber::find($id);
        $chamber->delete();
        return $chamber;
    }
}
