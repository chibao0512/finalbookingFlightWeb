@extends('page.layouts.page')
@php $title =  isset($category) ? $category->name : 'Tin tức' @endphp
@section('title', 'B-Air- '. $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-lg-4">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($articles as $article)
                            <div class="team d-md-flex p-4 bg-white">
                                <img src="{{ !empty($article->image) ? asset(pare_url_file($article->image)) : '' }}" alt="Image placeholder" class="img-fluid mb-4">
                                <div class="text pl-md-4">
                                    <h2>{{ $article->name }}</h2>
                                    <span class="position">{{ isset($article->user) ? $article->user->name : '' }}</span>
                                    <p class="mb-2">
                                        {{ the_excerpt($article->description, 200) }}
                                    </p>
                                    <span class="seen">{{ getDateTime($language = "en", $getDay = 1, $getDate = 1, $getTime = 0, $timeZone = "GMT+7", strtotime($article->created_at)) }}</span>
                                    <p><a href="{{ route('user.article.detail', ['id' => $article->id, 'slug' => $article->slug]) }}" class="btn btn-primary">More</a></p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                {{ $articles->appends($query)->links('page.paginator.index') }}
                            </div>
                        </div>
                    </div>
                </div>
                @include('page.common.sidebar_new')
            </div>
        </div>
    </section>
@stop
@section('script')
@stop