<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AddBookController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("add-book", [
            "categories" => $categories,
        ]);
    }

    public function store()
    {
        if (request()->has("store")) {
            $attributes =  request()->validate([
                "title" => "required",
                "qoute" => "required",
                "author" => "required",
                "poster" => "image",
                "description" => "required",
                "category" => "required",
                "publisher" => "required",
                "published" => "required",
                "pages" => "required",
                "PDF_size" => "required",
                "language" => "required",
                "download_link2" => "required",
            ]);
            $slug = str_replace(["#", "?"], "", $attributes["title"]);
            $slug = str_replace(":", " ", $slug);
            $attributes["slug"] = strtolower(str_replace(" ", "-", $slug));
            $attributes["category_slug"] = strtolower(str_replace(" ", "-", $attributes["category"]));
            $attributes["author"] = "by " . $attributes["author"];
            if (request()->file("poster"))
                $attributes["poster"] = "/storage/" . request()->file("poster")->store("posters", "public");
            else
                $attributes["poster"] = "/storage/" . request("image_url");

            Book::create($attributes);

            return back()->with("success", "Book has been added");
        }
        if (request()->has("fill")) {
            $url = request()->validate([
                "url" => "required"
            ]);

            $httpClient = new Client();
            $response = $httpClient->request(
                'GET',
                $url["url"]
            );
            $title = addslashes($response->evaluate('//h1')->text());
            $description = addslashes($response->evaluate('//div[@id="desc"]')->text());
            $publisher = $response->evaluate('//table[@class="table table-striped"]//td[@itemprop="publisher"]//b')->text();
            $pages = $response->evaluate('//table[@class="table table-striped"]//b[@itemprop="numberOfPages"]')->text();
            $language = $response->evaluate('//table[@class="table table-striped"]//b[@itemprop="inLanguage"]')->text();
            $published = $response->evaluate('//table[@class="table table-striped"]//td//a')->text();
            $qouteNum = $response->filter("h2")->count();
            if ($qouteNum > 0) {
                $qoute = addslashes($response->filter('h2')->text());
            } else {
                $qoute = "";
            }
            $author = $response->filter('td.t50')->siblings()->text();
            $image_name = "posters/" .  basename($response->evaluate('//img[@class="imgborder"]')->extract(["src"])[0]);
            $poster = "https://itbook.store" . $response->evaluate('//img[@class="imgborder"]')->extract(["src"])[0];
            Storage::disk('local')->put("public/" . $image_name, file_get_contents($poster));

            $categories = Category::all();
            $details["title"] = $title;
            $details["description"] = $description;
            $details["publisher"] = $publisher;
            $details["pages"] = $pages;
            $details["language"] = $language;
            $details["published"] = $published;
            $details["qoute"] = $qoute;
            $details["author"] = $author;
            $details["image_url"] = $image_name;

            return view("add-book", [
                "categories" => $categories,
                "details" => $details
            ]);
        }
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
        $attributes["download_link2"] = request("download_link2");
        $book->update($attributes);

        return back()->with("success", "Book has been updated");
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect(route("home"));
    }
}
