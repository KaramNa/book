<?php

use App\Models\Book;
use GuzzleHttp\Client;

$url = Book::find($book->id)->download_link;
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

?>


@extends('layouts.app')

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
                <a href="<?php echo $d_link; ?>" class="btn-down"><i class="fas fa-download"></i> Free download</a>
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
            <div class="soc"><a
                    href="https://www.facebook.com/dialog/feed?app_id=949968665460103&amp;display=page&amp;caption=Remote+Sensing+of+Plant+Biodiversity&amp;link=https://www.dbooks.org/remote-sensing-of-plant-biodiversity-3030331571/&amp;redirect_uri=https://www.dbooks.org/remote-sensing-of-plant-biodiversity-3030331571/"
                    title="Share to Facebook" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img"
                        class="facebook">
                        <title>Share to Facebook</title>
                        <g>
                            <path
                                d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z"
                                fill-rule="evenodd"></path>
                        </g>
                    </svg></a><a
                    href="https://twitter.com/share?url=https://www.dbooks.org/remote-sensing-of-plant-biodiversity-3030331571/&amp;text=Remote+Sensing+of+Plant+Biodiversity&amp;via=dbooksorg"
                    title="Share to Twitter" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img"
                        class="twitter">
                        <title>Share to Twitter</title>
                        <g>
                            <path
                                d="M27.996 10.116c-.81.36-1.68.602-2.592.71a4.526 4.526 0 0 0 1.984-2.496 9.037 9.037 0 0 1-2.866 1.095 4.513 4.513 0 0 0-7.69 4.116 12.81 12.81 0 0 1-9.3-4.715 4.49 4.49 0 0 0-.612 2.27 4.51 4.51 0 0 0 2.008 3.755 4.495 4.495 0 0 1-2.044-.564v.057a4.515 4.515 0 0 0 3.62 4.425 4.52 4.52 0 0 1-2.04.077 4.517 4.517 0 0 0 4.217 3.134 9.055 9.055 0 0 1-5.604 1.93A9.18 9.18 0 0 1 6 23.85a12.773 12.773 0 0 0 6.918 2.027c8.3 0 12.84-6.876 12.84-12.84 0-.195-.005-.39-.014-.583a9.172 9.172 0 0 0 2.252-2.336"
                                fill-rule="evenodd"></path>
                        </g>
                    </svg></a><a
                    href="https://reddit.com/submit?url=https://www.dbooks.org/remote-sensing-of-plant-biodiversity-3030331571/&amp;title=Remote+Sensing+of+Plant+Biodiversity"
                    title="Share to Reddit" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img"
                        class="reddit">
                        <title>Share to Reddit</title>
                        <g>
                            <path
                                d="M27 15.5a2.452 2.452 0 0 1-1.338 2.21c.098.38.147.777.147 1.19 0 1.283-.437 2.47-1.308 3.563-.872 1.092-2.06 1.955-3.567 2.588-1.506.634-3.143.95-4.91.95-1.768 0-3.403-.316-4.905-.95-1.502-.632-2.69-1.495-3.56-2.587-.872-1.092-1.308-2.28-1.308-3.562 0-.388.045-.777.135-1.166a2.47 2.47 0 0 1-1.006-.912c-.253-.4-.38-.842-.38-1.322 0-.678.237-1.26.712-1.744a2.334 2.334 0 0 1 1.73-.726c.697 0 1.29.26 1.78.782 1.785-1.258 3.893-1.928 6.324-2.01l1.424-6.467a.42.42 0 0 1 .184-.26.4.4 0 0 1 .32-.063l4.53 1.006c.147-.306.368-.553.662-.74a1.78 1.78 0 0 1 .97-.278c.508 0 .94.18 1.302.54.36.36.54.796.54 1.31 0 .512-.18.95-.54 1.315-.36.364-.794.546-1.302.546-.507 0-.94-.18-1.295-.54a1.793 1.793 0 0 1-.533-1.308l-4.1-.92-1.277 5.86c2.455.074 4.58.736 6.37 1.985a2.315 2.315 0 0 1 1.757-.757c.68 0 1.256.242 1.73.726.476.484.713 1.066.713 1.744zm-16.868 2.47c0 .513.178.95.534 1.315.356.365.787.547 1.295.547.508 0 .942-.182 1.302-.547.36-.364.54-.802.54-1.315 0-.513-.18-.95-.54-1.31-.36-.36-.794-.54-1.3-.54-.5 0-.93.183-1.29.547a1.79 1.79 0 0 0-.54 1.303zm9.944 4.406c.09-.09.135-.2.135-.323a.444.444 0 0 0-.44-.447c-.124 0-.23.042-.32.124-.336.348-.83.605-1.486.77a7.99 7.99 0 0 1-1.964.248 7.99 7.99 0 0 1-1.964-.248c-.655-.165-1.15-.422-1.486-.77a.456.456 0 0 0-.32-.124.414.414 0 0 0-.306.124.41.41 0 0 0-.135.317.45.45 0 0 0 .134.33c.352.355.837.636 1.455.843.617.207 1.118.33 1.503.366a11.6 11.6 0 0 0 1.117.056c.36 0 .733-.02 1.117-.056.385-.037.886-.16 1.504-.366.62-.207 1.104-.488 1.456-.844zm-.037-2.544c.507 0 .938-.182 1.294-.547.356-.364.534-.802.534-1.315 0-.505-.18-.94-.54-1.303a1.75 1.75 0 0 0-1.29-.546c-.506 0-.94.18-1.3.54-.36.36-.54.797-.54 1.31s.18.95.54 1.315c.36.365.794.547 1.3.547z"
                                fill-rule="evenodd"></path>
                        </g>
                    </svg></a><a
                    href="https://www.linkedin.com/shareArticle?url=https://www.dbooks.org/remote-sensing-of-plant-biodiversity-3030331571/&amp;title=Remote+Sensing+of+Plant+Biodiversity"
                    title="Share to LinkedIn" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img"
                        class="linkedin">
                        <title>Share to LinkedIn</title>
                        <g>
                            <path
                                d="M26 25.963h-4.185v-6.55c0-1.56-.027-3.57-2.175-3.57-2.18 0-2.51 1.7-2.51 3.46v6.66h-4.182V12.495h4.012v1.84h.058c.558-1.058 1.924-2.174 3.96-2.174 4.24 0 5.022 2.79 5.022 6.417v7.386zM8.23 10.655a2.426 2.426 0 0 1 0-4.855 2.427 2.427 0 0 1 0 4.855zm-2.098 1.84h4.19v13.468h-4.19V12.495z"
                                fill-rule="evenodd"></path>
                        </g>
                    </svg></a><a
                    href="https://www.pinterest.com/pin/create/button/?url=https://www.dbooks.org/remote-sensing-of-plant-biodiversity-3030331571/&amp;media=https://www.dbooks.org/img/books/3030331571.jpg&amp;description=Remote+Sensing+of+Plant+Biodiversity"
                    title="Share to Pinterest" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img"
                        class="pinterest">
                        <title>Share to Pinterest</title>
                        <g>
                            <path
                                d="M7 13.252c0 1.81.772 4.45 2.895 5.045.074.014.178.04.252.04.49 0 .772-1.27.772-1.63 0-.428-1.174-1.34-1.174-3.123 0-3.705 3.028-6.33 6.947-6.33 3.37 0 5.863 1.782 5.863 5.058 0 2.446-1.054 7.035-4.468 7.035-1.232 0-2.286-.83-2.286-2.018 0-1.742 1.307-3.43 1.307-5.225 0-1.092-.67-1.977-1.916-1.977-1.692 0-2.732 1.77-2.732 3.165 0 .774.104 1.63.476 2.336-.683 2.736-2.08 6.814-2.08 9.633 0 .87.135 1.728.224 2.6l.134.137.207-.07c2.494-3.178 2.405-3.8 3.533-7.96.61 1.077 2.182 1.658 3.43 1.658 5.254 0 7.614-4.77 7.614-9.067C26 7.987 21.755 5 17.094 5 12.017 5 7 8.15 7 13.252z"
                                fill-rule="evenodd"></path>
                        </g>
                    </svg></a><a
                    href="https://www.google.com/bookmarks/mark?op=edit&amp;bkmk=https://www.dbooks.org/remote-sensing-of-plant-biodiversity-3030331571/&amp;title=Remote+Sensing+of+Plant+Biodiversity&amp;labels=freebook,openbook"
                    title="Add to Google Bookmarks" target="_blank" rel="noreferrer"><svg xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img"
                        class="google">
                        <title>Add to Google Bookmarks</title>
                        <g>
                            <path
                                d="M16.213 13.998H26.72c.157.693.28 1.342.28 2.255C27 22.533 22.7 27 16.224 27 10.03 27 5 22.072 5 16S10.03 5 16.224 5c3.03 0 5.568 1.09 7.51 2.87l-3.188 3.037c-.808-.748-2.223-1.628-4.322-1.628-3.715 0-6.745 3.024-6.745 6.73 0 3.708 3.03 6.733 6.744 6.733 4.3 0 5.882-2.915 6.174-4.642h-6.185V14z"
                                fill-rule="evenodd"></path>
                        </g>
                    </svg></a></div>
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
