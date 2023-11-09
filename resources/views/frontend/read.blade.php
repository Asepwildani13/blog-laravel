@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <header class="mb-4">
                        <h1 class="font-weight-bolder mb-1">{{ $post->title }}</h1>
                        <div class="text-muted font-italic mb-2">
                            Published on {{ $post->created_at->diffForHumans() }} | By {{ $post->user->name }} |
                            <a href="{{ route('category.show', $post->category->category_name) }}"
                                class="text-decoration-none ">{{ $post->category->category_name }}</a>
                        </div>
                        <a href="#" class="badge bg-primary text-decoration-none link-light"></a>
                    </header>
                    <figure class="mb-4 figure">
                        <img src="{{ asset('storage/' . $post->img) }}" alt="img-post" class="figure-img img-fluid rounded"
                            style="width: 900px; height: 400px;">
                    </figure>
                    <section class="mb-5">
                        {!! $post->content !!}
                    </section>
                </article>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header text-white" style="background-color: #115e59">Category</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{ route('category.show', $category->category_name) }}"
                                                class="text-decoration-none">{{ $category->category_name }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
