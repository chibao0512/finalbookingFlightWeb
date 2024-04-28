<div class="hero-wrap img" style="background-image: url({{ asset('page/images/bg_3.jpg') }}); background-size: 100% 100%;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-10 d-flex align-items-center ftco-animate">
                <div class="text text-center pt-5 mt-md-5">
                    <p class="mb-4">Tìm và đặt vé máy bay khuyến mãi & vé giá rẻ chỉ với 3 bước đơn giản!</p>
                    <h1 class="mb-5">Vé máy bay giá rẻ</h1>
                    <div class="ftco-counter ftco-no-pt ftco-no-pb">
                        <div class="row">
                            <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18">
                                    <div class="text d-flex">
                                        <div class="icon mr-2">
                                            <span class="flaticon-worldwide"></span>
                                        </div>
                                        <div class="desc text-left">
                                            <strong class="number" data-number="{{ $number_location }}">0</strong>
                                            <span>Địa điểm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text d-flex">
                                        <div class="icon mr-2">
                                            <span class="flaticon-visitor"></span>
                                        </div>
                                        <div class="desc text-left">
                                            <strong class="number" data-number="{{ $number_user }}">0</strong>
                                            <span>Khách hàng</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text d-flex">
                                        <div class="icon mr-2">
                                            <span class="flaticon-resume"></span>
                                            {{--<i class="fa fa-fw fa-plane"></i>--}}
                                        </div>
                                        <div class="desc text-left">
                                            <strong class="number" data-number="{{ $number_airlines }}">0</strong>
                                            <span>Hãng máy bay</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ftco-search my-md-5">
                        <div class="row">
                            <div class="col-md-12 nav-link-wrap">
                                <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Tìm kiếm vé máy bay</a>

                                    {{--<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Find a Candidate</a>--}}

                                </div>
                            </div>
                            <div class="col-md-12 tab-wrap">

                                <div class="tab-content p-4" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                                        <form action="{{ route('user.flight.search') }}" class="search-job" method="GET">
                                            <div class="row no-gutters">
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <lable for="start_location" style="float: left;">Điểm đi</lable>
                                                            <div class="select-wrap">
                                                                <div class="icon"><span class="icon-map-marker"></span></div>
                                                                <select name="start_location" id="start_location" class="form-control" tabindex="1">
                                                                    <option value="">Điểm đi</option>
                                                                    @foreach($locations as $location)
                                                                        <option value="{{ $location->id }}">{{ $location->name.'('.$location->code_no.')' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <lable for="end_location" style="float: left;">Điểm đến</lable>
                                                            <div class="select-wrap">
                                                                <div class="icon"><span class="icon-map-marker"></span></div>
                                                                <select name="end_location" id="end_location" class="form-control" tabindex="2">
                                                                    <option value="">Điểm đến</option>
                                                                    @foreach($locations as $location)
                                                                        <option value="{{ $location->id }}">{{ $location->name.'('.$location->code_no.')' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <lable for="start_date" style="float: left;">Ngày đi</lable>
                                                        <div class="form-field">
                                                            {{--<div class="icon"><span class="icon-map-marker"></span></div>--}}
                                                            <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Ngày đi" tabindex="3">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md mr-md-">
                                                    <div class="form-group">
                                                        <lable for="end_date" style="float: left;">Ngày về</lable>
                                                        <div class="form-field">
                                                            {{--<div class="icon"><span class="icon-map-marker"></span></div>--}}
                                                            <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Ngày đến" tabindex="4">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <lable for="adult" style="float: left;">Người lớn (≥ 12 tuổi)</lable>
                                                        <div class="form-field">
                                                            {{--<div class="icon"><span class="icon-map-marker"></span></div>--}}
                                                            <input type="number" name="adult" id="adult" class="form-control" placeholder="" value="1" tabindex="5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <lable for="children" style="float: left;">Trẻ em (2-12 tuổi)</lable>
                                                        <div class="form-field">
                                                            {{--<div class="icon"><span class="icon-map-marker"></span></div>--}}
                                                            <input type="number" class="form-control" name="children" placeholder="" value="0" tabindex="6">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <lable for="baby" style="float: left;">Em bé (< 2 tuổi)</lable>
                                                        <div class="form-field">
                                                            {{--<div class="icon"><span class="icon-map-marker"></span></div>--}}
                                                            <input type="number" class="form-control" name="baby" placeholder="(< 2 tuổi)" value="0" tabindex="7">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <lable style="float: left;">Hạng vé</lable>
                                                        <div class="form-field">
                                                            <select name="ticket_class" id="ticket_class" class="form-control" tabindex="8">
                                                                @foreach($ticket_class as $key => $ticket)
                                                                    <option value="{{ $key }}">{{ $ticket }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <div class="form-field" style="margin-top: 30px;">
                                                            <button type="submit" class="form-control btn btn-primary" tabindex="9">Tìm kiếm</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>