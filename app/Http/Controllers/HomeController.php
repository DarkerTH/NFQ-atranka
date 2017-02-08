<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    */

    public function showIndex(Request $request){

        $sortBy = 'title';
        $order = 'asc';
        if ($request->has('sortBy')){
            // Sorting
            $sortBy = strtolower($request->input('sortBy'));
            $order = $request->has('order') ? strtolower($request->input('order')) : 'asc';

            if (!in_array($sortBy, ['title', 'year', 'genre', 'author']) || !in_array($order, ['asc', 'desc'])){
                return redirect('/');
            }

        }

        if ($order == "asc"){
            $invertOrder = "desc";
        } else {
            $invertOrder = "asc";
        }

        if ($request->has('query')) {
            // Display search results
            $searchString = $request->input('query');
            $books = \App\Book::where('author', 'LIKE', '%'.$searchString.'%')
                ->orWhere('title', 'LIKE', '%'.$searchString.'%')
                ->orWhere('year', 'LIKE', '%'.$searchString.'%')
                ->orWhere('genre', 'LIKE', '%'.$searchString.'%');

            $books = $books->orderBy($sortBy, $order);

            $books = $books->paginate(15);

            return view('search-results', ['books' => $books, 'string' => $searchString, 'invertOrder' => $invertOrder, 'order' => $order, 'sortBy' => $sortBy]);

        } else {
            // Display index page
            $books = \App\Book::orderBy($sortBy, $order);

            $books = $books->paginate(15);

            return view('welcome', ['books' => $books, 'string' => '', 'invertOrder' => $invertOrder, 'order' => $order, 'sortBy' => $sortBy]);
        }
    }

    public function showBook($id, Request $request){
        $book = \App\Book::find($id);
        if (!$book)
            return redirect('/');

        $referral = $request->has('r') ? $request->input('r') : '';

        return view('book', ['book' => $book, 'r' => $referral]);
    }

}
