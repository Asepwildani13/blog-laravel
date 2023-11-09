@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Post</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 mb-4">
                        <a href="{{ route('admin.post.index') }}" class="btn btn-sm btn-dark">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-default">
                            <div class="card-header bg-maroon">
                                <h5 class="card-title">Detail Post</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $post->title }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="slug" class="form-control"
                                                    value="{{ $post->slug }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="img">Image</label>
                                            <img src="{{ asset('storage/' . $post->img) }}" alt="img post"
                                                class="img-rounded" style="width: 100%; height: 250px">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label for="category_id" class="col-sm-4 col-form-label">Category</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="category_id"
                                                    value="{{ $post->category->category_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="user_id" class="col-sm-4 col-form-label">Author</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="user_id" class="form-control"
                                                    value="{{ $post->user->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea name="content" rows="10" class="form-control" readonly>{{ $post->content }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')
    <script>
        $(function() {
            // select2
            $('#category').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
