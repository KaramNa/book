<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class AddBookController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("add-book", [
            "categories" => $categories
        ]);
    }

    public function store()
    {
        $attributes =  request()->validate([
            "title" => "required",
            "qoute" => "required",
            "author" => "required",
            "poster" => "required|image",
            "description" => "required",
            "category" => "required",
            "publisher" => "required",
            "published" => "required",
            "pages" => "required",
            "PDF_size" => "required",
            "download_link2" => "required",
        ]);

        $attributes["slug"] = strtolower(str_replace(" ", "-", $attributes["title"]));
        $attributes["category_slug"] = strtolower(str_replace(" ", "-", $attributes["category"]));
        $attributes["author"] = "by " . $attributes["author"];
        $attributes["poster"] = "/storage/" . request()->file("poster")->store("posters", "public");
        $attributes["PDF_size"] .= " MB";
        Book::create($attributes);

        return back()->with("success", "Book has been added");
    }


    public function edit($id)
    {
        $categories = Category::all();
        $book = Book::find($id);
        return view("edit-book", [
            "categories" => $categories,
            "book" => $book
        ]);
    }

    public function update($id)
    {
        $book = Book::find($id);
        $attributes =  request()->validate([
            "title" => "required",
            "qoute" => "",
            "author" => "required",
            "poster" => "image",
            "description" => "required",
            "category" => "required",
            "publisher" => "required",
            "published" => "required",
            "pages" => "required",
            "PDF_size" => "required",
            "language" => "required",
        ]);

        $attributes["title_slug"] = strtolower(str_replace(" ", "-", $attributes["title"]));
        $attributes["category_slug"] = strtolower(str_replace(" ", "-", $attributes["category"]));
        if (isset($attributes["poster"]))
            $attributes["poster"] = "/storage/" . request()->file("poster")->store("posters", "public");

        $book->update($attributes);

        return back()->with("success", "Book has been updated");

    }

    public function delete($id){
        $book = Book::find($id);
        $book->delete();
        return redirect(route("home"));
    }
}
