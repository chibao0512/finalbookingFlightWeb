@extends('page.layouts.page')
@php $title = isset($airline_company) && $airline_company != null ? $airline_company->name : 'ABAY.VN -  Mua Bán Vé Máy Bay Giá Rẻ' @endphp
@section('title', $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 mb-5">
                    <div class="row">
                        <div class="col-md-12 ftco-animate">
                            @foreach($flights as $flight)
                                <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
                                    <div class="one-third mb-4 mb-md-0">
                                        <div class="d-flex" style="float: left; margin-right: 15px">
                                            <img src="{{ isset($flight->plane->airline_company) && !empty($flight->plane->airline_company->logo) ? asset(pare_url_file($flight->plane->airline_company->logo)) : asset('page/images/san-bay.png') }}" alt="{{ $flight->plane->airline_company->name }}" class="img-fluid" style="height: 100px">
                                        </div>

                                        <div class="job-post-item-header align-items-center">

                                            <span class="subadge">
                                                Mã chuyến bay : {{ $flight->code_no }}
                                                <span style="font-size: 11px;  color: black">
                                                    ({{ isset($flight->plane) ? $flight->plane->name : ''  }})
                                                </span>
                                            </span>
                                            <h4 class="mr-3 text-black">
                                                <span style="font-size: 14px;">{{ getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 0, $timeZone = "GMT+7", strtotime($flight->start_day))}}</span>
                                                <span style="font-size: 14px; margin-left: 15px">{{ number_format($flight->price,0,',','.') }} vnđ</span>
                                            </h4>

                                        </div>
                                        <div class="job-post-item-body d-block d-md-flex">
                                            <div class="mr-3">
                                                <a href="#">{{ isset($flight->start_location) ? $flight->start_location->name : '' }} ( {{ date('H:i', strtotime($flight->start_day)) }} )</a>
                                                <span><img src="{{ asset('page/images/icon/arrow-right.svg') }}" alt="" style="margin-left: 15px;"></span>
                                            </div>
                                            <div>
                                                <span>{{ isset($flight->end_location) ? $flight->end_location->name : '' }} ( {{ date('H:i', strtotime($flight->end_day)) }} )</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
                                        <div>
                                            <a href="#" class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                <span class="icon-heart"></span>
                                            </a>
                                        </div>
                                        <a href="{{ route('flight.book.ticket', $flight->id) }}" class="btn btn-primary py-2">Đặt vé </a>
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- end -->

                    </div>

                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                {{ $flights->appends($query)->links('page.paginator.index') }}
                            </div>
                        </div>
                    </div>
                </div>
                @include('page.common.sidebar')
            </div>
        </div>
    </section>
@stop
@section('script')
@stop