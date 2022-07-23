<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Laravue\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $searchParams = $request->all();
        $bookQuery = Book::query();
        $limit = Arr::get($searchParams, 'limit');
        $keyword = Arr::get($searchParams, 'keyword', '');
        if(!empty($keyword)){
            $bookQuery->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return BookResource::collection($bookQuery->orderBy('id', 'desc')->paginate($limit));
    }

    public function store(Request $request)
    {
        $path = Storage::disk('s3')->put('books/', $request->file('file'));
        return Book::create([
            'name' => $request->name,
            'path' => $path,
        ]);
    }

    public function destroy(Book $book)
    {
        Storage::disk('s3')->delete($book->path);
        return $book->delete();
    }
}
