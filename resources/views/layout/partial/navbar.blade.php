<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li>
        <a href="{{ url(route('dashboard')) }}">
            <i class="fa fa-dashboard"></i>
            <span>{{ ucfirst(trans('common.dashboard')) }}</span>
        </a>
    </li>

    @if(checkAuthorization(\App\Entities\User::ROLE_ADMIN))
        <li class="treeview">
            <a href="#">
                <i class="fa pull-right fa-angle-left"></i> <i class="fa fa-codepen"></i> <span>{{ ucfirst(trans('common.graph_data')) }}</span>
            </a>
            <ul class="treeview-menu" style="display: block; overflow: hidden;">
                <li>
                    <a href="{{ url(route('administrator.analytics.dashboard')) }}">
                        <i class="fa fa-table"></i>
                        <span>{{ ucfirst(trans('common.graph_dash')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.analytics.students')) }}">
                        <i class="fa fa-street-view"></i>
                        <span>{{ ucfirst(trans('common.student')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.analytics.index')) }}">
                        <i class="fa fa-graduation-cap"></i>
                        <span>{{ ucfirst(trans('common.graduates')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.analytics.shortcourse')) }}">
                        <i class="fa fa-binoculars"></i>
                        <span>{{ ucfirst(trans('common.short_course')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.analytics.employee')) }}">
                        <i class="fa fa-black-tie"></i>
                        <span>{{ ucfirst(trans('common.employee')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.analytics.studyprogram')) }}">
                        <i class="fa fa-indent"></i>
                        <span>{{ ucfirst(trans('common.graph_study_program')) }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa pull-right fa-angle-left"></i> <i class="fa fa-sitemap"></i> <span>{{ ucfirst(trans('common.institute')) }}</span>
            </a>
            <ul class="treeview-menu" style="display: none; overflow: hidden;">
                <li>
                    <a href="{{ url(route('administrator.org.supply')) }}">
                        <i class="fa fa-sitemap"></i>
                        <span>{{ ucfirst(trans('common.supply')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('administrator.org.demand')) }}">
                        <i class="fa fa-sitemap"></i>
                        <span>{{ ucfirst(trans('common.demand')) }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ url(route('administrator.user.index')) }}">
                <i class="fa fa-group"></i>
                <span>{{ ucwords(trans('common.user_management')) }}</span>
            </a>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa pull-right fa-angle-left"></i> <i class="fa fa-list-alt"></i> <span>{{ ucfirst(trans('common.competency')) }}</span>
            </a>
            <ul class="treeview-menu" style="display: none; overflow: hidden;">
                <li>
                    <a href="{{ url(route('shared.competency.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyUnit.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_unit')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyMainPurpose.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_purpose')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyMainFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_function')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyKeyFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_key_function')) }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ url(route('shared.license.index')) }}">
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

        <li class="treeview">
            <a href="#">
                <i class="fa pull-right fa-angle-left"></i> <i class="fa fa-list-alt"></i> <span>Link and Match</span>
            </a>
            <ul class="treeview-menu" style="display: none; overflow: hidden;">
                <li>
                    <a href="{{ url(route('administrator.link-match.supply')) }}">
                        <i class="fa fa-file"></i>
                        <span>Supply</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url(route('administrator.link-match.demand')) }}">
                        <i class="fa fa-file"></i>
                        <span>Demand</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url(route('administrator.link-match.edit')) }}">
                        <i class="fa fa-file"></i>
                        <span>Update Data</span>
                    </a>
                </li>
            </ul>
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

        <li class="treeview">
            <a href="#">
                <i class="fa pull-right fa-angle-left"></i> <i class="fa fa-list-alt"></i> <span>{{ ucfirst(trans('common.competency')) }}</span>
            </a>
            <ul class="treeview-menu" style="display: none; overflow: hidden;">
                <li>
                    <a href="{{ url(route('shared.competency.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyUnit.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_unit')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyMainPurpose.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_purpose')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyMainFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_function')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyKeyFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_key_function')) }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ url(route('shared.license.index')) }}">
                <i class="fa fa-file"></i>
                <span>{{ ucwords(trans('common.license')) }}</span>
            </a>
        </li>

        <li>
            <a href="{{ url(route('supply.link-match')) }}">
                <i class="fa fa-file"></i>
                <span>Link and Match</span>
            </a>
        </li>
        
        <li>
            <a href="{{ url(route('supply.shortCourse.index')) }}">
                <i class="fa fa-calendar"></i>
                <span>{{ ucwords(trans('common.short_course')) }}</span>
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
            <a href="{{ url(route('demand.shortCourse.index')) }}">
                <i class="fa fa-calendar"></i>
                <span>{{ ucwords(trans('common.short_course')) }}</span>
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

        <li class="treeview">
            <a href="#">
                <i class="fa pull-right fa-angle-left"></i> <i class="fa fa-list-alt"></i> <span>{{ ucfirst(trans('common.competency')) }}</span>
            </a>
            <ul class="treeview-menu" style="display: none; overflow: hidden;">
                <li>
                    <a href="{{ url(route('shared.competency.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyUnit.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_unit')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyMainPurpose.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_purpose')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyMainFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_main_function')) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url(route('shared.competencyKeyFunction.index')) }}">
                        <i class="fa fa-list-alt"></i>
                        <span>{{ ucfirst(trans('common.competency_key_function')) }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ url(route('shared.license.index')) }}">
                <i class="fa fa-file"></i>
                <span>{{ ucwords(trans('common.license')) }}</span>
            </a>
        </li>

        <li>
            <a href="{{ url(route('demand.link-match')) }}">
                <i class="fa fa-file"></i>
                <span>Link and Match</span>
            </a>
        </li>
    @endif
</ul>
