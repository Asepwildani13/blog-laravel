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
                                <h5 class="card-title">Form Submit Post</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="title" class="col-sm-4 col-form-label">Title <b
                                                        class="text-danger">&ast;</b></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="title"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        placeholder="Enter title here">
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="slug" class="col-sm-4 col-form-label">Slug <b
                                                        class="text-danger">&ast;</b></label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="slug"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        placeholder="Enter slug here">
                                                    @error('slug')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label for="category_id" class="col-sm-4 col-form-label">Category <b
                                                        class="text-danger">&ast;</b></label>
                                                <div class="col-sm-8">
                                                    <select name="category_id" id="category"
                                                        class="form-control @error('category_id') is-invalid @enderror">
                                                        <option value="">Choose Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="img" class="col-sm-4 col-form-label">Image <b
                                                        class="text-danger">&ast;</b></label>
                                                <div class="col-sm-8">
                                                    <input type="file"
                                                        class="form-control-file @error('img') is-invalid @enderror"
                                                        name="img">
                                                    @error('img')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="content">Content <b class="text-danger">&ast;</b></label>
                                                <textarea name="content" id="content" rows="5" placeholder="Enter content here"
                                                    class="form-control @error('content') is-invalid @enderror"></textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fa fa-paper-plane"></i> Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
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

            // summernote text editor
            $('#content').summernote();
        });
    </script>
@endpush
