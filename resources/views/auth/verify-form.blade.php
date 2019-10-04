@extends('layout.front')

@section('content')
    <!-- Form -->
    <form name="form_verify" id="form-verify" method="post">
        @csrf

        <div class="signin-text">
            <span>@lang('common.email_verification_header')</span>

            @if(session('alert'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('alert') }}
                </div>
            @endif
        </div> <!-- / .signin-text -->

        <div class="form-group w-icon {{ $errors->has('old_password') ? 'has-error' : '' }}">
            <input name="old_password" id="old_password_id" class="form-control input-lg" placeholder="Default Password" type="password">
            <span class="fa fa-lock signin-form-icon"></span>
            <span class="help-block ">{!! implode('', $errors->get('old_password')) !!}</span>
        </div> <!-- / default password -->
        
        <div class="form-group w-icon {{ $errors->has('password') ? 'has-error' : '' }}">
            <input name="password" id="password_id" class="form-control input-lg" placeholder="New Password" type="password">
            <span class="fa fa-lock signin-form-icon"></span>
            <span class="help-block ">{!! implode('', $errors->get('password')) !!}</span>
        </div> <!-- / default password -->

        <div class="form-group w-icon {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <input name="password_confirmation" id="password_confirmation_id" class="form-control input-lg" placeholder="Konfirmasi Password" type="password">
            <span class="fa fa-user signin-form-icon"></span>
            <span class="help-block ">{!! implode('', $errors->get('password_confirmation')) !!}</span>
        </div> <!-- / password_confirmation -->

        <div class="form-actions">
            <div style="text-align: center;">
                <input type="submit" value="Verify" class="signin-btn bg-primary" />
            </div>
        </div> <!-- / .form-actions -->
    </form>
    <!-- / Form -->
@endsection