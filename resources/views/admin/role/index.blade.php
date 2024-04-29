@extends('admin.layouts.main')
@section('title', 'Roles')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Dashboad</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{ route('role.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Create new</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">No.</th>
                                        <th>Role name</th>
                                        <th>List of permissions</th>
                                        <th>Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$roles->isEmpty())
                                        @php $i = $roles->firstItem(); @endphp
                                        @foreach($roles as $role)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle;">{{ $i }}</td>
                                                <td style="vertical-align: middle;">{{$role->display_name}}</td>
                                                <td style="max-width: 250px">
                                                    @if(!empty($role->permissionRole))
                                                        @foreach($role->permissionRole as $permission)
                                                            <small class="badge badge-success">{{$permission->display_name}}</small>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle;">{{$role->description}}</td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('role.update', $role->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('role.delete', $role->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($roles->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $roles->appends($query = '')->links() }}
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
