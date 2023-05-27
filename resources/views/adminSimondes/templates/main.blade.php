<!doctype html>
<html class="fixed sidebar-left-sm">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Irban | SIMONDes</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="/assets/irban/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/animate/animate.compat.css">
		<link rel="stylesheet" href="/assets/irban/vendor/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/boxicons/css/boxicons.min.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/morris/morris.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/owl.carousel/assets/owl.carousel.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/owl.carousel/assets/owl.theme.default.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/elusive-icons/css/elusive-icons.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/datatables/media/css/dataTables.bootstrap5.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/simple-line-icons/css/simple-line-icons.css" />
		<link rel="stylesheet" href="/assets/irban/vendor/pnotify/pnotify.custom.css" />
		
		<script src="/package/dist/sweetalert2.min.js"></script>
    	<link rel="stylesheet" href="/package/dist/sweetalert2.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="/assets/irban/css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="/assets/irban/css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="/assets/irban/css/custom.css">

		<!-- Head Libs -->
		<script src="/assets/irban/vendor/modernizr/modernizr.js"></script>

	</head>
	<body data-plugin-page-transition>
		<div class="body">
		@include('adminSimondes.templates.topbar')

		@include('adminSimondes.templates.navbar')

		@yield('content')
		@include('adminSimondes.templates.footer')
		@include('adminSimondes.templates.notice')

		@stack('script')
	</body>

</html>