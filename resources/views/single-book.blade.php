<?php

use App\Models\Book;
use GuzzleHttp\Client;

$url = Book::find($book->id)->download_link;
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
}else {
    $d_link = Book::find($book->id)->download_link2;
}

?>


@extends('layouts.app')

@section("share_image", "$book->poster")
@section("book_url", request()->url())
@section("book_desc", "$book->title")
@section("book_title", "$book->title")

@section('content')
    {{-- <div style="width:100%;margin-bottom:10px">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3490904183682637" crossorigin="anonymous"></script><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-3490904183682637" data-ad-slot="5374661124" data-ad-format="auto" data-full-width-responsive="true"></ins>
            </div> --}}

    <div class="wrap">
        <div class="col100">
            <h1 class="wine-color">{{ $book->title }}</h1>
            <h2 class="mt-3">{{ $book->qoute }}</h2>
            <p><b>{{ $book->author }}</b></p>
        </div>
        <div class="col300 action">
            <div class="box1">
                {{-- <form action="" method="POST">
                    <button title="Download PDF" class="btn-down" type="submit" name="download"><i
                            class="fas fa-download"></i> Free download
                    </button>
                </form> --}}
                <a href="<?php echo $d_link; ?>" class="btn-down"  target="_blank"><i class="fas fa-download"></i> Free download</a>
            </div>
            @auth
                <div>
                    <a href="{{ route('edit.book', $book) }}" class="btn-down mt-3"><i class="far fa-edit text-white me-4"></i>
                        Edit</a>
                </div>
                <div x-data="{ show: false}">
                    <div>
                        <button type="button" class="btn-down mt-3 text-start" @click="show = true"><i
                                class="fas fa-trash text-white me-4"></i>Delete</button>
                    </div>
                    <div x-show="show">
                        <p class="mb-0 mt-3">Do You really want to delete this book?!</p>
                        <form action="{{ route('delete.book', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger mt-3 text-start"><i
                                    class="fas fa-trash text-white me-4"></i>Yes</button>
                            <button type="button" class="btn btn-primary mt-3 text-start" @click="show = false"><i
                                    class="fas fa-trash text-white me-4"></i>No</button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
    <div class="wrap mt30">
        <div class="col300 center"> <img src="{{ $book->poster }}" alt="Remote Sensing of Plant Biodiversity"
                class="img">
            <div class="soc">
                 {!! $shareComponent !!}
            </div>
        </div>
        <div class="col100 txt">
            <a href="#description" id="a_description" onclick="return tab('description')" class="btn-menu active"
                title="Book Description">
                <span class="mobi1">Description</span>
                <span class="mobi2"><i class="icon-book"></i></span>
            </a>
            <a href="#details" id="a_details" onclick="return tab('details')" class="btn-menu" title="Book Details">
                <span class="mobi1">Details</span>
                <span class="mobi2"><i class="icon-info"></i></span>
            </a>
            <div class="tabin">
                <a id="description"></a>
                <div id="t_description" class="tab active">
                    {{ $book->description }}
                </div> <a id="details"></a>
                <div id="t_details" class="tab">
                    <h3>Book Details</h3>
                    <div>
                        <span class="info1">Category: </span>
                        <span class="info2">{{ $book->category }}</span>
                    </div>
                    <div>
                        <span class="info1">Publisher: </span>
                        <span class="info2">{{ $book->publisher }}</span>
                    </div>
                    <div>
                        <span class="info1">Published: </span>
                        <span class="info2">{{ $book->published }}</span>
                    </div>
                    <div>
                        <span class="info1">Pages: </span>
                        <span class="info2">{{ $book->pages }}</span>
                    </div>
                    <div>
                        <span class="info1">Language: </span>
                        <span class="info2">{{ $book->language }}</span>
                    </div>
                    <div>
                        <span class="info1">PDF Size: </span>
                        <span class="info2">{{ $book->PDF_size }}</span>
                    </div>
                </div>

                <script>
                    function tab(a) {
                        a = a.replace("#", "");
                        if (!['description', 'details'].includes(a)) {
                            return false;
                        }
                        var menuElements = document.getElementsByClassName('btn-menu');
                        for (var i = 0; i < menuElements.length; i++) {
                            menuElements[i].classList.remove('active');
                            var id = menuElements[i].getAttribute('id');
                            id = id.replace("a_", "t_");
                            document.getElementById(id).classList.remove('active');
                        }
                        document.getElementById("a_" + a).classList.add('active');
                        document.getElementById("t_" + a).classList.add('active');
                        return false;
                    }
                    if (window.location.hash) {
                        tab(window.location.hash);
                    }
                </script>
            </div>
            <div style="width:100%;margin-bottom: 10px"><ins class="adsbygoogle" style="display:block"
                    data-ad-client="ca-pub-3490904183682637" data-ad-slot="7831952431" data-ad-format="auto"
                    data-full-width-responsive="true"></ins></div>
            <script>
                [].forEach.call(document.querySelectorAll('.adsbygoogle'), function() {
                    (adsbygoogle = window.adsbygoogle || []).push({});
                });
            </script>
            <h3 class="text-dark">Related Books</h3>
            <div class="grid m">
                @foreach ($relatedBooks as $relatedBook)
                    <div class="item"><a href="{{ route('single.book', $relatedBook->slug) }}"
                            title="{{ $relatedBook->title }}"><img data-src="{{ $relatedBook->poster }}"
                                src="{{ $relatedBook->poster }}" class="lazyload img"
                                alt="{{ $relatedBook->title }}"></a>
                        <div class="pad"><a href="{{ route('single.book', $relatedBook->slug) }}"
                                title="{{ $relatedBook->title }}">{{ $relatedBook->title }}</a></div>
                        <div class="h">{{ $relatedBook->description }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @stop
