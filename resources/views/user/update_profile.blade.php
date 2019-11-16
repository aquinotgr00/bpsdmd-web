@extends('layout.main')

@section('content')

<section class="content-header">
	<h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.profile')) }}</h1>
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
							<label for="name">{{ ucfirst(trans('common.name')) }} :</label>
							<input type="text" class="form-control" id="username" name="name" value="{{ $user->getName() }}">
							<span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
						</div>

						<div class="form-group {{  $errors->has('email') ? 'has-error' : '' }}">
							<label for="email">{{ ucfirst(trans('common.email')) }} :</label>
							<input type="text" class="form-control" id="email" name="email" value="{{ $user->getEmail() }}">
							<span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
						</div>

                        <div class="form-group {{ $errors->has('language') ? 'has-error' : '' }}">
                            <label for="language">{{ ucfirst(trans('common.language')) }}</label>
                            <select class="form-control" id="language" name="language">
                                <option value="{{ \App\Entities\User::LOCALE_ID }}" {{ $user->getLocale() == \App\Entities\User::LOCALE_ID ? 'selected' : '' }}>{{ ucfirst(trans('common.locale_id')) }}</option>
                                <option value="{{ \App\Entities\User::LOCALE_EN }}" {{ $user->getLocale() == \App\Entities\User::LOCALE_EN ? 'selected' : '' }}>{{ ucfirst(trans('common.locale_en')) }}</option>
                            </select>
                            <span class="help-block ">{!! implode('', $errors->get('language')) !!}</span>
                        </div>

						<div class="input-group {{ $errors->has('photo') ? 'has-error' : '' }}">
							<img src="">
							<div class="input-group-prepend">
								<label class="custom-file-label" for="inputGroupFile01">{{ ucfirst(trans('common.photo')) }}</label>
								<span class="help-block">{{ trans('common.allowed_photo') }}</span>
								<span class="help-block">{{ __('common.max_photo', ['max' => '500KB']) }}</span>

							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="inputGroupFile01"
								aria-describedby="inputGroupFileAddon01" name="photo">
								<span class="help-block ">{!! implode('', $errors->get('photo')) !!}</span>
							</div>
						</div>
                        <div class="form-group">
                            <img src="{{ $user->getPhoto() ? url($user->getPhoto()) : url('img/avatar.png') }}" width="100px" height="100px">
                        </div>

						<span class="help-block" style="color:red">{{ trans('common.password_leave_blank') }}</span>
						<div class="form-group {{  $errors->has('old_password') ? 'has-error' : '' }}">
							<label for="password">{{ ucwords(trans('common.old_password')) }} :</label>
							<input type="password" class="form-control" id="old_password" name="old_password">
							<span class="help-block ">{!! implode('', $errors->get('old_password')) !!}</span>
						</div>

						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="password">{{ ucfirst(trans('common.password')) }} :</label>
							<input type="password" class="form-control" id="password" name="password">
							<span class="help-block ">{!! implode('', $errors->get('password')) !!}</span>
						</div>

						<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label for="password_confirmation">{{ ucwords(trans('common.confirm_password')) }} :</label>
							<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
							<span class="help-block ">{!! implode('', $errors->get('password_confirmation')) !!}</span>
						</div>

						<div class="box-footer" style="text-align: right;min-height: 50px;">
							<button class="btn btn-primary pull-right">{{ ucfirst(trans('common.edit')) }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
