@extends('admin.layouts.main')
@section('title', 'Thông tin tài khoản')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Dashboad</a></li>
                        <li class="breadcrumb-item"><a href="">Account information</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form role="form" action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if(isset($user) && !empty($user->avatar))
                                        <img src="{{ asset(pare_url_file($user->avatar)) }}" alt="" class=" margin-auto-div img-rounded profile-user-img img-fluid img-circle"  id="image_render" style="height: 150px; width:150px;">
                                    @else
                                        <img alt="" class="margin-auto-div img-rounded profile-user-img img-fluid img-circle" src="{{ asset('admin/dist/img/logothue.png') }}" id="image_render" style="height: 150px; width:150px;">
                                    @endif
                                </div>
                                @if (isset($user->name))
                                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                @endif
                                @if (isset($user->email))
                                    <p class="text-muted text-center">{{ $user->email }}</p>
                                @endif
                                @if (isset($user->phone))
                                    <p class="text-muted text-center">{{ $user->phone }}</p>
                                @endif
                                @if (isset($user->userRole))
                                    <p class="text-muted text-center">{{ isset($user->userRole[0]) ? $user->userRole[0]->display_name : '' }}</p>
                                @endif
                                <div class="form-group">
                                    <div class="input-group input-file" name="images">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-choose" type="button">Chọn tệp</button>
                                    </span>
                                        <input type="text" class="form-control" placeholder='Không có tệp nào ...'/>
                                        <span class="input-group-btn"></span>
                                    </div>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('images') }}</p></span>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <?php //dd($errors) ?>
                <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Full name  <sup class="title-sup">(*)</sup></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="Full name" value="{{old('name', isset($user->name) ? $user->name : '')}}" readonly>
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email  <sup class="title-sup">(*)</sup></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{old('email', isset($user->email) ? $user->email : '')}}" readonly>
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Phone </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" placeholder="Phone" name="phone" value="{{old('phone', isset($user->phone) ? $user->phone : '')}}">
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Date of birth</label>
                                            <div class="col-10">
                                                <input name="birthday" type="date" class="form-control" value="{{ old('birthday', isset($user->birthday) ? date('Y-m-d',strtotime($user->birthday)) : '') }}">
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('birthday') }}</p></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Thông tin khác </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" placeholder="Thông tin khác" name="info" value="{{old('info', isset($user->info) ? $user->info : '')}}">
                                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('info') }}</p></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Gender</label>
                                            <div class="col-sm-10">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radio-gender-1" name="gender" value="1" @if (isset($user)) {{ isset($user) && $user->gender == 1 ? 'checked' : '' }} @else checked @endif>
                                                    <label for="radio-gender-1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="icheck-primary d-inline" style="margin-left: 30px;">
                                                    <input type="radio" id="radio-gender-2" name="gender" value="2" @if (isset($user)) {{ isset($user) && $user->gender == 2 ? 'checked' : '' }} @endif>
                                                    <label for="radio-gender-2">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" name="submit" class="btn btn-info" value="{{ isset($user) ? 'update' : 'create' }}">
                                                    <i class="fa fa-save"></i> Update
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                               
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </section>
@stop
