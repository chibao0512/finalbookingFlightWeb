@extends('page.layouts.page')
@php $title =  'ABAY.VN - Booked flight history' @endphp
@section('title', $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row bg-white">
                @include('page.common.sidebar_user')
                <div class="col-sm-12 col-lg-10 pr-lg-4">
                    <h3 class="heading-3">List of booked flights</h3>
                    <div class="row">
                        <div class="row d-flex justify-content-center mt-4 mb-4">
                            <div class="col-md-12">
                                <form action="" style="margin-left: 15px;">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control" placeholder="Transaction code" name="code_no">
                                        <input type="submit" value="Search" class="submit btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Transaction code</th>
                                        <th scope="col">Flight </th>
                                        <th scope="col">Customer</th>
                                        {{--<th scope="col">Action</th>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = $transactions->firstItem(); @endphp
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <th style="vertical-align: middle">{{ $i }}</th>
                                            <th style="vertical-align: middle"><a href="{{ route('show.tickets', $transaction->id) }}" class="show-ticket">{{ $transaction->code_no }}</a></th>
                                            <td style="vertical-align: middle">
                                                <p style="margin-bottom: 0px;">Plane : {{ $transaction->flight->plane->name }} ({{ $transaction->flight->plane->code_no }})</p>
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
                                                <p style="margin-bottom: 0px;">Payment type : {{ $transaction->payment_method == 'payment' ? 'Transfer' : 'Payment online' }}</p>
                                                <p style="margin-bottom: 0px;">Status : {{ isset($status[$transaction->status]) ? $status[$transaction->status] : '' }}</p>
                                            </td>
                                            {{--<td style="vertical-align: middle">@mdo</td>--}}
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row" style="width: 100%; margin-top: 25px; margin-bottom: 25px">
                            <div class="col-md-12">
                                <div class="col text-center" style="margin: auto">
                                    <div class="block-27">
                                        {{ $transactions->appends($query = '')->links('page.paginator.index') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <th scope="col">Ticlet code</th>
                                    <th scope="col">Full name</th>
                                    <th scope="col">Seat</th>
                                    <th scope="col">Data of birth</th>
                                    <th scope="col">CCCD</th>
                                    <th scope="col">Booking more</th>
                                </tr>
                            </thead>
                            <tbody id="model-ticket-content">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
