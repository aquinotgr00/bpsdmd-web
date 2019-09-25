@extends('layout.main')

@section('content')

<section class="content-header">
	<h1>Tambah User</h1>
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
							<label for="name">Name :</label>
							<input type="text" class="form-control" id="username" name="name">
							<span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
						</div>

						<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email">Email :</label>
							<input type="text" class="form-control" id="email" name="email">
							<span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
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

						@if( $type <> \App\Entities\User::ROLE_ADMIN)
						<div class="form-group {{ $errors->has('org') ? 'has-error' : '' }}">
							<label for="org">Instansi</label>
							<select class="form-control" id="org" name="org">
								<option value="">Pilih Instansi</option>
								@if(!empty($dataOrg))
                                    @foreach($dataOrg as $org)
                                    <option value="{{ $org->getId() }}">{{ $org->getName() }}</option>
                                    @endforeach
								@endif
							</select>
							<span class="help-block ">{!! implode('', $errors->get('org')) !!}</span>
						</div>
						@endif

						<div class="input-group {{ $errors->has('photo') ? 'has-error' : '' }}">
							<div class="input-group-prepend">
								<label class="custom-file-label" for="inputGroupFile01">Foto</label>
								<span class="help-block">File yang boleh diupload berformat : jpg, png, bmp</span>
								<span class="help-block">Ukuran maksimal file 500KB</span>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="photo">
								<span class="help-block ">{!! implode('', $errors->get('photo')) !!}</span>
							</div>
						</div>

						<div class="box-footer">
							<button class="btn btn-primary pull-right">Tambah</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
