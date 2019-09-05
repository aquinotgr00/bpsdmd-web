<!DOCTYPE html>
<!--[if IE 8]><html class="ie8"><![endif]--><!--[if IE 9]>
<html class="ie9 gt-ie8"> <![endif]--><!--[if gt IE 9]><!-->
<html class="gt-ie8 gt-ie9 not-ie pxajs"><!--<![endif]-->
<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
        Student Dashboard
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

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<link href="{{ asset('img/favicon.png') }}" rel="SHORTCUT ICON" />

</head>
<body class="theme-default page-signin">
	<!-- Page background -->
	<div id="page-signin-bg">
		<!-- Background overlay -->
		<div class="overlay"></div>
		<!-- Replace this with your bg image -->
		<img style="" src="{{ asset('img/loginbg.jpg') }}" alt="">
	</div>
	<!-- / Page background -->

	<!-- Container -->
	<div class="signin-container">

		<!-- Left side -->
		<div class="signin-info">
			<a href="#" class="logo">
				{{ config('app.name') }}
			</a> <!-- / .logo -->
			{{-- <div class="slogan">
				Company name
			</div> --}}
			<!-- / .slogan -->
			<ul>
				<li><i class="fa fa-dashboard signin-icon"></i> Dashboard</li>
				<li><i class="fa fa-bar-chart-o signin-icon"></i> Grafik</li>
				<li><i class="fa fa-table signin-icon"></i> Tabular</li>
				<li><i class="fa fa-search signin-icon"></i> Pencarian Taruna</li>
			</ul> <!-- / Info list -->
		</div>
		<!-- / Left side -->

		<!-- Right side -->
		<div class="signin-form">
			<div class="text-center">
				<img src="{{ asset('img/bpsdmp.png') }}" alt="" style="margin-top: -5px;">
			</div>

			<!-- Form -->
			<form name="form_register" id="form-register" method="POST" enctype="multipart/form-data">@csrf
				<div class="signin-text">
					<span>Sign Up</span>

                    @if(session('alert') ?? false)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('alert') }}
                        </div>
                    @endif
                </div> <!-- / .signin-text -->
                
                <label for="photo">Nama Organisasi</label>
                <div class="form-group w-icon {{ $errors->has('org') ? 'has-error' : '' }}">
					<input name="org" id="org_id" class="form-control input-lg" placeholder="Nama Organisasi" type="text">
					<span class="fa fa-user signin-form-icon"></span>
                    <span class="help-block ">{!! implode('', $errors->get('org')) !!}</span>
                </div> <!-- / Org -->
                
                <label for="photo">Nama</label>
                <div class="form-group w-icon {{ $errors->has('name') ? 'has-error' : '' }}">
					<input name="name" id="name_id" class="form-control input-lg" placeholder="Nama" type="text">
					<span class="fa fa-user signin-form-icon"></span>
                    <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
                </div> <!-- / Name -->
                
                <label for="photo">Email</label>
                <div class="form-group w-icon {{ $errors->has('email') ? 'has-error' : '' }}">
					<input name="email" id="email_id" class="form-control input-lg" placeholder="Email" type="text">
					<span class="fa fa-user signin-form-icon"></span>
                    <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
                </div> <!-- / Email -->
                
                <label for="photo">Foto</label>
                <div class="form-group w-icon {{ $errors->has('image_file') ? 'has-error' : '' }}">
					<input name="image_file" type="file">
                    <span class="help-block ">{!! implode('', $errors->get('image_file')) !!}</span>
                </div> <!-- / photo -->

                <div class="form-group required required-asterisk">
                    <div class="checkbox">
                        <label for="supAgreement">
                                <input type="checkbox" name="agreement" id="supAgreement" required>
                                Dengan ini saya menyatakan bahwa data yang saya isikan adalah benar.
                        </label>
                    </div>
                </div>

                <div class="form-group alert alert-info small text-justify">
                    Setelah Anda mengirim formulir ini, kami akan mengirimkan email aktivasi akun Anda ke alamat email Anda.
                </div>

				<div class="form-actions text-center">
					<div>
						<input type="submit" value="Daftar" class="signin-btn bg-primary" />
					</div>
				</div> <!-- / .form-actions -->
            </form>
            <div class="text-center" style="margin-top: 1em;">
                <a href="{{ route('login') }}">Login</a>
            </div>
			<!-- / Form -->

		</div>
		<!-- Right side -->
	</div>
	<!-- / Container -->

</body>
</html>
