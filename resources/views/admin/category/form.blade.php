<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên danh mục <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Tên danh mục" name="name" value="{{ old('name',isset($category) ? $category->name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="custom-select" name="status">
                                        @foreach($status as $key => $item)
                                            <option
                                                    {{old('status', isset($category->status) ? $category->status : '') == $key ? 'selected="selected"' : ''}}
                                                    value="{{$key}}"
                                            >
                                                {{$item}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hiển thị trên trang chủ</label>
                                    <select class="custom-select" name="show_home">
                                        @foreach($show_home as $key => $item)
                                            <option
                                                    {{old('show_home', isset($category->show_home) ? $category->show_home : '') == $key ? 'selected="selected"' : ''}}
                                                    value="{{$key}}"
                                            >
                                                {{$item}}
                                            </option>
                                        @endforeach
                                    </select>
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
                            <a href="{{ route('category.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
