<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-info">
        <img src="{!! asset('admin/dist/img/AdminLTELogo.png') !!}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">ABAY.VN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        @php
            $user = Auth::user();
        @endphp
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/admin/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{!! $user->name !!}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa fa-home"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('loaicv.index') }}" class="nav-link {{ isset($loai_cv_active) ? $loai_cv_active : '' }}">--}}
                        {{--<i class="nav-icon fas fa-clipboard-list"></i>--}}
                        {{--<p>Loại công việc</p>--}}
                    {{--</a>--}}
                {{--</li>--}}

                <li class="nav-item has-treeview {{ isset($data_location_active) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ isset($data_location_active) ? $data_location_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-map-marker"></i>
                        <p>Địa điểm<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('location.index') }}" class="nav-link {{ isset($location_active) ? $location_active : '' }}">
                                <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                <p>Địa điểm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('airport.index') }}" class="nav-link {{ isset($airport_active) ? $airport_active : '' }}">
                                <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                <p>Sân bay</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ isset($data_airline_active) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ isset($data_airline_active) ? $data_airline_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-plane"></i>
                        <p>Máy bay<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('airline.company.index') }}" class="nav-link {{ isset($airline_company_active) ? $airline_company_active : '' }}">
                                <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                <p>Hãng máy bay</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('plane.index') }}" class="nav-link {{ isset($plane_active) ? $plane_active : '' }}">
                                <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                <p>Quản lý máy bay</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('flight.index') }}" class="nav-link {{ isset($flight_active) ? $flight_active : '' }}">
                                <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                <p>Quản lý chuyến bay</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{ isset($data_article_active) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ isset($data_article_active) ? $data_article_active : '' }}">
                        <i class="nav-icon nav-icon fas fa-file-word"></i>
                        <p>Tin tức<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{ isset($category_active) ? $category_active : '' }}">
                                <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                <p>Danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('article.index') }}" class="nav-link {{ isset($article_active) ? $article_active : '' }}">
                                <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                <p>Tin tức</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('transaction.index') }}" class="nav-link {{ isset($transaction_active) ? $transaction_active : '' }}">
                        <i class="nav-icon fas fa-cart-plus" aria-hidden="true"></i>
                        <p>Quản lý đặt vé</p>
                    </a>
                </li>

                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('group.permission.index') }}" class="nav-link {{ isset($group_permission) ? $group_permission : '' }}">--}}
                        {{--<i class="nav-icon fa fa-hourglass" aria-hidden="true"></i>--}}
                        {{--<p>Nhóm quyền</p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a href="{{ route('permission.index') }}" class="nav-link {{ isset($permission_active) ? $permission_active : '' }}">--}}
                        {{--<i class="nav-icon fa fa-balance-scale"></i>--}}
                        {{--<p> Quyền </p>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ isset($role_active) ? $role_active : '' }}">
                        <i class="nav-icon fa fa-gavel" aria-hidden="true"></i>
                        <p> Vai trò </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ isset($user_active) ? $user_active : '' }}">
                        <i class="nav-icon fa fa-fw fa-user" aria-hidden="true"></i>
                        <p> Người dùng </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.change.password') }}" class="nav-link {{ isset($change_password) ? $change_password : '' }}">
                        <i class="nav-icon fa fa-fw fa-lock" aria-hidden="true"></i>
                        <p> Đổi mật khẩu </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
