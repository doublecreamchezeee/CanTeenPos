<!DOCTYPE HTML>
<html>
	<head>
		<title>Canteen</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{('assets/bootstrap/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{('assets/css/main.css')}}" />
		<noscript><link rel="stylesheet" href="{{('assets/css/noscript.css')}}" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
                <header id="header">
                    <div class="inner d-flex justify-content-between align-items-center">
                        <!-- Left link-->
                        <div class="left-links">
                            <a href="{{ route('homepage') }}" class="logo">
                                <span class="fa fa-cutlery"></span> <span class="title">CanteenUS</span>
                            </a>
                        </div>
						<!-- Right link-->
						<div class="right-links">
							<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
								<a href="{{ route('homepage') }}" class="logo">
                            		<span class="title">Menu</span>
                        		</a>

								<span class='logo'>|</span>
								<a href="{{ route('homepage') }}" class="logo">
                            		<span class="title">Wheel of fortune</span>
                        		</a>

								<span class='logo'>|</span>
								@if (Route::has('login'))
									@auth
										<a href="{{ url('/admin') }}" class="logo">
											<span class="title">Home</span>
									</a>
									@else
										<a href="{{ route('login') }}" class="logo">
											<span class="title">Log in</span>
										</a>

										<span class='logo'>|</span>
										@if (Route::has('register'))
											<a href="{{ route('register') }}" class="logo">
												<span class="title">Register</span>
											</a>
										@endif
									@endauth
									
								@endif
								<span class='logo'>|</span>
								<a href="{{ route('homepage') }}" class="logo">
                            		<span class="title">Cart</span>
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
								<ul class="icons">
									<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon style2 fa-linkedin"><span class="label">LinkedIn</span></a></li>
								</ul>

								&nbsp;
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

	</body>
</html>