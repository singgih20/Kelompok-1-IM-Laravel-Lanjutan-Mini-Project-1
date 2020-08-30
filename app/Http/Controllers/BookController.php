<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::get();

        return response()->json(['status' => 'success', 'data' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = Book::create([
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'description' => request('description'),
            'author' => request('author'),
            'publisher' => request('publisher'),
            'price' => request('price'),
            'stock' => request('stock'),
            'created_by' => Auth::user()->name
        ]);

        return response()->json(['status' => 'success', 'data' => $book]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $book;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->update([
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'description' => request('description'),
            'author' => request('author'),
            'publisher' => request('publisher'),
            'price' => request('price'),
            'stock' => request('stock')
        ]);

        return response()->json(['status' => 'success', 'data' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json('Book Deleted', 200);
    }
}
