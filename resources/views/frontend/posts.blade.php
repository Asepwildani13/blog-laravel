@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mb-3" style="margin-top: 70px">{{ $title }}</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('post') }}" method="GET">
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" placeholder="Search..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-default text-white" type="submit"
                            style="background-color: #D81B60">Search</button>
                    </div>
                </form>
            </div>
        </div>
        @if ($posts->count())
            <div class="card mb-3">
                <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                    <a href="{{ route('category.show', $posts[0]->category->category_name) }}"
                        class="text-white text-decoration-none">
                        {{ $posts[0]->category->category_name }}
                    </a>
                </div>
                <img src="{{ asset('storage/' . $posts[0]->img) }}" alt="img post" class="card-img-top rounded"
                    width="100%" height="350px">
                <div class="card-body">
                    <small class="text-muted">
                        <p class="font-italic">
                            Publish By: {{ $posts[0]->user->name }} | {{ $posts[0]->created_at->diffForHumans() }}
                        </p>
                    </small>
                    <h5 class="card-title">{{ $posts[0]->title }}</h5>
                    <p class="card-text">{!! $posts[0]->excerpt !!}</p>
                    <a href="{{ route('post.read', $posts[0]->slug) }}" class="btn btn-sm btn-primary">Baca
                        Selengkapnya
                        &rightarrow;</a>
                </div>
            </div>
            {{-- allpost --}}
            <div class="container">
                <div class="row">
                    @foreach ($posts->skip(1) as $post)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                                    <a href="{{ route('category.show', $post->category->category_name) }}"
                                        class="text-white text-decoration-none">
                                        {{ $post->category->category_name }}
                                    </a>
                                </div>
                                <img src="{{ asset('storage/' . $post->img) }}" alt="img post" class="card-img-top rounded"
                                    height="200px">
                                <div class="card-body">
                                    <small class="text-muted">
                                        <p class="font-italic">
                                            Publish By: {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}
                                        </p>
                                    </small>
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text truncate">{!! $post->excerpt !!}</p>
                                    <a href="{{ route('post.read', $post->slug) }}" class="btn btn-primary">Baca
                                        Selengkapnya &rightarrow;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-end">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-center h4">Posts not found</p>
        @endif
    </div>
@endsection
