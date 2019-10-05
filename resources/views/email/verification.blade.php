<h1>@lang('common.email_verification_warning')</h1>
<br />
<h3>@lang('common.email_verification_info')</h3>
<h4>{{ucfirst(trans('common.email'))}}: Pakai email ini</h4>
<h4>{{ucfirst(trans('common.password'))}}: {{ $password }}</h4>
<br />
<h3>@lang('common.email_verification_link', ['url' => $url])</h3>