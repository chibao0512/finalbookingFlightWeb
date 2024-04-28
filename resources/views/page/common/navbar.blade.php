<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-4	">
        <a class="navbar-brand" href="{{ route('user.home.index') }}">ABAY.VN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/')  ? 'active' : '' }}"><a href="{{ route('user.home.index') }}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item"><a href="{{ route('user.airline.company') }}" class="nav-link">Chuyến bay</a></li>
                @foreach($categories as $category)
                <li class="nav-item  {{ request()->get('id') == $category->id  ? 'active' : '' }}"><a href="{{ route('user.category.index', ['slug' => $category->slug, 'id' => $category->id]) }}" class="nav-link">{{ $category->name }}</a></li>
                @endforeach

                @if (Auth::guard('user')->check())
                    @php
                        $user = Auth::guard('user')->user();
                    @endphp
                    <li class="nav-item">
                        <a href="{{ route('info.account') }}" class="nav-link">
                            Xin chào : {{ $user->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.page.logout') }}" class="nav-link">
                            Đăng Xuất
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('user.page.login') }}" class="nav-link">
                            Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.page.register') }}" class="nav-link">
                            Đăng ký
                        </a>
                    </li>
                @endif

                {{--<li class="nav-item"><a href="{{ route('user.page.login') }}" class="nav-link">Đăng ký</a></li>--}}
                {{--<li class="nav-item"><a href="contact.html" class="nav-link">Đăng nhập</a></li>--}}

                {{--<li class="nav-item cta mr-md-1"><a href="new-post.html" class="nav-link">Post a Job</a></li>--}}
                {{--<li class="nav-item cta cta-colored"><a href="job-post.html" class="nav-link">Want a Job</a></li>--}}

            </ul>
        </div>
    </div>
</nav>