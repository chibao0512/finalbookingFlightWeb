@extends('admin.layouts.main')
@section('title', 'Flights')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Dashboad</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('flight.index') }}">Flight</a></li>
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
                            <h3 class="card-title">Form Search</h3>
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
                                            <input type="text" name="code_no" class="form-control mg-r-15" placeholder="Flight code">
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-12 col-md-3">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Search </button>
                                            <a href="{{ route('flight.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Reload</a>
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
                                    <a href="{{ route('flight.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Create new</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">No.</th>
                                        <th>Flight</th>
                                        <th>Information</th>
                                        <th>Flight time</th>
                                        <th>Price information</th>
                                        <th>Ticket Type</th>
                                        <th>Status</th>
                                        <th class=" text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$flights->isEmpty())
                                        @php $i = $flights->firstItem(); @endphp
                                        @foreach($flights as $flight)
                                            <tr>
                                                <td style="vertical-align: middle; width:3%;" class=" text-center">{{ $i }}</td>
                                                <td style="vertical-align: middle; width:15%;">
                                                    <p>Mã : {{ $flight->code_no }}</p>
                                                    <p>Chuyến bay : {{ isset($flight->plane) ? $flight->plane->name : '' }}</p>
                                                    <p>Hãng máy bay : {{ isset($flight->plane) && isset($flight->plane->airline_company) ? $flight->plane->airline_company->name : '' }}</p>
                                                </td>
                                                <td style="vertical-align: middle; width:15%;">
                                                    <p>Điểm đi : {{ isset($flight->start_location) ? $flight->start_location->name : '' }}</p>
                                                    <p>Sân bay : {{ isset($flight->start_airport) ? $flight->start_airport->name : '' }}</p>
                                                    <p>Điểm đến : {{ isset($flight->start_location) ? $flight->end_location->name : '' }}</p>
                                                    <p>Sân bay : {{ isset($flight->end_airport) ? $flight->end_airport->name : '' }}</p>
                                                    <p>Thời gian bay : {{ diffTimeRun($flight->start_day, $flight->end_day) }} phút</p>
                                                </td>
                                                <td style="vertical-align: middle; width:15%; text-align: center">
                                                   {{ convertDatetimeLocal($flight->start_day) }}
                                                    <p><i class="fa fa-fw fa-arrow-down"></i></p>
                                                    {{ convertDatetimeLocal($flight->end_day) }}

                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <p>Price : {{ number_format($flight->price,0,',','.') }} vnđ</p>
                                                    <p>Vip Price: {{ number_format($flight->price_vip,0,',','.') }} vnđ</p>
                                                    <p>Ticket price for infants : {{ number_format($flight->baby_ticket,0,',','.') }} vnđ</p>
                                                    <p>Tax : {{ $flight->tax_percentage }}</p>
                                                    <p>Surcharge : {{ number_format($flight->expense,0,',','.') }} vnđ</p>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ isset($types[$flight->type]) ? $types[$flight->type] : '' }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <button type="button" class="btn btn-block {{ $classStatus[$flight->status] }} btn-xs">{{ $status[$flight->status] }}</button>
                                                </td>
                                                <td class="text-center" style="vertical-align: middle; width:15%;">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('flight.update', $flight->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('flight.delete', $flight->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($flights->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $flights->appends($query = '')->links() }}
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
