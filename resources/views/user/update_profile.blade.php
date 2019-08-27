@extends('layout.main')

@section('content')

<section class="content-header">
	<h1>Update Profile</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button> 
						<strong>{{ $message }}</strong>
					</div>
					@endif

					@if ($message = Session::get('error'))
					<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button> 
						<strong>{{ $message }}</strong>
					</div>
					@endif
					<form method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name">name :</label>
							<input type="text" class="form-control" id="username" name="name" required="" value="{{ $user->getName() }}">
							<span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
						</div>
						<div class="form-group {{  $errors->has('username') ? 'has-error' : '' }}">
							<label for="username">Username :</label>
							<input type="text" class="form-control" id="username" name="username" value="{{ $user->getUserName() }}">
							<span class="help-block ">{!! implode('', $errors->get('username')) !!}</span>
						</div>
						
						<div class="input-group {{ $errors->has('photo') ? 'has-error' : '' }}">
							<img src="">
							<div class="input-group-prepend">
								<label class="custom-file-label" for="inputGroupFile01">Foto</label>
								<span class="help-block">File yang boleh diupload berformat : jpg, png, bmp</span>
								<span class="help-block">Ukuran maksimal file 500KB</span>

							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="inputGroupFile01"
								aria-describedby="inputGroupFileAddon01" name="photo">
								<span class="help-block ">{!! implode('', $errors->get('photo')) !!}</span>
							</div>
						</div>
						<div class="form-group">
							@if(is_null($user->getPhoto()))
							<img src="{{ url($user->getPhoto()) }}" width="100px" height="100px">
							@endif
						</div>
						<span class="help-block" style="color:red">Kosongkan password, password lama dan konfirmasi password jika tidak ingin diganti</span>
						<div class="form-group {{  $errors->has('old_password') ? 'has-error' : '' }}">
							<label for="password">Password Lama:</label>
							<input type="text" class="form-control" id="old_password" name="old_password">
							<span class="help-block ">{!! implode('', $errors->get('old_password')) !!}</span>
						</div>
						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="password">Password :</label>
							<input type="password" class="form-control" id="password" name="password">
							<span class="help-block ">{!! implode('', $errors->get('password')) !!}</span>
						</div>
						<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label for="password_confirmation">Konfirmasi Password :</label>
							<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
							<span class="help-block ">{!! implode('', $errors->get('password_confirmation')) !!}</span>
						</div>
						<div class="box-footer">
							<button class="btn btn-primary pull-right">Submit</button>
						</div>
					</form>
					<div class="box-body">
					</div>

				</div>
			</div>
		</div>
	</div>
	@endsection