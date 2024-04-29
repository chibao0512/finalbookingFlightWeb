@extends('page.layouts.page')
@php $title =  'ABAY.VN - ĐĂNG KÝ' @endphp
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
                    <p>Sign up to use the service </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form class="bg-white p-5 contact-form" action="{{ route('user.page.register') }}" method="POST">
                        @if (session('error'))
                            <p class="login-box-msg text-danger" style="text-align: center">{{ session('error') }}</p>
                        @endif
                        @csrf

                        <div class="form-group">
                            <label class="text-label">Full name <sup class="text-danger">(*)</sup></label>
                            <input type="text" class="form-control" name="name" placeholder="Full name">
                            @if ($errors->first('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="text-label">Email  <sup class="text-danger">(*)</sup></label>
                            <input type="email" class="form-control" name="email" placeholder="Email ">
                            @if ($errors->first('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="text-label">Password <sup class="text-danger">(*)</sup></label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            @if ($errors->first('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-label">Confrim Password <sup class="text-danger">(*)</sup></label>
                            <input type="password" class="form-control" name="password_confirm" placeholder="Password">
                            @if ($errors->first('password_confirm'))
                                <span class="text-danger">{{ $errors->first('password_confirm') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-label">Date of birth <sup class="text-danger">(*)</sup></label>
                            <input type="date" class="form-control" name="birthday">
                            @if ($errors->first('birthday'))
                                <span class="text-danger">{{ $errors->first('birthday') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-label">Gender <sup class="text-danger">(*)</sup></label>
                            <select name="gender" class="form-control">
                                @foreach($genders as $key => $gender)
                                    <option {{ old('gender') == $key ? 'selected="selected"' : ''}} value="{{ $key }}">{{ $gender }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-label">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                            @if ($errors->first('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="text-label">Address </label>
                            <input type="text" class="form-control" name="address" placeholder="Address">
                            @if ($errors->first('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary py-3 px-5">Sign up</button>
                            <p style="margin-top: 15px">Already have an account? <a href="{{ route('user.page.login') }}">Sign in</a></p>
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