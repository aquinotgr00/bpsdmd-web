@extends('layout.front')

@section('content')
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
@endsection