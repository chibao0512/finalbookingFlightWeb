@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Dashboad</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('airline.company.index') }}">Airline</a></li>
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
                                            <input type="text" name="name" class="form-control mg-r-15" placeholder="Airline name or airline code">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Search </button>
                                            <a href="{{ route('airline.company.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Reload</a>
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
                                    <a href="{{ route('airline.company.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Create new</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Logo</th>
                                        <th>Airline code</th>
                                        <th>Airline name</th>
                                        <th>Status</th>
                                        <th>Number</th>
                                        <th class=" text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$airline_companies->isEmpty())
                                        @php $i = $airline_companies->firstItem(); @endphp
                                        @foreach($airline_companies as $airline_company)
                                            <tr>
                                                <td class=" text-center">{{ $i }}</td>
                                                <td style="vertical-align: middle; width:8%;">
                                                    @if(isset($airline_company) && !empty($airline_company->logo))
                                                        <img src="{{ asset(pare_url_file($airline_company->logo)) }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 80px; width:100%;">
                                                    @else
                                                        <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 80px; width:100%;">
                                                    @endif
                                                </td>
                                                <td style="vertical-align: middle; width:15%;">{{ $airline_company->code_no }}</td>
                                                <td style="vertical-align: middle; width:15%;">{{ $airline_company->name }}</td>
                                                <td style="vertical-align: middle; width:15%;">{{ isset($show_home[$airline_company->show_home]) ? $show_home[$airline_company->show_home] : '' }}</td>
                                                <td style="vertical-align: middle; width:15%;">{{ $airline_company->sort }}</td>
                                                <td class="text-center" style="vertical-align: middle; width:15%;">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('airline.company.update', $airline_company->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('airline.company.delete', $airline_company->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($airline_companies->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $airline_companies->appends($query = '')->links() }}
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
