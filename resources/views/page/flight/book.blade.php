@extends('page.layouts.page')
@php $title =  'ABAY.VN -  Mua Bán Vé Máy Bay Giá Rẻ' @endphp
@section('title', $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))

    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="row bg-white" >
                        <div class="col-sm-12 col-lg-4">
                            <div style="margin-top:15px ">
                                <span>{{ isset($flight->start_location) ? $flight->start_location->name : '' }}</span>
                                <span><img src="{{ asset('page/images/icon/arrow-right.svg') }}" alt="" style="margin-left: 10px; margin-right: 10px"></span>
                                <span>{{ isset($flight->end_location) ? $flight->end_location->name : '' }}</span>
                            </div>
                            <div class="d-flex" style="float: left;">
                                <img src="{{ isset($flight->plane->airline_company) && !empty($flight->plane->airline_company->logo) ? asset(pare_url_file($flight->plane->airline_company->logo)) : asset('page/images/san-bay.png') }}" alt="{{ $flight->plane->airline_company->name }}" class="img-fluid" style="height: 100px">
                                <span style="margin-top: 35px;">{{ $flight->plane->airline_company->name }}</span>
                            </div>
                            <div class="d-flex" style="float: left;">
                                <p>Máy bay : {{ $flight->plane->name }} ({{ $flight->code_no }})</p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3 ">
                            <div style="margin-top:15px ">
                                <p>{{ getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 0, $timeZone = "GMT+7", strtotime($flight->start_day))}}</p>
                                <p>{{ date('H:i', strtotime($flight->start_day)) }} - {{ date('H:i', strtotime($flight->end_day)) }}</p>
                            </div>
                        </div>
                        @php
                            $adult = $dataSearch['adult'] ?? 1;
                            $children = $dataSearch['children'] ?? 0;
                            $baby = $dataSearch['baby'] ?? 0;
                        @endphp
                        <div class="col-sm-12 col-lg-5">
                            <div style="margin-top:15px " class="table-price">
                                @include('page.flight.table_price', compact('dataSearch', 'flight'))
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form action="{{ route('flight.book.ticket', $flight->id) }}" class="list-user" method="post" style="margin-top: 30px">
                    <div class="row bg-white" >
                        <div class="col-md-12">
                            <h2>Thông tin người bay (vd: Nguyen Van An - người lớn)</h2>

                                <div class="list-adult">
                                    @for($i = 1; $i <= $adult ; $i++)
                                        @include('page.flight.item_adult', compact('i', 'flight'))
                                    @endfor
                                </div>
                                <div class="row">
                                    <div class="clk-sm-12 col-md-12">
                                        <button type="button" class="btn btn-success btn-plus-customer" style="float: right;"
                                                url="{{ route('flight.plus.customer') }}" flight_id="{{ $flight->id }}" type_customer="adult"><i class="fa fa-plus"></i> Thêm khách hàng</button>
                                    </div>

                                </div>
                                <hr>
                                <h2>Thông tin trẻ em </h2>
                                <div class="list-baby">
                                    @if($children > 0)
                                        @for($j =1; $j <= $children; $j++ )
                                            @php $type = 'children' @endphp
                                            @include('page.flight.item_baby', compact('flight', 'type'))
                                        @endfor
                                    @endif
                                    @if($baby > 0)
                                        @for($k =1; $k <= $baby; $k++ )
                                            @php $type = 'baby' @endphp
                                            @include('page.flight.item_baby', compact('flight', 'type'))
                                        @endfor
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="clk-sm-12 col-md-12">
                                        <button type="button" class="btn btn-success btn-plus-customer" style="float: right;"
                                                url="{{ route('flight.plus.customer') }}" flight_id="{{ $flight->id }}" type_customer="baby"><i class="fa fa-plus"></i> Thêm trẻ em</button>
                                    </div>
                                </div>
                                <hr>
                                <h2>Thông tin liên hệ</h2>
                                <div class="info-contact">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class=" form-group">
                                                <label class="font-weight-bold" for="fullname">Họ và tên <sup class="text-danger">(*)</sup></label>
                                                <input type="text" name="name_contact" class="form-control" value="{{ old('name_contact', isset($user) ? $user->name : '') }}" placeholder="Họ và tên">
                                                @if ($errors->first('name_contact'))
                                                    <span class="text-danger">{{ $errors->first('name_contact') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class=" form-group">
                                                <label class="font-weight-bold" for="fullname">Điện thoại <sup class="text-danger">(*)</sup></label>
                                                <input type="text" name="phone_contact" class="form-control" value="{{ old('phone_contact', isset($user) ? $user->phone : '') }}" placeholder="Điện thoại">
                                                @if ($errors->first('phone_contact'))
                                                    <span class="text-danger">{{ $errors->first('phone_contact') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class=" form-group">
                                                <label class="font-weight-bold" for="fullname">Emai </label>
                                                <input type="email" name="email_contact" class="form-control" value="{{ old('email_contact', isset($user) ? $user->email : '') }}" placeholder="Email">
                                                @if ($errors->first('email_contact'))
                                                    <span class="text-danger">{{ $errors->first('email_contact') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row bg-white" >
                        <div class="col-sm-12 col-lg-8">

                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p class="text-center">{{ getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 0, $timeZone = "GMT+7", strtotime($flight->start_day))}}  {{ date('H:i', strtotime($flight->start_day)) }}</p>
                            <p class="text-center">
                                <span>{{ isset($flight->start_location) ? $flight->start_location->code_no : '' }}</span>
                                <span><img src="{{ asset('page/images/icon/arrow-right.svg') }}" alt="" style="margin-left: 10px; margin-right: 10px"></span>
                                <span>{{ isset($flight->end_location) ? $flight->end_location->code_no : '' }}</span>
                            </p>
                        </div>
                        <div class="col-sm-12 col-lg-4" style="margin-bottom: 15px">
                            <a href="{{ route('user.airline.company') }}"><button type="button" class="form-control btn btn-warning">Chọn lại chuyến bay</button></a>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                        </div>
                        <div class="col-sm-12 col-lg-4" style="float: right; margin-bottom: 15px">
                            <button type="submit" class="form-control btn btn-primary">Đặt vé</button>
                        </div>
                        @csrf
                    </div>
                    </form>
                </div>
                @php $book =  true; @endphp
                @include('page.common.sidebar', compact('book'))
            </div>
        </div>
    </section>

@stop
@section('script')
@stop