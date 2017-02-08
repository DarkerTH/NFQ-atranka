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

        $sort = false;
        $order = 'asc';
        if ($request->has('sortBy')){
            // Sorting
            $sortBy = strtolower($request->input('sortBy'));
            $order = $request->has('order') ? strtolower($request->input('order')) : 'asc';

            if (!in_array($sortBy, ['title', 'year', 'genre', 'author']) || !in_array($order, ['asc', 'desc'])){
                return redirect('/');
            }

            $sort = true;
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

            if ($sort){
                $books = $books->orderBy($sortBy, $order);
            } else {
                $books = $books->inRandomOrder();
            }

            $books = $books->paginate(15);

            return view('search-results', ['books' => $books, 'string' => $searchString, 'order' => $invertOrder]);

        } else {
            // Display index page
            if ($sort){
                $books = \App\Book::orderBy($sortBy, $order);
            } else {
                $books = \App\Book::inRandomOrder();
            }

            $books = $books->paginate(15);

            return view('welcome', ['books' => $books, 'string' => '', 'order' => $invertOrder]);
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
