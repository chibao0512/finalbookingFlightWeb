@extends('page.layouts.page')
@section('title', 'B-Air')
@section('style')
@stop
@section('content')
    @include('page.common.search')
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="category-wrap">
                        <div class="row no-gutters">
                            @foreach($airlines as $airline)
                            <div class="col-md-2">
                                <div class="top-category text-center no-border-left">
                                    <h3><a href="{{ route('user.airline.company', ['id' => $airline->id]) }}">{{ $airline->name }}</a></h3>
                                    <img src="{{ asset(pare_url_file($airline->logo)) }}" alt="{{ $airline->name }}" class="img-fluid" style="height: 100px">
                                    @php $number_flight = 0 @endphp
                                    @if(isset($airline->planes))
                                        @foreach($airline->planes as $plane)
                                            @if ($plane->flights)
                                                @php $number_flight = $number_flight + $plane->flights->count() @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    <p><span class="number">{{ $number_flight }}</span> <span>flights</span></p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">ENDOW</span>
                    <h2>PROMOTION</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach($articles as $article)
                    <div class="col-md-3 d-flex ftco-animate">
                        <div class="blog-entry align-self-stretch">
                            <a href="" class="block-20" style="background-image: url('{{ !empty($article->image) ? asset(pare_url_file($article->image)) : asset('admin/dist/img/no-image.png') }}');">
                            </a>
                            <div class="text mt-3">
                                <div class="meta mb-2">
                                    <div><a href="#">{{ formatDate($article->created_at) }}</a></div>
                                    <div><a href="#">{{ $article->user->name }}</a></div>
                                    <div><a href="#" class="meta-chat"><img src="{{ asset('page/images/icon/eye-fill.svg') }}" alt=""> {{ $article->view }}</a></div>
                                </div>
                                <h3 class="heading"><a href="{{ route('user.article.detail', ['id' => $article->id, 'slug' => $article->slug]) }}">{!! the_excerpt($article->name, 100) !!}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
   
    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-4">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">List</span>
                    <h2 class="mb-4">Airport</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        @foreach($airports as $airport)
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="mb-4"></p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url({{ asset('page/images/san-bay.png') }})"></div>
                                        <div class="pl-3">
                                            <p class="name">{{ $airport->name }}({{ $airport->code_no }})</p>
                                            <span class="position">{{ isset($airport->location) ? $airport->location->name : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    {{--<section class="ftco-section-parallax">--}}
        {{--<div class="parallax-img d-flex align-items-center">--}}
            {{--<div class="container">--}}
                {{--<div class="row d-flex justify-content-center">--}}
                    {{--<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">--}}
                        {{--<h2>Subcribe to our Newsletter</h2>--}}
                        {{--<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>--}}
                        {{--<div class="row d-flex justify-content-center mt-4 mb-4">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<form action="#" class="subscribe-form">--}}
                                    {{--<div class="form-group d-flex">--}}
                                        {{--<input type="text" class="form-control" placeholder="Enter email address">--}}
                                        {{--<input type="submit" value="Subscribe" class="submit px-3">--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger
      intent="WELCOME"
      chat-title="Chat AI B-BAY"
      agent-id="5417c2c2-044b-4e2c-80e1-993266669608"
      language-code="en"
    ></df-messenger>
@stop
@section('script')
@stop