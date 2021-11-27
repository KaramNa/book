@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-dark">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('add.book') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="my-2">
                        <label for="title">Book title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="qoute">Book qoute</label>
                        <input type="text" class="form-control" name="qoute" value="{{ old('qoute') }}">
                        @error('qoute')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="author">Book author</label>
                        <input type="text" class="form-control" name="author" value="{{ old('author') }}">
                        @error('author')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="poster">Book poster</label>
                        <input type="file" class="form-control" name="poster">
                        @error('poster')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="description">Book description</label>
                        <textarea type="text" class="form-control"
                            name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="Category">Book category</label>
                        <select class="form-control" name="category">
                            <option value="" selected>Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['name'] }}"
                                    {{ old('category') == $category['name'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="publisher">Book publisher</label>
                        <input type="text" class="form-control" name="publisher" value="{{ old('publisher') }}">
                        @error('publisher')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="published">Book published</label>
                        <input type="text" class="form-control" name="published" value="{{ old('published') }}">
                        @error('published')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="myw-2">
                        <label for="pages">Book pages</label>
                        <input type="text" class="form-control" name="pages" value="{{ old('pages') }}">
                        @error('pages')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="lanuage">Book language</label>
                        <input type="text" class="form-control" name="language" value="{{ old('language') }}">
                        @error('language')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="PDF_size">Book size</label>
                        <input type="text" class="form-control" name="PDF_size" value="{{ old('PDF_size') }}">
                        @error('PDF_size')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Add</button>
                </form>

            </div>
        </div>
    </div>
@stop
