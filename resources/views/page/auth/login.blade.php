@extends('page.layouts.page')
@php $title =  'ABAY.VN - ĐĂNG NHẬP' @endphp
@section('title', $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-4 text-center">
                    <h2 class="h3">{{ $title }}</h2>
                    <p>Đăng nhập để sử dụng dịch vụ </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">

                    <form class="bg-white p-5 contact-form" action="{{ route('user.page.login') }}" method="POST">
                        @if (session('error'))
                            <p class="login-box-msg text-danger" style="text-align: center">{{ session('error') }}</p>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label class="text-label">Email đăng nhập</label>
                            <input class="form-control" type="email" name="email" placeholder="Email đăng nhập">
                            @if ($errors->first('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-label">Mật khẩu đăng nhập</label>
                            <input type="password" name="password" class="form-control"  placeholder="Mật khẩu đăng nhập">
                            @if ($errors->first('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary py-3 px-5">Đăng nhập</button>
                            <p style="margin-top: 15px">Chưa có tài khoản ? <a href="{{ route('user.page.register') }}">Đăng ký</a></p>
                        </div>
                    </form>

                </div>
                @include('page.common.sidebar')
            </div>
        </div>
    </section>
@stop
@section('script')
@stop