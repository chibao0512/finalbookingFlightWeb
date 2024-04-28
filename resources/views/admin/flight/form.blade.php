<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary" style="min-height: 600px;">
                    <!-- form start -->
                    <div class="card-body" style="min-height: 445px;">
                        <div class="row">
                            <div class="form-group {{ $errors->first('plane_id') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Máy bay <sup class="text-danger">(*)</sup></label>
                                <select class="custom-select select2" name="plane_id">
                                    <option value="">Choose airline</option>
                                    @foreach($planes as $plane)
                                        <option
                                                {{old('plane_id', isset($flight->plane_id) ? $flight->plane_id : '') == $plane->id ? 'selected="selected"' : ''}}
                                                value="{{$plane->id}}"
                                        >
                                            {{$plane->code_no.' - '.$plane->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('plane_id') }}</p></span>
                            </div>
                            <div class="form-group {{ $errors->first('code_no') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Mã chuyến bay <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="text" maxlength="100" class="form-control"  placeholder="Mã chuyến bay" name="code_no" value="{{ old('code_no',isset($flight) ? $flight->code_no : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('code_no') }}</p></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->first('start_location_id') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Địa điểm đi <sup class="text-danger">(*)</sup></label>
                                <select class="custom-select select2 start-change-location" name="start_location_id" type="start">
                                    <option value="">Chọn địa điểm</option>
                                    @foreach($locations as $location)
                                        <option
                                                {{old('start_location_id', isset($flight->start_location_id) ? $flight->start_location_id : '') == $location->id ? 'selected="selected"' : ''}}
                                                value="{{$location->id}}"
                                        >
                                            {{$location->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('start_location_id') }}</p></span>
                            </div>
                            <div class="form-group {{ $errors->first('end_location_id') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Địa điểm đến <sup class="text-danger">(*)</sup></label>
                                <select class="custom-select select2 end-change-location" name="end_location_id" type="end">
                                    <option value="">Chọn địa điểm</option>
                                    @foreach($locations as $location)
                                        <option
                                                {{old('end_location_id', isset($flight->end_location_id) ? $flight->end_location_id : '') == $location->id ? 'selected="selected"' : ''}}
                                                value="{{$location->id}}"
                                        >
                                            {{$location->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('end_location_id') }}</p></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->first('start_airport_id') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Sân bay đi <sup class="text-danger">(*)</sup></label>
                                <select class="custom-select select2" name="start_airport_id" id="start-airport">
                                    <option value="">Chọn sân bay đi</option>
                                    @foreach($airports as $airport)
                                        <option
                                                {{old('start_airport_id', isset($flight->start_airport_id) ? $flight->start_airport_id : '') == $airport->id ? 'selected="selected"' : ''}}
                                                value="{{$airport->id}}"
                                        >
                                            {{$airport->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('start_airport_id') }}</p></span>
                            </div>
                            <div class="form-group {{ $errors->first('end_airport_id') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Sân bay đến <sup class="text-danger">(*)</sup></label>
                                <select class="custom-select select2" name="end_airport_id" id="end-airport">
                                    <option value="">Chọn sân bay đến</option>
                                    @foreach($airports as $airport)
                                        <option
                                                {{old('end_airport_id', isset($flight->end_airport_id) ? $flight->end_airport_id : '') == $airport->id ? 'selected="selected"' : ''}}
                                                value="{{$airport->id}}"
                                        >
                                            {{$airport->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('end_airport_id') }}</p></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->first('start_day') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Thời gian đi <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="datetime-local" class="form-control" name="start_day" value="{{ old('start_day', isset($flight) ? convertDatetimeLocal($flight->start_day) : '') }}">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('start_day') }}</p></span>
                                </div>

                            </div>
                            <div class="form-group {{ $errors->first('end_day') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Thời gian đến <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="datetime-local" class="form-control" name="end_day" value="{{ old('end_day', isset($flight) ? convertDatetimeLocal($flight->end_day) : '') }}">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('end_day') }}</p></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->first('tax_percentage') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Thuế (Phần trăm thuế)</label>
                                <div>
                                    <input type="number" max="100" class="form-control" name="tax_percentage" value="{{ old('tax_percentage', isset($flight) ? $flight->tax_percentage : '') }}">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('tax_percentage') }}</p></span>
                                </div>

                            </div>
                            <div class="form-group {{ $errors->first('expense') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Phụ phí </label>
                                <div>
                                    <input type="number" class="form-control" name="expense" value="{{ old('expense', isset($flight) ? $flight->expense : '') }}">
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('expense') }}</p></span>
                                </div>
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
                            <a href="{{ route('plane.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-header">
                        <h3 class="card-title"> Dư liệu </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('price') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Giá vé thường <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="number" class="form-control"  placeholder="Giá ghế thường" name="price" value="{{ old('price',isset($flight) ? $flight->price : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('price') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('price_vip') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Giá vé víp </label>
                            <div>
                                <input type="number" class="form-control"  placeholder="Giá ghế víp" name="price_vip" value="{{ old('price_vip',isset($flight) ? $flight->price_vip : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('price_vip') }}</p></span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('price_vip') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Trẻ sơ sinh </label>
                            <div>
                                <input type="number" class="form-control"  placeholder="Phụ phí trẻ sơ sinh" name="baby_ticket" value="{{ old('baby_ticket',isset($flight) ? $flight->baby_ticket : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('baby_ticket') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label default">Trạng thái <sup class="text-danger">(*)</sup></label>
                            <select name="status" class="form-control" id="">
                                <option value="">Chọn trạng thái</option>
                                @foreach($status as $key => $item)
                                    <option value="{{ $key }}" {{ old('status', isset($flight) ? $flight->status : '') == $key ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('status') }}</p></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail3" class="control-label default">Loại vé <sup class="text-danger">(*)</sup></label>
                            <select name="type" class="form-control" id="type">
                                @foreach($types as $key => $type)
                                    <option value="{{ $key }}" {{ old('type', isset($flight) ? $flight->type : '') == $key ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('type') }}</p></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
