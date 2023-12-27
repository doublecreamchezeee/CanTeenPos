@if(Session::has('success'))
    <div class="alert alert-success" id="flash-message-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('fail'))
    <div class="alert alert-danger" id="flash-message-fail">
        {{ Session::get('fail') }}
    </div>
@endif

@if(Session::has('payment_success'))
    <div class="payment-success" id="flash-message-payment">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">x</span>
        </button>
        <span>Bạn đã tạo thành công đơn hàng với mã số <strong>{{ Session::get('payment_success')['id'] }}</strong> ! </span>
        <br>
        <span>Tổng số tiền bạn phải thanh toán là: <strong>{{ number_format(Session::get('payment_success')['total']) }}</strong> VNĐ</span>
    </div> 
@endif

@if(Session::has('payment_fail'))
    <div class="payment-fail" id="flash-message-payment-fail">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">x</span>
        </button>
        <span> Có lỗi xảy ra trong quá trình thanh toán. </span>
        <br>
        <span> Vui lòng thanh toán lại </span>
    </div> 
@endif



<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<script>
    $(document).ready(function() {
        $('#flash-message-success').delay(500).fadeIn(250).delay(5000).fadeOut(500);
        $('#flash-message-fail').delay(500).fadeIn(250).delay(5000).fadeOut(500);

        if ($('#flash-message-payment').length || $('#flash-message-payment-fail').length) {
            $('body').append('<div id="overlay" style="background-color: rgba(0,0,0,0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 4999;"></div>');
        }
        $('.close').click(function(){
            $(this).parent().fadeOut(0);
            $('#overlay').fadeOut(0);
        });
    });
</script>


    <style>
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            position: fixed;
            right: 60px;
            bottom: 60px;
            z-index: 5000;
            float: right;
            padding: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            position: fixed;
            right: 60px;
            bottom: 60px;
            z-index: 5000;
            float: right;
            padding: 10px;
            border-radius: 5px;
        }

        .payment-success {
            color: #155724;
            background-color: #d4edda;
            position: fixed;
            right: 35%;
            bottom: 60%;
            z-index: 5000;
            float: right;
            border-radius: 5px;
            width: auto; 
            padding: 40px;
            text-align: center;
        }

        .payment-fail {
            color: #721c24;
            background-color: #f8d7da;
            position: fixed;
            right: 35%;
            bottom: 60%;
            z-index: 5000;
            float: right;
            border-radius: 5px;
            width: auto; 
            padding: 40px;
            text-align: center;
        }

        .close {
            position: absolute;
            top: 0px;
            right: 0px;
            background: none;
            border: none;
            outline: none;
            font-size: 12px;
            text-align: center;
            width: 20px;
            height: 20px;
        }


    </style>
</body>