<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">ABAY</h2>
                    <p>Công ty TNHH vé máy bay trực tuyến ABAY</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Bạn còn thắc mắc</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="pb-1 d-block">Liên hệ</a></li>
                        <li><a href="#" class="pb-1 d-block">Hướng dẫn thanh toán</a></li>
                        <li><a href="#" class="pb-1 d-block">Thông tin chuyển khoản</a></li>
                        <li><a href="#" class="pb-1 d-block">Hướng dẫn đặt vé</a></li>
                        <li><a href="#" class="pb-1 d-block">Câu hỏi thường gặp</a></li>
                        <li><a href="#" class="pb-1 d-block">Chăm sóc khách hàng</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Danh mục</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.home.index') }}" class="nav-link">Trang chủ</a></li>
                        @foreach($categories as $category)
                            <li><a href="{{ route('user.category.index', ['slug' => $category->slug, 'id' => $category->id]) }}" class="nav-link">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Tài khoản</h2>
                    <ul class="list-unstyled">
                        @if (Auth::guard('user')->check())
                            @php
                                $user = Auth::guard('user')->user();
                            @endphp
                            <li>
                                <a href="{{ route('info.account') }}">
                                    Xin chào : {{ $user->name }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.page.logout') }}" class="nav-link">
                                    Đăng Xuất
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('user.page.login') }}" class="nav-link">
                                    Đăng nhập
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.page.register') }}" class="nav-link">
                                    Đăng ký
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Thông tin liên hệ</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">ABAY TẠI HÀ NỘI 324 Phố Huế, Q.Hai Bà Trưng, Hà N</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">(+024) 7300 6091</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">contact@abay.vn</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</footer>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="{{ asset('page/js/jquery.min.js') }}"></script>
<script src="{{ asset('page/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('page/js/popper.min.js') }}"></script>
<script src="{{ asset('page/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('page/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('page/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('page/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('page/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('page/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('page/js/aos.js') }}"></script>
<script src="{{ asset('page/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('page/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('page/js/google-map.js') }}"></script>
<script src="{{ asset('page/js/main.js') }}"></script>
<script src="{{ asset('page/js/page.js') }}"></script>
<!-- toastr -->
<script src="{!! asset('admin/plugins/toastr/toastr.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/jquery-confirm/dist/jquery-confirm.min.js') !!}"></script>
<script>
    $(function () {

        toastr.options.closeButton = true;
                @if(session('success'))
        var message = "{{ session('success') }}";
        toastr.success(message, {timeOut: 3000});
                @endif
                @if(session('error'))
        var message = "{{ session('error') }}";
        toastr.error(message, {timeOut: 3000});
        @endif
        setTimeout(function(){ toastr.clear() }, 3000);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
</script>
    

@yield('script')