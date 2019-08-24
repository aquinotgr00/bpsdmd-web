<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li class="{CLASS_ACTIVE_DB}">
        <a href="{URL_MENU_DASHBOARD}">
            <i class="fa fa-dashboard"></i>
            <span>{NAME_MENU_DASHBOARD}</span>
        </a>
    </li>
    <li class="{CLASS_ACTIVE_LK}" style="display:none;">
        <a href="{URL_MENU_LAKIP}">
            <i class="fa fa-bar-chart"></i>
            <span>{NAME_MENU_LAKIP}</span>
        </a>
    </li>
    <li class="{CLASS_ACTIVE_SC}">
        <a href="{URL_MENU_SEARCH}">
            <i class="fa fa-search"></i>
            <span>{NAME_MENU_SEARCH}</span>
        </a>
    </li>
    @if(Session::has('logged') && Session::get('logged')['authority'] == \App\Entities\User::ROLE_SUPPLY)
    <li class="{CLASS_ACTIVE_SC}">
        <a href="{{ route('feeder.upload') }}">
            <i class="fa fa-file"></i>
            <span>Feeder</span>
        </a>
    </li>
    @endif
</ul>
