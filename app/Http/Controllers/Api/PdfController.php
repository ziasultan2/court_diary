<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Laravue\Models\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        return response()->json(['success' => true, 'data' => Pdf::all()]);
    }

    public function store(Request $request)
    {
        return Pdf::create($request->all());
    }

    public function destroy($id)
    {
        return Pdf::find($id)->delete();
    }
}
