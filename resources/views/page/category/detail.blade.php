@extends('page.layouts.page')
@php $title =  isset($article) ? $article->name : 'News' @endphp
@section('title', 'B-Air - '. $title)
@section('style')
@stop
@section('content')
    @include('page.common.breadcrumbs', compact('title'))
    <section class="ftco-section ftco-candidates ftco-candidates-2 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ftco-animate fadeInUp ftco-animated">
                    <h2 class="mb-3">{{ $article->name }}</h2>
                    <p>
                        {{ $article->description }}
                    </p>
                    {!! $article->contents !!}
                </div>
                @include('page.common.sidebar_new')
            </div>
        </div>
    </section>
@stop
@section('script')
@stop