<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Title <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="180" class="form-control"  placeholder="Title" name="name" value="{{ old('name',isset($article) ? $article->name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Category <sup class="text-danger">(*)</sup></label>
                                    <select class="custom-select" name="category_id">
                                        <option value="">Choose category</option>
                                        @foreach($categories as $category)
                                            <option
                                                    {{old('category_id', isset($article->category_id ) ? $article->category_id  : '') == $category->id ? 'selected="selected"' : ''}}
                                                    value="{{$category->id}}"
                                            >
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('category_id') }}</p></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="custom-select" name="status">
                                        @foreach($actives as $key => $active)
                                            <option
                                                    {{old('status', isset($article->status ) ? $article->status : '') == $key ? 'selected="selected"' : ''}}
                                                    value="{{$key}}"
                                            >
                                                {{$active}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('status') }}</p></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Short Description </label>
                            <div>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('description', isset($article) ? $article->description : '') }}</textarea>
                                @if ($errors->first('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('contents') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Content </label>
                            <div>
                                <textarea name="contents" id="contents" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('contents', isset($article) ? $article->contents : '') }}</textarea>
                                <script>
                                    ckeditor(contents);
                                </script>
                                @if ($errors->first('contents'))
                                    <span class="text-danger">{{ $errors->first('contents') }}</span>
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
                            <a href="{{ route('article.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i>Back</a>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Thumbnail </h3>
                    </div>
                    <div class="card-body" style="min-height: 288px">
                        <div class="form-group">
                            <div class="input-group input-file" name="images">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Choose file</button>
                                </span>
                                <input type="text" class="form-control" placeholder='No file choosing ...'/>
                                <span class="input-group-btn"></span>
                            </div>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('images') }}</p></span>
                            @if(isset($article) && !empty($article->image))
                                <img src="{{ asset(pare_url_file($article->image)) }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 200px; width:100%;">
                            @else
                                <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 200px; width:100%;">
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
