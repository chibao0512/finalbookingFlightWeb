<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('code_no') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Plane code <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Flight code" name="code_no" value="{{ old('code_no',isset($plane) ? $plane->code_no : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('code_no') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Plane name <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Flight name" name="name" value="{{ old('name',isset($plane) ? $plane->name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->first('number_seats') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Number of regular seats <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="number" class="form-control"  placeholder="Number of regular seats" name="number_seats" value="{{ old('number_seats',isset($plane) ? $plane->number_seats : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('number_seats') }}</p></span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('number_seats') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Number of VIP seats</label>
                                <div>
                                    <input type="number" class="form-control"  placeholder="Number of VIP seats" name="number_seats_vip" value="{{ old('number_seats_vip',isset($plane) ? $plane->number_seats_vip : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('number_seats_vip') }}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label default">Status <sup class="text-danger">(*)</sup></label>
                            <select name="status" class="form-control" id="">
                                <option value="">Choose Status</option>
                                @foreach($status as $key => $item)
                                    <option value="{{ $key }}" {{ old('status', isset($plane) ? $plane->status : '') == $key ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Airline <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="airline_company_id">
                                <option value="">Choose Airline</option>
                                @foreach($airline_companies as $airline_company)
                                    <option
                                            {{old('airline_company_id', isset($plane->airline_company_id) ? $plane->airline_company_id : '') == $airline_company->id ? 'selected="selected"' : ''}}
                                            value="{{$airline_company->id}}"
                                    >
                                        {{$airline_company->name}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('airline_company_id') }}</p></span>
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
                                <i class="fa fa-save"></i> Sava data
                            </button>
                            <a href="{{ route('plane.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i>Back</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
