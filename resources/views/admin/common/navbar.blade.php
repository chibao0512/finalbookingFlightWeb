<nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            @php
                $user = Auth::user();
            @endphp
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ !empty($user->avatar) ? asset(pare_url_file($user->avatar)) : asset('/admin/dist/img/avatar5.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{!! $user->name !!}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ !empty($user->avatar) ? asset(pare_url_file($user->avatar)) : asset('/admin/dist/img/avatar5.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                    <p>
                        {!! isset($user->name) ? $user->name : '' !!}
                        <small>{!! isset($user->email) ? $user->email : '' !!}</small>
                        <small>{!! isset($user->phone) ? $user->phone : '' !!}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>