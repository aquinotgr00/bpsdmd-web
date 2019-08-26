@extends('layout.main')

@section('content')

<section class="content-header">
	<h1>Ubah User</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<form method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name">name :</label>
							<input type="text" class="form-control" id="username" name="name" required="" value="{{ $user->getName() }}">
							<span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
						</div>
						<div class="form-group {{ Session::has('username') ? 'has-error' : '' }}">
							<label for="username">Username :</label>
							<input type="text" class="form-control" id="username" name="username" value="{{ $user->getUsername() }}">
							<span class="help-block ">{!! Session::get('username') !!}</span>
						</div>
						<span class="help-block">Kosongkan password dan konfirmasi password jika tidak ingin diganti</span>

						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="password">Password :</label>
							<input type="password" class="form-control" id="password" name="password" >
							<span class="help-block ">{!! implode('', $errors->get('password')) !!}</span>
						</div>
						<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label for="password_confirmation">Konfirmasi Password :</label>
							<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
							<span class="help-block ">{!! implode('', $errors->get('password_confirmation')) !!}</span>
						</div>
						@if( $user->getAuthority() <> \App\Entities\User::ROLE_ADMIN)
						<div class="form-group {{ $errors->has('org') ? 'has-error' : '' }}">
							<label for="sel1">Instansi</label>
							<select class="form-control" id="sel1" name="org" required="">
								<option value="">Pilih Instansi</option>
								@if(!empty($dataOrg))

								@foreach($dataOrg as $org)
								<option value="{{ $org->getId() }}" {!! $user->getOrg()->getId() == $org->getId() ? 'selected':'' !!}>{{ $org->getName() }}</option>
								@endforeach

								@endif

							</select>
							<span class="help-block ">{!! implode('', $errors->get('org')) !!}</span>

						</div>
						@endif

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