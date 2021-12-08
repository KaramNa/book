<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class BooksController extends Controller
{
    public function index()
    {

        $books = Book::filter(request(["search", "category"]))->latest()->paginate(20);
        $shareComponent = \Share::currentPage()
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();

        $currentCategory = str_replace("-", " ", request("category"));
        if ($currentCategory == "")
            $currentCategory = null;
        return view("index", [
            "books" => $books,
            "categories" => Category::all(),
            "currentCategory" => $currentCategory,
            "shareComponent" => $shareComponent

        ]);
    }
}
