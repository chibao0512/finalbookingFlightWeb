<head>
    <title>@yield('title', 'ABAY.VN')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('page/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('page/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{!! asset('admin/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <link rel="stylesheet" href="{{ asset('page/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('page/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('page/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('page/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('page/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('page/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('page/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('page/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('page/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('page/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/toastr/toastr.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/plugins/jquery-confirm/dist/jquery-confirm.min.css') !!}">

    <link rel="stylesheet" href="{{ asset('page/css/page.css') }}">

    @yield('style')
</head>