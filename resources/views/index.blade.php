@extends('layouts.app')

@section('content')
    <div class="title">
        <h1>Welcome to PDFsBooks Library</h1>
        <h2>Free download PDF books</h2>
        <div class="soc">
            {!! $shareComponent !!}
        </div>
        <div class="category mt-3">
            <div x-data="{ show: false }">
                <button class="py-2 px-5 rounded-pill small border-0 bg-dark text-white" @click="show = !show"
                    @click.away="show = false"><span
                        class="me-3">{{ isset($currentCategory) ? Str::headline($currentCategory) : 'Categories' }}</span> <i
                        class="fas fa-angle-down"></i></button>

                <div x-show="show"
                    class="bg-dark text-white overflow-auto rounded py-3 text-left m-auto mt-2 position-absolute"
                    style="width:300px; right:0; left:0; display:none; z-index:50; height:300px">
                    <a href="{{ route('home') }}"
                        class="d-block py-1 px-3 text-start">All Categories</a>

                    @foreach ($categories as $category)
                        <a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except("category")) }}"
                            class="d-block py-1 px-3 text-start {{ isset($currentCategory) && ($currentCategory === Str::lower($category->name)) ? 'active' : '' }}">{{ Str::headline($category->name) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="wrap index">
        <div class="col100">
            @if (count($books) > 0)
                <div class="grid">
                    @foreach ($books as $book)
                        <div class="item">
                            <a href="{{ route('single.book', $book->slug) }}"
                                title="Free Download {{ $book->title }}"><img data-src="{{ $book->title }}"
                                    src="{{ $book->poster }}" class="lazyload img" alt="{{ $book->title }}"></a>
                            <div class="pad"><a href="{{ route('single.book', $book->slug) }}"
                                    title="Free Download {{ $book->title }}">{{ $book->title }}</a></div>
                            <div class="h">{{ $book->description }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <h1 class="text-dark mt-5">Sorry, Nothing matches your criteria <i
                        class="fas fa-frown text-danger display-4"></i></h1>
            @endif

            {{ $books->withQueryString()->links() }}
        </div>
    </div>
@stop
