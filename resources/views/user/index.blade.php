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
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
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
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus"></i> Create
                        </button>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-default">
                            <div class="card-header bg-maroon">
                                <h5 class="card-title">User Data Table</h5>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="user-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Created</th>
                                                <th>Role Name</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                                    <td>{{ $user->role->role_name }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ asset('storage/' . $user->img) }}" alt="User img"
                                                            class="img-circle" style="width: 60px; height: 60px">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            title="Edit" data-toggle="modal"
                                                            data-target="#editModal{{ $user->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                                                            method="POST" title="Delete" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger confirm-delete">
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        {{-- modal create --}}
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-maroon">
                        <h5 class="modal-title" id="myModalLabel">Create New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Name <b
                                        class="text-danger">&ast;</b></label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter name here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email <b
                                        class="text-danger">&ast;</b></label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Enter email here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Password <b
                                        class="text-danger">&ast;</b></label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter password here">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role_id" class="col-sm-4 col-form-label">Role Name <b
                                        class="text-danger">&ast;</b></label>
                                <div class="col-sm-8">
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">Choose Role Name</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="img" class="col-sm-4 col-form-label">Image <b
                                        class="text-danger">&ast;</b></label>
                                <div class="col-sm-8">
                                    <input type="file" name="img" id="img" class="form-control-file">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i> Close
                            </button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- modal edit --}}
        @foreach ($users as $user)
            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-maroon">
                            <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">Name <b
                                            class="text-danger">&ast;</b></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">Email <b
                                            class="text-danger">&ast;</b></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" id="email" class="form-control"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 col-form-label">Password <b
                                            class="text-danger">&ast;</b></label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" id="password" class="form-control"
                                            value="{{ $user->password }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role_id" class="col-sm-4 col-form-label">Role Name <b
                                            class="text-danger">&ast;</b></label>
                                    <div class="col-sm-8">
                                        <select name="role_id" id="role_id" class="form-control">
                                            <option value="{{ $user->role_id }}">{{ $user->role->role_name }}</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img" class="col-sm-4 col-form-label">Image <b
                                            class="text-danger">&ast;</b></label>
                                    <div class="col-sm-8">
                                        <input type="file" name="img" id="img" class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')
    <script>
        $(function() {
            // datatable
            $('#user-table').DataTable({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
