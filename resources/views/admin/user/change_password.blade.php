@extends('admin.layouts.main')
@section('title', 'Đổi mật khẩu | Quản lý phiếu')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="">Đổi mật khẩu</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <form role="form" action="{{ route('admin.post.change.password') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group {{ $errors->has('c_password') ? 'has-error' : '' }}">
                                        <label for="exampleInputEmail1">Mật khẩu cũ  <sup class="title-sup">(*)</sup></label>
                                        <input type="password" name="c_password" class="form-control" value="">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('c_password') }}</p></span>
                                    </div>

                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="exampleInputEmail1">Mật khẩu  <sup class="title-sup">(*)</sup></label>
                                        <input type="password" name="password" class="form-control" value="">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                                    </div>

                                    <div class="form-group {{ $errors->has('password_confirm') ? 'has-error' : '' }}">
                                        <label for="exampleInputEmail1">Nhập lại mật khẩu  <sup class="title-sup">(*)</sup></label>
                                        <input type="password" name="password_confirm" class="form-control" value="" >
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password_confirm') }}</p></span>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@stop
