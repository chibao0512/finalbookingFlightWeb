<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên quyền <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tên nhóm quyền" name="name" value="{{ old('name',isset($permission) ? $permission->display_name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nhóm quyền <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="group_permission_id">
                                <option value="">Chọn nhóm quyền</option>
                                @foreach($permissionGroups as $permissionGroup)
                                    <option
                                            {{old('group_permission_id', isset($permission->group_permission_id) ? $permission->group_permission_id : '') == $permissionGroup->id ? 'selected="selected"' : ''}}
                                            value="{{$permissionGroup->id}}"
                                    >
                                        {{$permissionGroup->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Mô tả chi tiết</label>
                            <div>
                                <textarea name="description" style="resize:vertical" class="form-control" placeholder="Mô tả sơ qua về nhóm quyền ...">{{ old('description',isset($permission) ? $permission->description : '') }}</textarea>
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Xuất bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Lưu dữ liệu
                            </button>
                            <a href="{{ route('permission.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
