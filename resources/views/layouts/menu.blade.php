<!DOCTYPE HTML>
<html>
	<head>
		<title>Canteen</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{('assets/bootstrap/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{('assets/css/main.css')}}" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
		<!-- <noscript><link rel="stylesheet" href="{{('assets/css/noscript.css')}}" /></noscript> -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
		rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	</head>
	<body class="is-preload">
		<script scr="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
			integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
		</script>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
                <header id="header">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <!-- Left link-->
                        <div class="left-links">
                            <a href="{{ route('homepage') }}" class="logo">
                                <span class="fa fa-cutlery"></span> 
								<span class="title">CanteenUS</span>
                            </a>
                        </div>
						<!-- Right link-->
						<div class="right-links">
							<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
								<a href="{{ route('homepage') }}" class="logo">
                            		<span class="title">Menu</span>
                        		</a>

								<span class='logo'>|</span>
								<a href="{{ route('wheel') }}" class="logo">
                            		<span class="title">Vòng xoay</span>
                        		</a>

								<span class='logo'>|</span>
								@if (Route::has('login'))
									@auth
										<a href="{{ url('/admin') }}" class="logo">
											<span class="title">Trang chủ</span>
									</a>
									@else
										<a href="{{ route('login') }}" class="logo">
											<span class="title">Đăng nhập</span>
										</a>

										<span class='logo'>|</span>
										@if (Route::has('register'))
											<a href="{{ route('register') }}" class="logo">
												<span class="title">Đăng kí</span>
											</a>
										@endif
									@endauth
									
								@endif
								<span class='logo'>|</span>

								<a href="{{ route('checkout') }}" class="logo">					
									<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								</a>

							</div>
						</div>     
                    </div>
                </header>

				<!-- Main -->
					<div id="main">
						<div class="image main">
							<img src="{{('images/banner-image-5-1920x500.jpg') }}" class="img-fluid" alt="" />
						</div>

						<div class="inner">
							@yield('content')
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>
									<span class="fa fa-cutlery"></span> 
									<span class="title">CanteenUS</span>
								</h2>

								<p>
									Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. 
									Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, 
									vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum sit amet, 
									fergiat. Pellentesque in mi eu massa lacinia malesuada et a elit. Donec urna ex, lacinia in 
									purus ac, pretium pulvinar mauris. Curabitur sapien risus, commodo eget turpis at, elementum 
									convallis elit. Pellentesque enim turpis, hendrerit tristique.
								</p>
							</section>
							
							<section>
								<h2>Thông tin liên hệ</h2>

								<ul class="alt">
									<li><span class="fa fa-envelope-o"></span> <a href="#">canteenus@company.com</a></li>
									<li><span class="fa fa-phone"></span> +84 333 4040 5566 </li>
									<li><span class="fa fa-map-pin"></span> Canteen Trường Đại học Khoa học tự nhiên, Linh Trung, Thủ Đức, Tp.HCM</li>
								</ul>
							</section>

							<ul class="copyright">
								<li>Copyright © 2020 Company Name </li>
								<li>Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="{{('assets/js/jquery.min.js')}}"></script>
			<script src="{{('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
			<script src="{{('assets/js/jquery.scrolly.min.js')}}"></script>
			<script src="{{('assets/js/jquery.scrollex.min.js')}}"></script>
			<script src="{{('assets/js/main.js')}}"></script>
	@yield('script')
	</body>
</html>