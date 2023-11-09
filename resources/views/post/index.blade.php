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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 mb-4">
                        <a href="{{ route('admin.post.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Create
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-default">
                            <div class="card-header bg-maroon">
                                <h5 class="card-title">Post Data Table</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="post-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ $post->category->category_name }}</td>
                                                    <td>{{ $post->user->name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.post.edit', $post->id) }}"
                                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.post.show', $post->id) }}"
                                                            class="btn btn-sm btn-outline-secondary" title="Edit">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('admin.post.destroy', $post->id) }}"
                                                            method="POST" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger confirm-delete"
                                                                title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
            // datatable
            $('#post-table').DataTable({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
