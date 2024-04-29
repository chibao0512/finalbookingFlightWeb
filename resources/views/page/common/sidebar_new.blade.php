<div class="col-md-4 pl-md-5 sidebar ftco-animate fadeInUp ftco-animated">
    <div class="sidebar-box">
        <form action="{{ route('user.category.articles') }}" class="search-form">
            <div class="form-group">
                <span class="icon icon-search"></span>
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm tin tức">
            </div>
        </form>
    </div>
    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
        <div class="categories">
            <h3 class="heading-3">Category</h3>
            @foreach($categories as $category)
            <li><a href="{{ route('user.category.index', ['slug' => $category->slug, 'id' => $category->id]) }}">{{ $category->name }} <span>({{ $category->news->count() }})</span></a></li>
            @endforeach
        </div>
    </div>

    <div class="sidebar-box ftco-animate fadeInUp ftco-animated">
        <h3 class="heading-3">Tin tức mới</h3>
        @foreach($articles as $article)
        <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url({{ !empty($article->image) ? asset(pare_url_file($article->image)) : '' }});"></a>
            <div class="text">
                <h3 class="heading"><a href="{{ route('user.article.detail', ['id' => $article->id, 'slug' => $article->slug]) }}">{{ $article->name }}</a></h3>
                <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> {{ date('Y-m-d', strtotime($article->created_at)) }}</a></div>
                    <div><a href="#"><span class="icon-person"></span> {{ $article->user->name }}</a></div>
                    <div><a href="#"><img src="{{ asset('page/images/icon/eye-fill.svg') }}" alt="">  {{ $article->view }}</a></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>