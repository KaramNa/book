<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class BooksController extends Controller
{
    public function index()
    {

        $books = Book::filter()->latest()->paginate(20);
        $currentCategory = str_replace("-", " ", request("category"));
        if ($currentCategory == "")
            $currentCategory = null;
        if (request("category"))
            $books = Book::category()->paginate(20);
        return view("index", [
            "books" => $books,
            "categories" => Category::all(),
            "currentCategory" => $currentCategory
        ]);
    }
}
