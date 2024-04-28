@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Dashboad</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h3 class="card-title">Search</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control mg-r-15" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Search </button>
                                            <a href="{{ route('article.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Reload</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{ route('article.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Create new</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" >Pubisher</th>
                                        <th class="text-center" >NPublish date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$articles->isEmpty())
                                        @php $i = $articles->firstItem(); @endphp
                                        @foreach($articles as $article)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle;">{{ $i }}</td>
                                                <td style="vertical-align: middle; width: 20%" >
                                                    <p>{{ $article->name }}</p>
                                                </td>
                                                <td style="vertical-align: middle; width:15%;">
                                                    @if(isset($article) && !empty($article->image))
                                                        <img src="{{ asset(pare_url_file($article->image)) }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 80px; width:100%;">
                                                    @else
                                                        <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 80px; width:100%;">
                                                    @endif
                                                </td>
                                                <td class=" text-center" style="vertical-align: middle;">
                                                    {{ isset($article->category) ? $article->category->name : '' }}
                                                </td>
                                                <td class=" text-center" style="vertical-align: middle;">{{ $actives[$article->status] }}</td>
                                                <td class=" text-center" style="vertical-align: middle;">
                                                    {{ isset($article->category) ? $article->user->name : '' }}
                                                </td>
                                                <td class=" text-center" style="vertical-align: middle;">{{ date('Y-m-d H:i', strtotime($article->created_at)) }}</td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('article.update', $article->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('article.delete', $article->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($articles->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $articles->appends($query = '')->links() }}
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
