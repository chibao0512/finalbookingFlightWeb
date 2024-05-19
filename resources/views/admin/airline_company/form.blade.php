<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group {{ $errors->first('code_no') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Airline Code <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="text" maxlength="100" class="form-control"  placeholder="Airline Code" name="code_no" value="{{ old('code_no',isset($airlineCompany) ? $airlineCompany->code_no : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('code_no') }}</p></span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} col-md-6" >
                                <label for="inputEmail3" class="control-label default">Airline name <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="text" class="form-control"  placeholder="Arline Name" name="name" value="{{ old('name',isset($airlineCompany) ? $airlineCompany->name : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group {{ $errors->first('show_home') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Displayed on the home page </label>
                                <div>
                                    <select name="show_home" class="form-control">
                                        @foreach($show_home as $key => $show)
                                        <option value="{{ $key }}" {{ old('show_home', isset($airlineCompany) ? $airlineCompany->show_home : 0) == $key ? 'selected' : '' }}>{{ $show }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('show_home') }}</p></span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->first('sort') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Number </label>
                                <div>
                                    <input type="number" class="form-control"  placeholder="Vị trí" name="sort" value="{{ old('sort',isset($airlineCompany) ? $airlineCompany->sort : 0) }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('sort') }}</p></span>
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
                        <h3 class="card-title"> Acition</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Save data
                            </button>
                            <a href="{{ route('airline.company.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Back</a>
                        </div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title">Logo </h3>
                    </div>
                    <div class="card-body" style="min-height: 288px">
                        <div class="form-group">
                            <div class="input-group input-file" name="images">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Choose file</button>
                                </span>
                                <input type="text" class="form-control" placeholder='No file choose ...'/>
                                <span class="input-group-btn"></span>
                            </div>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('images') }}</p></span>
                            @if(isset($airlineCompany) && !empty($airlineCompany->logo))
                                <img src="{{ asset(pare_url_file($airlineCompany->logo)) }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%;">
                            @else
                                <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%;">
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
