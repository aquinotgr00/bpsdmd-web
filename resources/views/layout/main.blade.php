<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>

	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- bootstrap 3.0.2 -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="{{ asset('css/gsStudentDashboard.css') }}" rel="stylesheet" type="text/css" />
	<!-- gsFontsEmbed -->
	<link href="{{ asset('gsFonts/gsFontsEmbed.css') }}" rel="stylesheet" type="text/css" />

	<!-- DATA TABLES -->
	<link href="{{ asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]

        <link rel="stylesheet" type="text/css" href="css/sia-mocca{LOADER_NAME_ADDITONAL}-loader.css" title="Mocca"/>
    -->


    <link href="{{ asset('img/favicon.png') }}" rel="SHORTCUT ICON" />

</head>

<body class="skin-blue">
	@include('layout.navbar')

	<!-- jQuery 1.8.2 -->
	<script src="{{ asset('js/jquery.1.8.2.min.js') }}"></script>

	<!-- highcharts -->
	<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
	<script src="{{ asset('js/highcharts/highcharts-3d.js') }}"></script>
	<script src="{{ asset('js/highcharts/modules/drilldown.js') }}"></script>

	<!-- jQuery UI 1.10.3 -->
	<script src="{{ asset('js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
	<!-- iCheck -->
	<script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

	<!-- DATA TABLES SCRIPT -->
	<script src="{{ asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>

	<!-- gsStudentDashboard App -->
	<script src="{{ asset('js/gsStudentDashboard/app.js') }}" type="text/javascript"></script>

	<!-- gsStudentDashboard dashboard -->
	<script src="{{ asset('js/gsStudentDashboard/dashboard.js') }}" type="text/javascript"></script>

</body>
</html>