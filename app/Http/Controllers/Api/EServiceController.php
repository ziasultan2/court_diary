<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EServiceResource;
use App\Laravue\Models\EService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EServiceController extends Controller
{
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $courtQuery = EService::query();
        $limit = Arr::get($searchParams, 'limit');
        $keyword = Arr::get($searchParams, 'keyword', '');
        if(!empty($keyword)){
            $courtQuery->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return EServiceResource::collection($courtQuery->orderBy('id', 'desc')->paginate($limit));
    }

    public function store(Request $request)
    {
        $name = 'public/' . time() . $$request->file('photo')->getClientOriginalExtension();
        $photo = Storage::disk('public')->put($name, $request->file('photo'));
        return EService::create([
            'name' => $request->name,
            'photo' => $photo,
            'external_link' => $request->external_link,
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(EService $eService)
    {
        return $eService->delete();
    }
}
