@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mb-3" style="margin-top: 70px">{{ $title }}</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('category') }}" method="GET">
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" placeholder="Search..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-default text-white" type="submit"
                            style="background-color: #D81B60">Search</button>
                    </div>
                </form>
            </div>
        </div>
        @if ($categories)
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-12">
                            <h3 class="mb-3">{{ $category->category_name }}</h3>
                            <hr>
                            <div class="row">
                                @foreach ($category->post as $post)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="position-absolute px-2 py-1 text-white"
                                                style="background-color: rgba(0, 0, 0, 0.7)">
                                                {{ $post->category->category_name }}
                                            </div>
                                            <img src="{{ asset('storage/' . $post->img) }}" class="card-img-top img-rounded"
                                                alt="img blog" height="150" width="300">
                                            <div class="card-body">
                                                <small class="text-muted">
                                                    <p>
                                                        Publish By: {{ $post->user->name }} |
                                                        {{ $post->created_at->diffForHumans() }}
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
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-end">
                {{ $categories->links() }}
            </div>
        @else
            <p class="text-center h4">Posts not found</p>
        @endif
    </div>
@endsection
