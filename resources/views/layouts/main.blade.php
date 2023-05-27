<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SIMONDes</title>
	<meta name="keywords" content="HTML5 Template" />
	<meta name="description" content="Porto - Responsive HTML5 Template">
	<meta name="author" content="okler.net">
	<!-- Favicon -->
	<link rel="shortcut icon" href="/img/logolampura2.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="/img/logolampura2.ico">
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
	<!-- Web Fonts  -->
	<link id="googleFonts"
		href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap"
		rel="stylesheet" type="text/css">
	<!-- Vendor CSS -->
	{{--
	<link rel="stylesheet" href="/assets/home/vendor/bootstrap/css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="/assets/home/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="/assets/home/vendor/animate/animate.compat.css">
	<link rel="stylesheet" href="/assets/home/vendor/simple-line-icons/css/simple-line-icons.min.css">
	<link rel="stylesheet" href="/assets/home/vendor/owl.carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="/assets/home/vendor/owl.carousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="/assets/home/vendor/magnific-popup/magnific-popup.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="/assets/home/css/theme.css">
	<link rel="stylesheet" href="/assets/home/css/theme-elements.css">
	<link rel="stylesheet" href="/assets/home/css/theme-blog.css">
	<link rel="stylesheet" href="/assets/home/css/theme-shop.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">

	<!-- Current Page CSS -->
	<link rel="stylesheet" href="/assets/home/vendor/circle-flip-slideshow/css/component.css">

	<!-- Skin CSS -->
	<link id="skinCSS" rel="stylesheet" href="/assets/home/css/skins/default.css">

	<link rel="stylesheet" href="/assets/home/css/demos/demo-landing.css">
	<!-- <link id="skinCSS" rel="stylesheet" href="/assets/home/css/skins/skin-landing.css"> -->

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="/assets/home/css/custom.css">

	<!-- Head Libs -->
	<script src="/assets/home/vendor/modernizr/modernizr.min.js"></script>


	<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
		<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->

</head>

<body data-plugin-page-transition>
	<div class="body">
		@include('layouts.navbar')

		@yield('content')
		@include('layouts.footer')


		@stack('script')
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
		</script>
</body>

</html>