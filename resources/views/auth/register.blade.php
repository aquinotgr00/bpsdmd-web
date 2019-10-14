@extends('layout.front')

@section('content')
    <!-- Form -->
    <form name="form_register" id="form-register" method="POST" enctype="multipart/form-data">@csrf
        <div class="signin-text">
            <span>{{trans('common.register_button')}}</span>

            @if(session('alert') ?? false)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('alert') }}
                </div>
            @endif
        </div> <!-- / .signin-text -->

        <div class="form-group required required-asterisk {{ $errors->has('org_type') ? 'has-error' : '' }}">
            <label>{{ trans('common.form.org') }}</label>
            <select name="org" id="org" class="form-control">
              <option value="null"></option>
              @foreach($orgs as $org)
                <option value="{{$org->getId()}}">{{$org->getName()}}</option>
              @endforeach
            </select>
            <span class="help-block">{{ trans('common.help_block.org') }}</span>
            <span class="help-block ">{!! implode('', $errors->get('org')) !!}</span>
        </div> <!-- / Org -->

        <div class="form-group required required-asterisk {{ $errors->has('org_address') ? 'has-error' : '' }}">
            <label>{{ trans('common.form.org_address') }}</label>
            <textarea name="org_address" id="org_address" cols="30" rows="2" class="form-control"></textarea>
            <span class="help-block">{{ trans('common.help_block.org_address') }}</span>
            <span class="help-block ">{!! implode('', $errors->get('org_address')) !!}</span>
        </div> <!-- / Org -->

        <hr />

        <div class="form-group required required-asterisk {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>{{ ucfirst(trans('common.name')) }}</label>
            <input name="name" id="name_id" class="form-control" type="text">
            <span class="help-block">{{ trans('common.help_block.name') }}</span>
            <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
        </div> <!-- / Name -->

        <div class="form-group required required-asterisk {{ $errors->has('email') ? 'has-error' : '' }}">
            <label>{{ ucfirst(trans('common.email')) }}</label>
            <input name="email" id="email_id" class="form-control" type="text">
            <span class="help-block">{{ trans('common.help_block.email') }}</span>
            <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
        </div> <!-- / Email -->

        <div class="form-group required required-asterisk {{ $errors->has('image_file') ? 'has-error' : '' }}">
            <label>{{ ucfirst(trans('common.photo')) }}</label>
            <input name="image_file" type="file">
            <span class="help-block">{{ trans('common.help_block.photo') }}</span>
            <span class="help-block ">{!! implode('', $errors->get('image_file')) !!}</span>
        </div> <!-- / photo -->
        <br />

        {!! NoCaptcha::display() !!}
        <br />

        @if ($errors->has('g-recaptcha-response'))
        <span class="help-block">
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
        </span>
        @endif

        <div class="form-group required required-asterisk">
            <div class="checkbox">
                <label for="supAgreement">
                    <input type="checkbox" name="agreement" id="supAgreement" required>
                    {{ trans('common.help_block.toc') }}
                </label>
            </div>
        </div>

        <div class="form-group alert alert-info small text-justify">
            {{ trans('common.help_block.email_activation') }}
        </div>

        <div class="form-actions text-center">
            <div>
                <input type="submit" value="{{trans('common.register_button')}}" class="signin-btn bg-primary" />
            </div>
        </div> <!-- / .form-actions -->
    </form>
    <hr />
    <div style="margin-top: 1em;">
        <a href="{{ route('login') }}">{{trans('common.login_button')}}</a>
    </div>
    <!-- / Form -->
@endsection

@section('script')
    <script src="{{ asset('js/refreshbg.js') }}"></script>
@endsection
