@extends('admin.layouts.main')
@section('title', 'List booking tickets')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Dashboad</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Ticket booking list</a></li>
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
                                            <input type="text" name="code_no" class="form-control mg-r-15" placeholder="Mã giao dịch">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12 col-md-2">
                                        <div class="form-group">
                                            <select name="status" class="form-control mg-r-15">
                                                <option value="">Choose trading mode</option>
                                                @foreach($status as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Search </button>
                                            <a href="{{ route('transaction.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Reload</a>
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
                        <div class="card-header" bis_skin_checked="1">
                            <h3 class="card-title">Ticket booking list</h3>
                            <div class="card-tools" bis_skin_checked="1">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Transaction code</th>
                                    <th scope="col">Flight</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = $transactions->firstItem(); @endphp
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <th style="vertical-align: middle">{{ $i }}</th>
                                        <th style="vertical-align: middle"><a href="{{ route('transaction.show.tickets', $transaction->id) }}" class="show-ticket">{{ $transaction->code_no }}</a></th>
                                        <td style="vertical-align: middle">
                                            <p style="margin-bottom: 0px;">Flight : {{ $transaction->flight->plane->name }} ({{ $transaction->flight->plane->code_no }})</p>
                                            <p style="margin-bottom: 0px;">
                                                <span>{{ isset($transaction->flight->start_location) ? $transaction->flight->start_location->name : '' }}</span>
                                                <span><img src="{{ asset('page/images/icon/arrow-right.svg') }}" alt="" style="margin-left: 10px; margin-right: 10px"></span>
                                                <span>{{ isset($transaction->flight->end_location) ? $transaction->flight->end_location->name : '' }}</span>
                                            </p>
                                            <p style="margin-bottom: 0px;">Time : {{ getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 0, $timeZone = "GMT+7", strtotime($transaction->start_day))}}</p>
                                            <p style="margin-bottom: 0px;">{{ date('H:i', strtotime($transaction->start_day)) }} - {{ date('H:i', strtotime($transaction->end_day)) }}</p>
                                            <p style="margin-bottom: 0px;">Ticket type : {{ $types[$transaction->type] ?? '' }}</p>
                                            <p style="margin-bottom: 0px;">Ticket class : {{ $ticket_class[$transaction->type] ?? '' }}</p>
                                            <p style="margin-bottom: 0px;">Price : <b>{{ number_format($transaction->total_money,0,',','.') }} vnđ</b></p>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <p style="margin-bottom: 0px;">{{ $transaction->name }}</p>
                                            <p style="margin-bottom: 0px;">{{ $transaction->phone }}</p>
                                            @if ($transaction->email)
                                                <p style="margin-bottom: 0px;">{{ $transaction->email }}</p>
                                            @endif
                                            @if ($transaction->adult)
                                                <p style="margin-bottom: 0px;">Adult : {{ $transaction->adult }}</p>
                                            @endif
                                            @if ($transaction->children)
                                                <p style="margin-bottom: 0px;">Children : {{ $transaction->children }}</p>
                                            @endif
                                            @if ($transaction->baby)
                                                <p style="margin-bottom: 0px;">Baby : {{ $transaction->baby }}</p>
                                            @endif
                                            <p style="margin-bottom: 0px;">Phương thức TT : {{ $transaction->payment_method == 'payment' ? 'Chuyển khoản' : 'Thanh toán online' }}</p>
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if ($transaction->payment)
                                                <ul>
                                                    <li>Bank: {{ $transaction->payment->code_bank }}</li>
                                                    <li>Transaction code: {{ $transaction->payment->code_vnpay }}</li>
                                                    <li>Total price:  {{ number_format($transaction->payment->money,0,',','.') }} VNĐ</li>
                                                    <li>Content: {{ $transaction->payment->note }}</li>
                                                    <li>Time: {{ $transaction->payment->time }}</li>

                                                </ul>
                                            @else
                                                Chuyển khoản
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <button type="button" class="btn btn-block {{ $classStatus[$transaction->status] }} btn-xs">{{ $status[$transaction->status] }}</button>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm">Action</button>
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu action-transaction" role="menu">
                                                    <li><a href="{{ route('transaction.delete', $transaction->id) }}" class="btn-confirm-delete"><i class="fa fa-trash"></i>  Delete</a></li>
                                                    @foreach($status as $key => $item)
                                                    <li class="update_transaction" url='{{ route('transaction.update.status', [$key, $transaction->id]) }}'><a><i class="fas fa-check"></i> {{ $item }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            {{--<a class="btn btn-info btn-sm" target="_blank" href="{{ route('transaction.invoice.print', $transaction->id) }}" title="Information order">--}}
                                                {{--<i class="fa fa-eye"></i>--}}
                                            {{--</a>--}}
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                            @if($transactions->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $transactions->appends($query = '')->links() }}
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

    <!-- Modal -->
    <div class="modal fade" id="model-ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detailed ticket list</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Ticket code</th>
                            <th scope="col">Full name</th>
                            <th scope="col">Seat</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">CCCD</th>
                            <th scope="col">Booking more</th>
                        </tr>
                        </thead>
                        <tbody id="model-ticket-content">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(function () {
            $('.show-ticket').click(function (event) {

                event.preventDefault();
                var url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    async: true,
                }).done(function (result) {

                    $("#model-ticket-content").html(result.html);
                    $("#model-ticket").modal('show');

                }).fail(function (XMLHttpRequest, textStatus, thrownError) {
                    console.log(thrownError)
                });
            })
        })
    </script>
@stop

