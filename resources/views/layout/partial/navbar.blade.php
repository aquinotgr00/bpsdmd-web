<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li>
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

        <li class="treeview">
            <a href="#">
                <i class="fa pull-right fa-angle-left"></i> <i class="fa fa-list-alt"></i> <span>Kompetensi</span>
            </a>
            <ul class="treeview-menu" style="display: none; overflow: hidden;">
                <li>
                    <a href="{{ url(route('administrator.competency.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.competencyUnit.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_unit')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.competencyMainPurpose.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_purpose')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.competencyMainFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_function')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.competencyKeyFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_key_function')) }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ url(route('administrator.license.index')) }}">
                <i class="fa fa-file"></i>
                <span>{{ ucwords(trans('common.license')) }}</span>
            </a>
        </li>

        <li>
            <a href="{{ url(route('administrator.shortCourse.index')) }}">
                <i class="fa fa-calendar"></i>
                <span>{{ ucwords(trans('common.short_course')) }}</span>
            </a>
        </li>
    @endif

    @if(checkAuthorization(\App\Entities\User::ROLE_SUPPLY))
        <li>
            <a href="{{ route('supply.program.index') }}">
                <i class="fa fa-sliders"></i>
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
        <li>
            <a href="{{ route('demand.jobTitle.index') }}">
                <i class="fa fa-shield"></i>
                <span>{{ ucwords(trans('common.job_title')) }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('demand.jobFunction.index') }}">
                <i class="fa fa-shield"></i>
                <span>{{ ucwords(trans('common.job_function')) }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('demand.certificate.index') }}">
                <i class="fa fa-envelope"></i>
                <span>{{ ucwords(trans('common.certificate')) }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('demand.recruitment.index') }}">
                <i class="fa fa-cart-plus"></i>
                <span>{{ ucwords(trans('common.recruitment')) }}</span>
            </a>
        </li>
    @endif
</ul>
