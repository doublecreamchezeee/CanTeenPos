<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title> 
    {{-- <script src="http://localhost:8097"></script> --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite('resources/sass/app.scss')
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('content-header')</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        @yield('content-actions')
                    </div><!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            @include('layouts.partials.alert.success')
            @include('layouts.partials.alert.error')
            @yield('content')
        </section>
    </div>
    <!-- /.content-wrapper -->


    @include('layouts.partials.footer')
    
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>

@yield('scripts')
</body>
</html>
