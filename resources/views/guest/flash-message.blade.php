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


<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <script>
        $(document).ready(function() {
            $('#flash-message-success').delay(500).fadeIn(250).delay(5000).fadeOut(500);
            $('#flash-message-fail').delay(500).fadeIn(250).delay(5000).fadeOut(500);
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
            padding: 10px;
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

    </style>

    
</body>