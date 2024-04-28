@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('airport.index') }}">Sân bay</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h3 class="card-title">Form tìm kiếm</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control mg-r-15" placeholder="Tên or mã sân bay">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Tìm kiếm </button>
                                            <a href="{{ route('airport.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Reload</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{ route('airport.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Mã sân bay</th>
                                        <th>Tên sân bay</th>
                                        <th>Địa điểm</th>
                                        <th class=" text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$airports->isEmpty())
                                        @php $i = $airports->firstItem(); @endphp
                                        @foreach($airports as $airport)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td>{{ $airport->code_no }}</td>
                                                <td>{{ $airport->name }}</td>
                                                <td>{{ $airport->location->name ?? '' }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('airport.update', $airport->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('airport.delete', $airport->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($airports->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $airports->appends($query = '')->links() }}
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
