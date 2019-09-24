@extends('layout.front')

@section('content')
    <!-- Form -->
    <form name="form_login" id="form-login" method="post">
        @csrf

        <div class="signin-text">
            <span>Sign In to your account</span>

            @if(session('alert') ?? false)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('alert') }}
                </div>
            @endif
        </div> <!-- / .signin-text -->

        <div class="form-group w-icon {{ $errors->has('email') ? 'has-error' : '' }}">
            <input name="email" id="email_id" class="form-control input-lg" placeholder="Email" type="text">
            <span class="fa fa-user signin-form-icon"></span>
            <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
        </div> <!-- / Username -->

        <div class="form-group w-icon {{ $errors->has('password') ? 'has-error' : '' }}">
            <input name="password" id="password_id" class="form-control input-lg" placeholder="Password" type="password">
            <span class="fa fa-lock signin-form-icon"></span>
            <span class="help-block ">{!! implode('', $errors->get('password')) !!}</span>
        </div> <!-- / Password -->

        <div class="form-actions">
            <div style="text-align: center;">
                <input type="submit" value="Sign In" class="signin-btn bg-primary" />
            </div>
        </div> <!-- / .form-actions -->
    </form>
    <hr />
    <div style="margin-top:1em;">
        <a href="{{ route('register') }}">Daftar</a>
    </div>
    <!-- / Form -->
@endsection
