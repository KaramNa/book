<?php

namespace App\Http\Controllers;

use App\Models\Book;

class SingleBookController extends Controller
{
    public function index($slug)
    {
        $book = Book::get()->where("slug", $slug)->first();
        $shareComponent = \Share::currentPage()
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()
        ->reddit();
        $relatedBooks = Book::get()->where("category_slug", $book->category_slug);
        if (count($relatedBooks) > 6)
            $relatedBooks = Book::get()->where("category_slug", $book->category_slug)->random(6);
        else
            $relatedBooks = Book::get()->where("category_slug", $book->category_slug)->random(count($relatedBooks));

        return view("single-book", [
            "book" => $book,
            "relatedBooks" => $relatedBooks,
            "shareComponent" => $shareComponent
        ]);
    }
}
