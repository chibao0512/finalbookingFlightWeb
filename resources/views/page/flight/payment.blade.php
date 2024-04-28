@extends('page.layouts.page')
@php $title =  'ABAY.VN -  Mua Bán Vé Máy Bay Giá Rẻ' @endphp
@section('title', $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <form action="{{ route('flight.post.payment', $transaction->id) }}" method="POST" class="browse-form" style="width: 100%;">
                <div class="row">
                    <div class="col-lg-8 pr-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="ftco-heading-2" style="text-transform: uppercase">Thông tin chuyến bay</h2>
                                {{--<h2 class="ftco-heading-2">Đơn hàng : {{ $transaction->code_no }}</h2>--}}
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <div style="margin-top:15px ">
                                            <span>{{ isset($transaction->flight->start_location) ? $transaction->flight->start_location->name : '' }}</span>
                                            <span><img src="{{ asset('page/images/icon/arrow-right.svg') }}" alt="" style="margin-left: 10px; margin-right: 10px"></span>
                                            <span>{{ isset($transaction->flight->end_location) ? $transaction->flight->end_location->name : '' }}</span>
                                        </div>
                                        <div class="d-flex" style="float: left;">
                                            <img src="{{ isset($transaction->flight->plane->airline_company) && !empty($transaction->flight->plane->airline_company->logo) ? asset(pare_url_file($transaction->flight->plane->airline_company->logo)) : asset('page/images/san-bay.png') }}" alt="{{ $transaction->flight->plane->airline_company->name }}" class="img-fluid" style="height: 60px">
                                            <span style="margin-top: 20px;">{{ $transaction->flight->plane->airline_company->name }}</span>
                                        </div>
                                        <div class="d-flex" style="float: left;">
                                            <p>Máy bay : {{ $transaction->flight->plane->name }} ({{ $transaction->flight->code_no }})</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 ">
                                        <div style="margin-top:15px ">
                                            <p>{{ getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 0, $timeZone = "GMT+7", strtotime($transaction->flight->start_day))}}</p>
                                            <p>{{ date('H:i', strtotime($transaction->flight->start_day)) }} - {{ date('H:i', strtotime($transaction->flight->end_day)) }}</p>
                                            <p>Tình trạng : Đợi thanh toán</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="ftco-heading-2" style="text-transform: uppercase; margin-top: 15px">Thông tin khách hàng</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="position">Người đặt </span>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Khách hàng : {{ $transaction->name }}</p>
                                        <p>Email : {{ $transaction->email }} </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Số điện thoại : {{ $transaction->phone }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="position">Thành viên </span>
                                        @foreach($transaction->tickets as $ticket)
                                        <div class="row">
                                            <div class="col-4">
                                                Họ tên : {{ $ticket->name}}
                                            </div>
                                            <div class="col-4">
                                                CCCD : {{ $ticket->card}}
                                            </div>
                                            <div class="col-4">
                                                Ngày sinh : {{ $ticket->birthday}}
                                            </div>
                                            @if ($ticket->transport)
                                            <div class="col-12">
                                                {{ $ticket->transport->title }}
                                            </div>
                                            @endif
                                        </div>
                                        <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="ftco-heading-2" style="text-transform: uppercase; margin-top: 15px">Thông tin thanh toán</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="option-payment-1"><input type="radio" id="option-payment-1" name="payment_method" value="payment" {{ old('payment_method') == null ? 'checked' : '' }} {{ old('payment_method') == 'payment' ? 'checked' : '' }}> Chuyển khoản (vui lòng chuyển khoản theo thông tin và chờ xác nhận)</label>
                                        <div>
                                            <p>Tên chuyển khoản : CT TNNH vé máy bay trực tuyến Abay</p>
                                            <p>Số tiền : <b>{{ number_format($transaction->total_money,0,',','.') }} vnđ</b></p>
                                            <p>Nội dung : {{ $transaction->code_no }}</p>
                                            <p>Ngân hàng : ACB</p>
                                            <p>Số tài khoản : 227764088</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @csrf
                                        <label for="option-payment-2"><input type="radio" id="option-payment-2" name="payment_method" value="payment-online" {{ old('payment_method') == 'payment-online' ? 'checked' : '' }}> Thanh toán online</label>
                                    </div>
                                    <div style="width: 100%">
                                        <div class="col-sm-12 col-md-4 col-lg-4" style="float: right; margin-bottom: 15px">
                                            <button type="submit" class="form-control btn btn-primary">Xác nhận thanh toán</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pr-lg-4">
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>
                        <div class="sidebar-box bg-white p-4 ftco-animate fadeInUp ftco-animated" bis_skin_checked="1">
                            <h2 class="ftco-heading-2" style="text-transform: uppercase">Chọn ghế</h2>
                            <p>Máy bay : {{ $transaction->flight->plane->name }} ({{ $transaction->flight->code_no }})</p>
                            @if ($errors->first('seats'))
                                <span class="text-danger">{{ $errors->first('seats') }}</span>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">A</th>
                                        <th scope="col">B</th>
                                        <th scope="col">C</th>
                                        <th scope="col"></th>
                                        <th scope="col">D</th>
                                        <th scope="col">E</th>
                                        <th scope="col">F</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                    $number_seats_vip = floor($transaction->flight->plane->number_seats_vip / 6);
                                    $number_seats = floor($transaction->flight->plane->number_seats / 6);
                                    $seat = $number_seats_vip + $number_seats;
                                    $remaining_seats = ($transaction->flight->plane->number_seats_vip + $transaction->flight->plane->number_seats) - ($seat * 6)
                                @endphp

                                <tbody>
                                    @for($i; $i <= $number_seats_vip; $i++)
                                        <tr >
                                            <td><label class="option-seat" for="option-seat-a-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-a-{{ $i }}" {{ in_array(geSeat('A', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="A{{$i}}">A{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-b-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-b-{{ $i }}" {{ in_array(geSeat('B', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="B{{$i}}">B{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-c-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-c-{{ $i }}" {{ in_array(geSeat('C', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="C{{$i}}">C{{$i}}</label></td>
                                            <td></td>
                                            <td><label class="option-seat" for="option-seat-d-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-d-{{ $i }}" {{ in_array(geSeat('D', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="D{{$i}}">D{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-e-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-e-{{ $i }}" {{ in_array(geSeat('E', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="E{{$i}}">E{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-f-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-f-{{ $i }}" {{ in_array(geSeat('F', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="F{{$i}}">F{{$i}}</label></td>
                                        </tr>
                                    @endfor
                                    @for($i; $i <= $seat; $i++)
                                        <tr>
                                            <td><label class="option-seat" for="option-seat-a-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-a-{{ $i }}" {{ in_array(geSeat('A', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="A{{$i}}">A{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-b-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-b-{{ $i }}" {{ in_array(geSeat('B', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="B{{$i}}">B{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-c-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-c-{{ $i }}" {{ in_array(geSeat('C', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="C{{$i}}">C{{$i}}</label></td>
                                            <td></td>
                                            <td><label class="option-seat" for="option-seat-d-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-d-{{ $i }}" {{ in_array(geSeat('D', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="D{{$i}}">D{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-e-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-e-{{ $i }}" {{ in_array(geSeat('E', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="E{{$i}}">E{{$i}}</label></td>
                                            <td><label class="option-seat" for="option-seat-f-{{ $i }}"><input type="checkbox" class="input-seat" id="option-seat-f-{{ $i }}" {{ in_array(geSeat('F', $i), $seats) ? 'disabled' : '' }} name="seats[]" value="F{{$i}}">F{{$i}}</label></td>
                                        </tr>
                                    @endfor
                                    <tr>
                                        @for($j = 1; $j <= $remaining_seats; $j++)
                                            @if ($j == 1)
                                                <td><label class="option-seat" for="option-seat-a-{{ $i + 1}}"><input type="checkbox" class="input-seat" id="option-seat-a-{{ $i + 1}}" {{ in_array(geSeat('A', $i + 1), $seats) ? 'disabled' : '' }} name="seats[]" value="A{{$i + 1}}">A{{$i + 1}}</label></td>
                                            @endif
                                            @if ($j == 2)
                                                <td><label class="option-seat" for="option-seat-b-{{ $i + 1 }}"><input type="checkbox" class="input-seat" id="option-seat-b-{{ $i + 1 }}" {{ in_array(geSeat('B', $i + 1), $seats) ? 'disabled' : '' }} name="seats[]" value="B{{$i + 1}}">B{{$i + 1}}</label></td>
                                            @endif
                                            @if ($j == 3)
                                                <td><label class="option-seat" for="option-seat-c-{{ $i + 1 }}"><input type="checkbox" class="input-seat" id="option-seat-c-{{ $i + 1 }}" {{ in_array(geSeat('C', $i + 1), $seats) ? 'disabled' : '' }} name="seats[]" value="C{{$i + 1}}">C{{$i + 1}}</label></td>
                                            @endif
                                            @if ($j > 3)
                                            <td></td>
                                            @endif
                                            @if ($j == 4)
                                                <td><label class="option-seat" for="option-seat-d-{{ $i + 1 }}"><input type="checkbox" class="input-seat" id="option-seat-d-{{ $i + 1 }}" name="seats[]" {{ in_array(geSeat('D', $i + 1), $seats) ? 'disabled' : '' }} value="D{{$i + 1}}">D{{$i + 1}}</label></td>
                                            @endif
                                            @if ($j == 5)
                                                <td><label class="option-seat" for="option-seat-e-{{ $i + 1 }}"><input type="checkbox" class="input-seat" id="option-seat-e-{{ $i + 1 }}" name="seats[]" {{ in_array(geSeat('E', $i + 1), $seats) ? 'disabled' : '' }} value="E{{$i + 1}}">E{{$i + 1}}</label></td>
                                            @endif
                                            @if ($j == 6)
                                                <td><label class="option-seat" for="option-seat-e-{{ $i + 1 }}"><input type="checkbox" id="option-seat-e-{{ $i + 1 }}" name="seats[]" {{ in_array(geSeat('F', $i + 1), $seats) ? 'disabled' : '' }} value="E{{$i + 1}}">E{{$i + 1}}</label></td>
                                            @endif
                                        @endfor
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop
@section('script')
@stop