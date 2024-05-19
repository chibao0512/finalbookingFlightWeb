<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-2">
                
            </div>
            <?php //dd($errors) ?>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Full name<sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Fullname" name="name" value="{{old('name', isset($user->name) ? $user->name : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email  <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{{old('email', isset($user->email) ? $user->email : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="inputName2" class="col-sm-2 col-form-label"> Password <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="password" class="form-control" value="" id="exampleInputEmail1" placeholder="{{ isset($user) ? 'Please enter your password if you need to change it' : 'Password' }}">
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Phone number  <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Phone number" name="phone" value="{{old('phone', isset($user->phone) ? $user->phone : '')}}">
                                        <span class="text-danger "><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <label for="inputName2" class="col-sm-2 col-form-label">Role <sup class="title-sup">(*)</sup></label>
                                    <div class="col-sm-10">
                                        <select name="role" class="form-control">
                                            <option value="">Choose role</option>
                                            @if($roles)
                                                @foreach($roles as $role)
                                                    <option  {{old('role', isset($listRoleUser->role_id) ? $listRoleUser->role_id : '') == $role->id ? 'selected=selected' : '' }}  value="{{$role->id}}">{{$role->display_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('role') }}</p></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Status  </label>
                                    <div class="col-sm-10">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radio-status-1" name="status" value="1" @if (isset($user)) {{ isset($user) && $user->status == 1 ? 'checked' : '' }} @else checked @endif>
                                            <label for="radio-status-1">
                                                Action
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline" style="margin-left: 30px;">
                                            <input type="radio" id="radio-status-2" name="status" value="2" @if (isset($user)) {{ isset($user) && $user->status == 2 ? 'checked' : '' }} @endif>
                                            <label for="radio-status-2">
                                                Locked
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-info" value="{{ isset($user) ? 'update' : 'create' }}">
                                            <i class="fa fa-save"></i> Save data
                                        </button>
                                        <a href="{{ route('user.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Back</a>
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
            <div class="col-md-2">
                
            </div>
            <?php //dd($errors) ?>
            <!-- /.col -->
            <!-- /.col -->
        </div>
    </form>
</div>
