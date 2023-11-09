@extends('layouts.app')
@section('content')
    {{-- carousel --}}
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="margin-top: 80px">
            <ol class="carousel-indicators">
                @foreach ($postCarousels as $key => $postCarousel)
                    <li data-target="#carouselExampleCaptions" data-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($postCarousels as $key => $postCarousel)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $postCarousel->img) }}" class="d-block w-100 rounded" alt="img post"
                            height="450px">
                        <div class="carousel-caption d-none d-md-block">
                            <h4>
                                <a href="{{ route('post.read', $postCarousel->slug) }}"
                                    class="font-weight-bold text-decoration-none text-white">{{ $postCarousel->title }}</a>
                            </h4>
                            <p>
                                <a href="{{ route('category.show', $postCarousel->category->category_name) }}"
                                    class="font-weight-bold text-decoration-none h5">{{ $postCarousel->category->category_name }}</a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
    {{-- end carousel --}}
    {{-- content --}}
    <section class="mt-3">
        <div class="container">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                                <a href="{{ route('category.show', $post->category->category_name) }}"
                                    class="text-white text-decoration-none">
                                    {{ $post->category->category_name }} </a>
                            </div>
                            <img src="{{ asset('storage/' . $post->img) }}" class="card-img-top rounded" alt="img post"
                                height="200px" width="100%">
                            <div class="card-body">
                                <small class="text-muted">
                                    <p class="card-text mb-2"> Publish By : {{ $post->user->name }} |
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </small>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{!! $post->excerpt !!}</p>
                                <a href="{{ route('post.read', $post->slug) }}" class="btn btn-primary">Baca Selengkapnya
                                    &rightarrow;</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-end">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
