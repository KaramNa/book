<?php

namespace App\Http\Controllers;

use DOMXPath;
use DOMDocument;
use App\Models\Book;
use GuzzleHttp\Client;

class SingleBookController extends Controller
{
    public function index($slug)
    {

        $book = Book::get()->where("slug", $slug)->first();

        $url = $book->download_link;

        if ($url) {
            $httpClient = new Client();
            $response = $httpClient->get($url);
            $htmlString = (string) $response->getBody();
            libxml_use_internal_errors(true);
            $doc = new DOMDocument();
            $doc->loadHTML($htmlString);
            $xpath = new DOMXPath($doc);
            $download_link = $xpath->evaluate('//a[@class="btn-down"]');
            foreach ($download_link as $link) {
                $d_link = 'https://www.dbooks.org' . $link->attributes['href']->value;
            }
        } else {
            $d_link = Book::find($book->id)->download_link2;
        }

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
            "shareComponent" => $shareComponent,
            "d_link" => $d_link
        ]);
    }
}
