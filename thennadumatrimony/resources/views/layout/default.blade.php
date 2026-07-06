<head>
	<meta charset="utf-8">
	<title>Thennadu Matrimony - Find Your Perfect Soulmate</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- site favicon -->
	<link rel="icon" type="image/png" href="{{ asset('assets/images/logo/matrilogo.png') }}">

	<!-- All stylesheet and icons css  -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/lightcase.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-matrimony.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Outfit:wght@400;600&family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>
<body>
    @if(session('success'))
        <script>window.onload = function() { Swal.fire('Success', "{{ session('success') }}", 'success'); };</script>
    @endif
    @if(session('error'))
        <script>window.onload = function() { Swal.fire('Error', "{{ session('error') }}", 'error'); };</script>
    @endif
    @if(session('info'))
        <script>window.onload = function() { Swal.fire('Info', "{{ session('info') }}", 'info'); };</script>
    @endif
    @if(session('warning'))
        <script>window.onload = function() { Swal.fire('Subscription Required', "{{ session('warning') }}", 'warning'); };</script>
    @endif
    @include('layout.header')
    @yield('content')
    @include('layout.footer')

	<!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>
    <!-- scrollToTop ending here -->
    
	<!-- All Needed JS -->
	<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
	<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/js/swiper.min.js') }}"></script>
	<script src="{{ asset('assets/js/wow.js') }}"></script>
	<script src="{{ asset('assets/js/lightcase.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>