<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/daterangepicker/daterangepicker.css') !!}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/jquery-confirm/dist/jquery-confirm.min.css') !!}">
    <!-- select2 -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/select2/css/select2.min.css') !!}">
    <!-- toastr -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/toastr/toastr.min.css') !!}">

    <script src="{!! asset('admin/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! asset('admin/ckfinder/ckfinder.js') !!}"></script>
    <script src="{!! asset('admin/dist/js/func_ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/')!!}"
    </script>
    @yield('style-css')
    <link rel="stylesheet" href="{!! asset('admin/dist/css/adminlte.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/dist/css/style.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    @include('admin.common.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.common.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.control-footer -->
    @include('admin.common.footer')
    <!-- /.control-footer -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{!! asset('admin/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- overlayScrollbars -->
<script src="{!! asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('admin/dist/js/adminlte.min.js') !!}"></script>

<script src="{!! asset('admin/plugins/jquery-confirm/dist/jquery-confirm.min.js') !!}"></script>
<!--Select2 -->
<script src="{!! asset('admin/plugins/select2/js/select2.min.js') !!}"></script>
<!-- toastr -->
<script src="{!! asset('admin/plugins/toastr/toastr.min.js') !!}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{!! asset('admin/dist/js/demo.js') !!}"></script>

<script>
    var URL_AIRPORT = "{{ route('get.by.location') }}";
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
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>
<script src="{!! asset('admin/dist/js/main.js') !!}"></script>
@yield('script')
</body>
</html>
