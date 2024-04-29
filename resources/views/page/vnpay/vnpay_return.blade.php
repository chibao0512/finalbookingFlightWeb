<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thông tin thanh toán</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/page/vnpay/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{ asset('/page/vnpay/jumbotron-narrow.css') }}" rel="stylesheet">
    <script src="{{ asset('/page/vnpay_php/jquery-1.11.3.min.js') }}"></script>
</head>
<body>
<!--Begin display -->
<div class="container">
    <div class="header clearfix">
        <h3 class="text-muted">Information order</h3>
    </div>
    <div class="table-responsive">
        <div class="form-group">
            <label >Code orders: {{ $vnpayData['vnp_TxnRef'] }}</label>
            <label></label>
        </div>
        <div class="form-group">
            <label >Amount:</label>
            <label> {{ number_format($vnpayData['vnp_Amount'] / 100,0,',','.') }} VNĐ</label>
        </div>
        <div class="form-group">
            <label >Content billing: {{ $vnpayData['vnp_OrderInfo'] }}</label>
            <label></label>
        </div>
        <div class="form-group">
            <label >Response code(vnp_ResponseCode): {{ $vnpayData['vnp_ResponseCode'] }}</label>
            <label></label>
        </div>
        <div class="form-group">
            <label >Mã GD Tại VNPAY: {{ $vnpayData['vnp_TransactionNo'] }}</label>
            <label></label>
        </div>
        <div class="form-group">
            <label >Bank Code: {{ $vnpayData['vnp_BankCode'] }}</label>
            <label></label>
        </div>
        <div class="form-group">
            <label >Payment time: {{ date('Y-m-d H:i', strtotime($vnpayData['vnp_PayDate'])) }}</label>
            <label></label>
        </div>
        <div class="form-group">
            <label >Result: Education Successful</label>
            <label>
            </label>
            <br>
            <a href="{{ route('user.home.index') }}">
                <button>Back</button>
            </a>
        </div>
    </div>
    <p>
        &nbsp;
    </p>
    <footer class="footer">
        <p>&copy; </p>
    </footer>
</div>
</body>
</html>