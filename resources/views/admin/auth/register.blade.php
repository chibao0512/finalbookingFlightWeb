@extends('admin.layouts.main_auth')
@section('title')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Đăng ký</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng ký thành viên mới</p>
                @if (session('danger'))
                    <p class="login-box-msg text-danger">{{ session('danger') }}</p>
                @endif
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ và tên <span class="text-danger">*</span></label>
                        <input name="name" type="text" class="form-control" placeholder="Họ và tên">
                        <div class="col-12">
                            @if ($errors->first('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                        <input name="email" type="email" class="form-control" placeholder="Email">
                        <div class="col-12">
                            @if ($errors->first('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mật khẩu <span class="text-danger">*</span></label>
                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                        <div class="col-12">
                            @if ($errors->first('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input name="phone" type="text" class="form-control" placeholder="Số điện thoại">
                        <div class="col-12">
                            @if ($errors->first('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input name="address" type="text" class="form-control" placeholder="Địa chỉ">
                        <div class="col-12">
                            @if ($errors->first('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ngày sinh</label>
                        <input name="birthday" type="date" class="form-control">
                        <div class="col-12">
                            @if ($errors->first('birthday'))
                                <span class="text-danger">{{ $errors->first('birthday') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giới tính</label>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" name="gender" checked="" value="1">
                                <label for="radioPrimary1">
                                    Nam
                                </label>
                            </div>
                            <div class="icheck-primary d-inline" style="margin-left: 40px">
                                <input type="radio" id="radioPrimary2" name="gender" value="2">
                                <label for="radioPrimary2">
                                    Nữ
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Đối tượng</label>
                        <select class="form-control" name="vaitro_id">
                            @foreach($roles as $key => $role)
                            <option value="{{ $role->id }}">{{ $role->ten }}</option>
                            @endforeach
                        </select>
                        <div class="col-12">
                            @if ($errors->first('vaitro_id'))
                                <span class="text-danger">{{ $errors->first('vaitro_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block col-6" style="margin: auto;">Đăng ký</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@stop