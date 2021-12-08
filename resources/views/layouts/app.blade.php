<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDFs Books - Free download books</title>
    <meta name="description" content="pdfsbooks.com online library Free download ebooks (pdf)">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="fb:app_id" content="1234123121432132121">
    <meta property="og:site_name" content="pdfsbooks.com">
    <meta property="og:title" content="@yield("book_title", "PDFsBOOks")">
    <meta property="og:description" content="Free download (PDF) @yield("book_desc")">
    <meta property="og:url" content="@yield("book_url", "https://pdfsbooks.com")">
    <meta name="thumbnail" content="@yield("share_image", asset('images/main_photo.jpg'))" >
    <meta property="og:image" content="@yield("share_image", asset('images/main_photo.jpg'))" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta property="og:type" content="website">
    <link rel="canonical" href="@yield("book_url", "https://pdfsbooks.com")">
    <link rel="alternate" type="application/rss+xml" title="pdfsbooks.com"
        href="https://feeds.feedburner.com/pdfsbooks">
    {{-- <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/favicon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/favicon-180x180.png"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=').time() }}">
    <meta name="theme-color" content="#fff">
    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.5.1/dist/cdn.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-192921243-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-192921243-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KRY9G4D4WQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PBFEB4TVQS');
</script>
</head>

<body>
    <header>
        <div class="main wrap">
            <div class="col300 logo">
                <a href="{{ route('home') }}" title="pdfsbooks.com" rel="home" class="logo"><img
                        src="{{ asset('images/logo.png') }}" width="200" alt="pdfsbooks"></a>
            </div>
            <div class="col100 se">
                <form action="{{ route('home') }}" method="get" role="search" class="d-flex">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request("category") }}">
                    @endif
                    <input
                        class="inp" name="search" autocomplete="off" placeholder="Search Books" type="search"
                        value="{{ request('search') }}" required><button aria-label="submit" class="sbm"
                        type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="col300 icon">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
            @auth

                <div class="col300 icon"><a href="javascript:nav(true)" title="Menu"><i class="fas fa-bars"></i></a>
                </div>
            @endauth
        </div>
        @auth

            <div id="overlay" onclick="nav(false)"></div>
            <nav>
                <div id="menu">
                    <a href="javascript:nav(false)" class="button-close">&times;</a>
                    <a href="{{ route('add.category') }}" rel="home" title="pdfsbooks">Add Category</a>
                    <a href="{{ route('add.book') }}" rel="search" title="Search Books">Add Book</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button id="logout" type="submit" rel="search" title="Search Books"
                            class="border-0 bg-transparent text-white pl-32">Logout</button>
                    </form>
                </div>
            </nav>
        @endauth

    </header>
    <script>
        function nav(a) {
            if (a) {
                document.getElementById("menu").classList.add('active');
                document.getElementById("overlay").style.display = "block";
            } else {
                document.getElementById("menu").classList.remove('active');
                document.getElementById("overlay").style.display = "none";
            }
        }
    </script>
    <main>
        <div class="main">
            @yield("content")
        </div>
    </main>
    <footer>
        <div class="main wrap">
            <div class="col100">
                <a href="https://www.facebook.com/FreeBooks" title="Follow us on Facebook" target="_blank"
                    rel="noreferrer">FOLLOW US ON FACEBOOK.COM
                </a>
            </div>
            <div class="col100">
                <div class="text-sm-end text-center"><small><b>pdfsbooks.com &copy; 2020-2021</b></small></div>
            </div>
        </div>
    </footer>
<script type="text/javascript">
    var adfly_id = 26088345;
    var adfly_advert = 'int';
    var popunder = true;
    var domains = ['dbooks.org'];
</script>
    <script src="https://cdn.adf.ly/js/link-converter.js?v=".time()></script>
</body>

</html>
