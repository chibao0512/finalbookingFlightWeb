@extends('page.layouts.page')
@php $title =  'ABAY.VN - Change password' @endphp
@section('title', $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row">
                @include('page.common.sidebar_user')
                <div class="col-sm-12 col-lg-9 pr-lg-4">
                    <h3 class="heading-3">Change password</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('post.change.password') }}">
                                <div class="form-group">
                                    <input class="form-control" type="password" name="c_password" placeholder="Enter old password *" >
                                </div>
                                @if ($errors->first('c_password'))
                                    <p class="text-danger m-b-20">{{ $errors->first('c_password') }}</p>
                                @endif
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Enter new password *" >
                                </div>
                                @if ($errors->first('password'))
                                    <p class="text-danger m-b-20">{{ $errors->first('password') }}</p>
                                @endif
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password_confirm" placeholder="Confrim password *">
                                </div>
                                @if ($errors->first('password_confirm'))
                                    <p class="text-danger m-b-20">{{ $errors->first('password_confirm') }}</p>
                                @endif
                                @csrf
                                <div style="width: 100%">
                                    <div class="col-sm-12 col-md-4 col-lg-4" style="margin: auto">
                                        <button type="submit" class="form-control btn btn-primary text-center">Change password</button>
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
