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
        <a href="{{ url(route('administrator.org.index')) }}">
            <i class="fa fa-sitemap"></i>
            <span>{{ ucfirst(trans('common.institute')) }}</span>
        </a>
    </li>

    <li>
        <a href="{{ url(route('administrator.user.index')) }}">
            <i class="fa fa-group"></i>
            <span>{{ ucwords(trans('common.user_management')) }}</span>
        </a>
    </li>

    <li>
        <a href="{{ url(route('administrator.license.index')) }}">
            <i class="fa fa-file"></i>
            <span>{{ ucwords(trans('common.license')) }}</span>
        </a>
    </li>
    @endif

    @if(checkAuthorization(\App\Entities\User::ROLE_SUPPLY))
        <li>
            <a href="{{ route('supply.program.index') }}">
                <i class="fa fa-child"></i>
                <span>{{ ucwords(trans('common.study_program')) }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('supply.student.index') }}">
                <i class="fa fa-child"></i>
                <span>{{ ucwords(trans('common.student')) }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('supply.teacher.index') }}">
                <i class="fa fa-user"></i>
                <span>{{ ucwords(trans('common.teacher')) }}</span>
            </a>
        </li>
    @endif

    @if(checkAuthorization(\App\Entities\User::ROLE_DEMAND))
        <li>
            <a href="{{ route('demand.employee.index') }}">
                <i class="fa fa-user"></i>
                <span>{{ ucwords(trans('common.employee')) }}</span>
            </a>
        </li>
    @endif
</ul>
