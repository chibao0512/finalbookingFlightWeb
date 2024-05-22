<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Role name <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Role name" name="name" value="{{ old('name',isset($role) ? $role->display_name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Description</label>
                            <div>
                                <textarea name="description" style="resize:vertical" class="form-control" placeholder="Description ...">{{ old('description',isset($role) ? $role->description : '') }}</textarea>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Decentralization</label>
                            <div class="col-md-12 permission_role" style="padding: 0px;">
                                @if($permissionGroups)
                                    @foreach($permissionGroups as $permissionGroup)
                                        <div class="role">
                                            <h4 class="title-role">{{$permissionGroup->name}}</h4>
                                            <div class="row content-role default">
                                                @foreach($permissionGroup->permissions as $permissions)
                                                    <div class="col-md-3 role-item">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" class="{{safeTitle($permissionGroup->name)}}"
                                                                   {{ isset($listPermission) && in_array($permissions->id, $listPermission) ? 'checked' : '' }}
                                                                   value="{{$permissions->id}}" name="permissions[]" id="checkbox{{ $permissions->id }}">
                                                            <label for="checkbox{{ $permissions->id }}">
                                                                {{$permissions->display_name}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row btn-check-role">
                                                <div class="col-md-2">
                                                    <a class="btn btn-block btn-success checkAll" href="#" type="checkbox"  title="Chọn tất cả" onclick="$('.{{safeTitle($permissionGroup->name)}}').prop('checked', true);return false;">
                                                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Select all
                                                    </a>
                                                </div>
                                                <div class="col-md-2" style="margin-left: 20px;">
                                                    <a class="btn btn-block btn-primary canceAll" href="#" type="checkbox"  title="Hủy tất cả" onclick="$('.{{safeTitle($permissionGroup->name)}}').prop('checked', false);return false;">
                                                        <i class="fa fa-times" aria-hidden="true"></i> Cancel all
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Action</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Save data
                            </button>
                            <a href="{{ route('role.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Back</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
