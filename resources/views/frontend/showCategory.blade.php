@extends('layouts.app')
@section('content')
    {{-- allpost --}}
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $category->category_name }}</h2>
            </div>
        </div>
    </div>
    {{-- end allpost --}}
    {{-- content --}}
    <section class="mt-3">
        <div class="container">
            <div class="row">
                @foreach ($category->post as $post)
                    <div class="col-lg-3">
                        <div class="card mb-4">
                            <img src="{{ asset('storage/' . $post->img) }}" class="card-img-top img-rounded" alt="img blog"
                                height="150" width="100%">
                            <div class="card-body">
                                <small class="text-muted">
                                    <p>
                                        Publish By: {{ $post->user->name }} | <a
                                            href="{{ route('category.show', $post->category->category_name) }}"
                                            class="badge text-white text-decoration-none bg-primary">{{ $post->category->category_name }}</a>
                                        | {{ $post->created_at->diffForHumans() }}
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
    </section>
@endsection
