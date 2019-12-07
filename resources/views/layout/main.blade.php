<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', "Aplikasi Big Data
        -
        BADAN PENGEMBANGAN SDM PERHUBUNGAN")</title>

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
    <!-- datepicker -->
	<link href="{{ asset('css/datepicker/datepicker.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/bpsdm-styling.css') }}" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]

        <link rel="stylesheet" type="text/css" href="css/sia-mocca{LOADER_NAME_ADDITONAL}-loader.css" title="Mocca"/>
    -->
    <link href="{{ asset('img/favicon.png') }}" rel="SHORTCUT ICON" />
    @yield('style')
</head>

<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<header class="header">
    @php
        $loggedUser = currentUser();
    @endphp
    <a href="" class="logo">
        <img src="{{ asset('img/kemenhub.png') }}">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <div class="logo--text">
	        <h2>{{ ucwords(trans('common.application_name')) }}</h2>
	        <h3>{{ ucwords(trans('common.app_sub_name_short')) }}</h3>
		</div>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>
                            @if(!empty($loggedUser->getOrg()))
                                {{ $loggedUser->getOrg()->getName() }}
                            @else
                                {{ $loggedUser->getName() }}
                            @endif
                            <i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('img/bpsdmp.png') }}" class="img-circle" alt="Logo" />
                            <p>
                                @if(!empty($loggedUser->getOrg()))
                                    {{ $loggedUser->getOrg()->getName() }}
                                @else
                                    {{ $loggedUser->getName() }}
                                @endif
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div>
                                <a href="{{ url(route('update.profile')) }}" class="btn btn-default btn-flat" style="margin-right: 15px;">{{ ucwords(trans('common.update_profile')) }}</a>
                                <a href="{{ url(route('logout')) }}" class="btn btn-default btn-flat">{{ ucfirst(trans('common.sign_out')) }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            @include('layout.partial.navbar')
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        @yield('content')
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

	<!-- jQuery 1.8.2 -->
	<script src="{{ asset('js/jquery.1.8.2.min.js') }}"></script>

	<!-- highcharts -->
	<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
	<script src="{{ asset('js/highcharts/highcharts-3d.js') }}"></script>
	<script src="{{ asset('js/highcharts/modules/drilldown.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('js/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

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

    <script src="{{ asset('js/bpsdm-scripts.js') }}" type="text/javascript"></script>

	<!-- gsStudentDashboard dashboard -->
	<script src="{{ asset('js/gsStudentDashboard/dashboard.js') }}" type="text/javascript"></script>
    @yield('script')
</body>
</html>
