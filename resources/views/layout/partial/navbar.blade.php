<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li >
        <a href="{{ url(route('dashboard')) }}">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if(check_authorization(\App\Entities\User::ROLE_ADMIN))
    <li>
        <a href="{{ url(route('org.index')) }}">
            <i class="fa fa-building"></i>
            <span>Instansi</span>
        </a>
    </li>
    <li>
        <a href="{{ url(route('user.index')) }}">
            <i class="fa fa-group"></i>
            <span>User Management</span>
        </a>
    </li>
    @endif

    @if(check_authorization(\App\Entities\User::ROLE_SUPPLY))
    <li>
        <a href="{{ route('feeder.upload') }}">
            <i class="fa fa-file"></i>
            <span>Feeder</span>
        </a>
    </li>
    @endif
</ul>
