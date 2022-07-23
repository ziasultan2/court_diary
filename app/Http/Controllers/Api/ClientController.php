<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Laravue\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $courtQuery = Client::query();
        $limit = Arr::get($searchParams, 'limit');
        $keyword = Arr::get($searchParams, 'keyword', '');
        if(!empty($keyword)){
            $courtQuery->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return ClientResource::collection($courtQuery->orderBy('id', 'desc')->paginate($limit));
    }

    public function store(Request $request)
    {
        Client::create($request->all());
    }

    public function show($id)
    {
        return new ClientResource(Client::find($id));
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->all());
        return $client;
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        return $client->delete();
    }
}
