@extends('admin.layouts.main')
@section('title', 'Quản lý ')
@section('style-css')
    <!-- fullCalendar -->
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý bán hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản lý bán hàng</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Dữ liệu website</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="ion ion-ios-cart-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Số giao dịch hôm nay</span>
                                    @php $time_day = \Carbon\Carbon::now()->format('Y-m-d') @endphp
                                    <span class="info-box-number">{{ $transaction_day }}<small><a href="{{  route('transaction.index', ['start_day' => $time_day, 'end_day' => $time_day]) }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Số chuyến bay hôm nay</span>
                                    <span class="info-box-number">{{ $flight_day }}<small><a href="{{ route('flight.index', ['start_day' => $time_day, 'end_day' => $time_day]) }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Thành viên</span>
                                    <span class="info-box-number">{{ $number_user }} <small><a href="{{ route('user.index') }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- ./col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info color-palette"><i class="fas fa-file-word"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Số lượng bài viết</span>
                                    <span class="info-box-number">{{ $number_article }} <small><a href="{{ route('article.index') }}">(Chi tiết)</a></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu ngày</span>
                                    <span class="info-box-number">{{ number_format($totalMoneyDay,0,',','.') }} <small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu tuần</span>
                                    <span class="info-box-number">{{ number_format($totalMoneyWeed,0,',','.') }}<small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu tháng</span>
                                    <span class="info-box-number">{{number_format($totalMoneyMonth,0,',','.')  }} <small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <!-- fix for small devices only -->
                        <div class="clearfix visible-sm-block"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu năm</span>
                                    <span class="info-box-number">{{ number_format($totalMoneyYear ,0,',','.') }} <small></small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Danh sách đơn hàng mới</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã giao dịch</th>
                                    <th scope="col">Chuyến bay</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Thanh toán</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $key => $transaction)
                                    <tr>
                                        <th style="vertical-align: middle">{{ $key + 1 }}</th>
                                        <th style="vertical-align: middle"><a href="{{ route('transaction.show.tickets', $transaction->id) }}" class="show-ticket">{{ $transaction->code_no }}</a></th>
                                        <td style="vertical-align: middle">
                                            <p style="margin-bottom: 0px;">Máy bay : {{ $transaction->flight->plane->name }} ({{ $transaction->flight->plane->code_no }})</p>
                                            <p style="margin-bottom: 0px;">
                                                <span>{{ isset($transaction->flight->start_location) ? $transaction->flight->start_location->name : '' }}</span>
                                                <span><img src="{{ asset('page/images/icon/arrow-right.svg') }}" alt="" style="margin-left: 10px; margin-right: 10px"></span>
                                                <span>{{ isset($transaction->flight->end_location) ? $transaction->flight->end_location->name : '' }}</span>
                                            </p>
                                            <p style="margin-bottom: 0px;">Thời gian : {{ getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 0, $timeZone = "GMT+7", strtotime($transaction->start_day))}}</p>
                                            <p style="margin-bottom: 0px;">{{ date('H:i', strtotime($transaction->start_day)) }} - {{ date('H:i', strtotime($transaction->end_day)) }}</p>
                                            <p style="margin-bottom: 0px;">Loại vé : {{ $types[$transaction->type] ?? '' }}</p>
                                            <p style="margin-bottom: 0px;">Hạng vé : {{ $ticket_class[$transaction->type] ?? '' }}</p>
                                            <p style="margin-bottom: 0px;">Giá tiền : <b>{{ number_format($transaction->total_money,0,',','.') }} vnđ</b></p>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <p style="margin-bottom: 0px;">{{ $transaction->name }}</p>
                                            <p style="margin-bottom: 0px;">{{ $transaction->phone }}</p>
                                            @if ($transaction->email)
                                                <p style="margin-bottom: 0px;">{{ $transaction->email }}</p>
                                            @endif
                                            @if ($transaction->adult)
                                                <p style="margin-bottom: 0px;">Người lớn : {{ $transaction->adult }}</p>
                                            @endif
                                            @if ($transaction->children)
                                                <p style="margin-bottom: 0px;">Trẻ em : {{ $transaction->children }}</p>
                                            @endif
                                            @if ($transaction->baby)
                                                <p style="margin-bottom: 0px;">Em bé : {{ $transaction->baby }}</p>
                                            @endif
                                            <p>Phương thức TT : {{ $transaction->payment_method == 'payment' ? 'Chuyển khoản' : 'Thanh toán online' }}</p>
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if ($transaction->payment)
                                                <ul>
                                                    <li>Ngân hàng: {{ $transaction->payment->code_bank }}</li>
                                                    <li>Mã thanh toán: {{ $transaction->payment->code_vnpay }}</li>
                                                    <li>Tổng tiền:  {{ number_format($transaction->payment->money,0,',','.') }} VNĐ</li>
                                                    <li>Nội dung: {{ $transaction->payment->note }}</li>
                                                    <li>Thời gian: {{ date('Y-m-d H:i', strtotime($transaction->payment->time)) }}</li>

                                                </ul>
                                            @else
                                                Chuyển khoản
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-block {{ $classStatus[$transaction->status] }} btn-xs">{{ $status[$transaction->status] }}</button>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop
@section('script')
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{-- <script src="https://code.highcharts.com/modules/exporting.js"></script> --}}
    {{-- <script src="https://code.highcharts.com/modules/export-data.js"></script> --}}
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

@stop