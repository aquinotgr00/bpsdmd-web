<!DOCTYPE html>
<!--[if IE 8]><html class="ie8"><![endif]--><!--[if IE 9]>
<html class="ie9 gt-ie8"> <![endif]--><!--[if gt IE 9]><!-->
<html class="gt-ie8 gt-ie9 not-ie pxajs"><!--<![endif]-->
<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
        Aplikasi Big Data SIMSDMTRANAS
        -
        BADAN PENGEMBANGAN SDM PERHUBUNGAN
    </title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

	<!-- bootstrap 3.0.2 -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="{{ asset('css/login.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/loginpages.min.css') }}" rel="stylesheet" type="text/css">
	<!-- gsFontsEmbed -->
	<link href="{{ asset('gsFonts/gsFontsEmbed.css') }}" rel="stylesheet" type="text/css" />

	<!-- BPSDM styling -->
	<link href="{{ asset('css/bpsdm-styling.css') }}" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<link href="{{ asset('img/favicon.png') }}" rel="SHORTCUT ICON" />

	<style>
		.signin-form .form-group.required-asterisk > label::after, .signin-form .form-group.required-asterisk > div > label::after {
			content: " *";
			display: inline;
			font-size: 1.2em;
			color: red;
		}
		.signin-form .form-group .help-block {
			margin-top: 2px;
			margin-bottom: 0;
			font-size: 0.85em;
			font-style: italic;
		}
	</style>

	{!! NoCaptcha::renderJs('id') !!}

</head>
<body class="theme-default page-signin">
	<!-- Page background -->
	<div id="page-signin-bg">
		<!-- Background overlay -->
		<div class="overlay"></div>
	</div>
	<!-- / Page background -->

	<!-- Container -->
	<div class="signin-container">

        @if (!Request::is('verify/*'))
		<!-- Left side -->
		<div class="signin-info">
			<a href="#" class="logo">
				BIG DATA {{trans('common.application_name')}}
			</a> <!-- / .logo -->
			<div class="slogan">
				{{trans('common.app_sub_name')}}
			</div>
			<!-- / .slogan -->
			<div class="mascott">
				<img src="{{ asset('img/TARUNA BPSDMP.png') }}" alt="">
				<img src="{{ asset('img/Logo HARHUBNAS 2019.png') }}" alt="">
				<img src="{{ asset('img/TARUNI BPSDMP.png') }}" alt="">
			</div>
		</div>
        <!-- / Left side -->
        @endif

		<!-- Right side -->
		<div class="signin-form">
			<div style="text-align: center;">
				<img src="{{ asset('img/kemenhub.png') }}" alt="" style="margin-top: -5px;">
			</div>

            <!-- Content -->
            @yield('content')
            <!-- / Content -->
		</div>
		<!-- Right side -->
	</div>
	<!-- / Container -->

    @yield('script')
</body>
</html>
