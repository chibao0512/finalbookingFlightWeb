<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('code_no') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Mã sân bay <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Mã sân bay" name="code_no" value="{{ old('code_no',isset($airport) ? $airport->code_no : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('code_no') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên sân bay <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Tên sân bay" name="name" value="{{ old('name',isset($airport) ? $airport->name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Địa điểm <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="location_id">
                                <option value="">Chọn địa điểm</option>
                                @foreach($locations as $location)
                                    <option
                                            {{old('location_id', isset($airport->location_id) ? $airport->location_id : '') == $location->id ? 'selected="selected"' : ''}}
                                            value="{{$location->id}}"
                                    >
                                        {{$location->name}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('location_id') }}</p></span>
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
                            <a href="{{ route('airport.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
