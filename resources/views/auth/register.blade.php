@extends('layout.front')

@section('content')
    <!-- Form -->
    <form name="form_register" id="form-register" method="POST" enctype="multipart/form-data">@csrf
        <div class="signin-text">
            <span>Daftar</span>

            @if(session('alert') ?? false)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('alert') }}
                </div>
            @endif
        </div> <!-- / .signin-text -->

        <div class="form-group required required-asterisk {{ $errors->has('org_type') ? 'has-error' : '' }}">
            <label>Jenis Organisasi</label>
            <select name="org" id="org" class="form-control">
              <option value="null"></option>
              @foreach($orgs as $org)
                <option value="{{$org->getId()}}">{{$org->getName()}}</option>
              @endforeach
            </select>
            <span class="help-block">Jenis perusahaan Anda.</span>
            <span class="help-block ">{!! implode('', $errors->get('org_type')) !!}</span>
        </div> <!-- / Org -->

        <div class="form-group required required-asterisk {{ $errors->has('org_address') ? 'has-error' : '' }}">
            <label>Alamat Lengkap Organisasi</label>
            <textarea name="org_address" id="org_address" cols="30" rows="2" class="form-control"></textarea>
            <span class="help-block">Alamat lengkap perusahaan Anda.</span>
            <span class="help-block ">{!! implode('', $errors->get('org_address')) !!}</span>
        </div> <!-- / Org -->

        <hr />

        <div class="form-group required required-asterisk {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Nama</label>
            <input name="name" id="name_id" class="form-control" type="text">
            <span class="help-block">Nama lengkap Anda.</span>
            <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
        </div> <!-- / Name -->

        <div class="form-group required required-asterisk {{ $errors->has('email') ? 'has-error' : '' }}">
            <label>Email</label>
            <input name="email" id="email_id" class="form-control" type="text">
            <span class="help-block">Email Anda. Harap menggunakan email resmi penanggung jawab ber-akhir-an @pelni.com atau @kai.com</span>
            <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
        </div> <!-- / Email -->

        <div class="form-group required required-asterisk {{ $errors->has('image_file') ? 'has-error' : '' }}">
            <label>Foto</label>
            <input name="image_file" type="file">
            <span class="help-block">Foto Anda.</span>
            <span class="help-block ">{!! implode('', $errors->get('image_file')) !!}</span>
        </div> <!-- / photo -->
        
        {!! NoCaptcha::display() !!}

        @if ($errors->has('g-recaptcha-response'))
          <span class="help-block">
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
          </span>
        @endif

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
    <hr />
    <div style="margin-top: 1em;">
        <a href="{{ route('login') }}">Login</a>
    </div>
    <!-- / Form -->
@endsection
