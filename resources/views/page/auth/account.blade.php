@extends('page.layouts.page')
@php $title =  'ABAY.VN - Thông tin tài khoản' @endphp
@section('title', $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row">
                @include('page.common.sidebar_user')
                <div class="col-sm-12 col-lg-10 pr-lg-4">
                    <h3 class="heading-3">Thông tin tài khoản</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('update.info.account') }}">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Họ và tên *" value="{{ old('name', isset($user) ? $user->name : '') }}">
                                </div>
                                @if ($errors->first('name'))
                                    <p class="text-danger m-b-20">{{ $errors->first('name') }}</p>
                                @endif
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" placeholder="Email của bạn *">
                                </div>
                                @if ($errors->first('email'))
                                    <p class="text-danger m-b-20">{{ $errors->first('email') }}</p>
                                @endif
                                <div class="form-group">
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}" placeholder="Số điện thoại *">
                                </div>
                                @if ($errors->first('phone'))
                                    <p class="text-danger m-b-20">{{ $errors->first('phone') }}</p>
                                @endif

                                <div class="form-group">
                                    <select class="form-control" name="gender">
                                        <option value="">Gender</option>
                                        <option value="1" {{ old('gender', isset($user) ? $user->gender : '') == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ old('gender', isset($user) ? $user->gender : '') == 2 ? 'selected' : '' }}>Female</option>
                                        <option value="3" {{ old('gender', isset($user) ? $user->gender : '') == 3 ? 'selected' : '' }}>etc</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                @if ($errors->first('gender'))
                                    <p class="text-danger m-b-20">{{ $errors->first('gender') }}</p>
                                @endif
                                <div class="form-group">
                                    <input class="form-control" type="date" name="birthday" placeholder="" value="{{ old('birthday', isset($user) ? $user->birthday : '') }}">
                                </div>
                                @if ($errors->first('birthday'))
                                    <p class="text-danger m-b-20">{{ $errors->first('birthday') }}</p>
                                @endif

                                <div class="form-group">
                                    <input class="form-control" type="text" name="address" value="{{ old('address', isset($user) ? $user->address : '') }}" placeholder="Địa chỉ">
                                </div>
                                @if ($errors->first('address'))
                                    <p class="text-danger m-b-20">{{ $errors->first('address') }}</p>
                                @endif

                                @csrf
                                <div style="width: 100%">
                                    <div class="col-sm-12 col-md-4 col-lg-4" style="margin: auto">
                                        <button type="submit" class="form-control btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@stop
