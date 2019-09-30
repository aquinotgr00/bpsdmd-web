<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li >
        <a href="{{ url(route('dashboard')) }}">
            <i class="fa fa-dashboard"></i>
            <span>{{ ucfirst(trans('common.dashboard')) }}</span>
        </a>
    </li>

    @if(checkAuthorization(\App\Entities\User::ROLE_ADMIN))
    <li>
        <a href="{{ url(route('org.index')) }}">
            <i class="fa fa-sitemap"></i>
            <span>{{ ucfirst(trans('common.institute')) }}</span>
        </a>
    </li>

    <li>
        <a href="{{ url(route('user.index')) }}">
            <i class="fa fa-group"></i>
            <span>{{ ucwords(trans('common.user_management')) }}</span>
        </a>
    </li>

{{--    <li>--}}
{{--        <a href="{{ url(route('linknmatch.admin.index',[ 'type'=> \App\Entities\User::ROLE_ADMIN ])) }}">--}}
{{--            <i class="fa fa-link"></i>--}}
{{--            <span>Link And Match</span>--}}
{{--        </a>--}}
{{--    </li>--}}
    @endif

    @if(checkAuthorization(\App\Entities\User::ROLE_SUPPLY))
{{--    <li>--}}
{{--        <a href="{{ route('feeder.upload',['year'=>date('Y')]) }}">--}}
{{--            <i class="fa fa-file"></i>--}}
{{--            <span>Feeder</span>--}}
{{--        </a>--}}
{{--    </li>--}}
    @endif
</ul>
