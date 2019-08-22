<!-- header logo: style can be found in header.less -->
<header class="header">
	<a href="" class="logo">
		<img src="{{ asset('img/logo.png') }}">
		<!-- Add the class icon to your logo image or logo icon to add the margining -->
		Nama Aplikasi
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
						<span>Ini adalah company short name <i class="caret"></i></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header bg-light-blue">
							<img src="{{ asset('img/bpsdmp.png') }}" class="img-circle" alt="Logo" />
							<p>
								Ini adalah nama company
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div>
								<a href="" class="btn btn-default btn-flat">Sign out</a>
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
			<!-- search form -->
			<form action="" method="post" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="studentName" class="form-control" placeholder="Type Nama/NIM/NIP"/>
					<input type="hidden" name="searchsimply" value="1" />
					<span class="input-group-btn">
						<button type='submit' name='cari' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="{CLASS_ACTIVE_DB}">
					<a href="{URL_MENU_DASHBOARD}">
						<i class="fa fa-dashboard"></i>
						<span>{NAME_MENU_DASHBOARD}</span>
					</a>
				</li>
				<li class="{CLASS_ACTIVE_LK}" style="display:none;">
					<a href="{URL_MENU_LAKIP}">
						<i class="fa fa-bar-chart"></i>
						<span>{NAME_MENU_LAKIP}</span>
					</a>
				</li>
				<li class="{CLASS_ACTIVE_SC}">
					<a href="{URL_MENU_SEARCH}">
						<i class="fa fa-search"></i>
						<span>{NAME_MENU_SEARCH}</span>
					</a>
				</li>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<section class="content-header">
			<h1>
				Dashboard
				<small>Ini adalah nama company</small>
			</h1>
			<ol class="breadcrumb">
				<li>
					<a href="#">
						<i class="fa fa-user"></i> {FAK_LABEL_USER}
					</a>
				</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			@yield('content')
		</section><!-- /.content -->

	</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
