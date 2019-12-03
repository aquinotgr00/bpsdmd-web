@extends('layout.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <nav class="navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <i class="fa fa-binoculars"></i> {{ ucfirst(trans('common.short_course_institute')) }}
                        </a>
                    </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <!--<ul class="nav navbar-nav tab-graduates-graphtype">
                            <li class="active">
                                <a href="#graduate_status_moda">{{ ucfirst(trans('common.graph_moda')) }}</a>
                            </li>
                            <li>
                                <a href="#graduate_status_jenjang">{{ ucfirst(trans('common.graph_jenjang')) }}</a>
                            </li>
                            <li>
                                <a href="#graduate_status_gender">{{ ucfirst(trans('common.graph_gender')) }}</a>
                            </li>
                        </ul> -->
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <script type='text/javascript' src='https://tableau.bpsdm.dephub.go.id/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 960px; height: 520px;'><object class='tableauViz' width='960' height='520' style='display:none;'><param name='host_url' value='https%3A%2F%2Ftableau.bpsdm.dephub.go.id%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;Daun3' /><param name='name' value='BPSDM_DB_Laravel&#47;Suply_Diklat' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <nav class="navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <i class="fa fa-user"></i> {{ ucfirst(trans('common.short_course_participant')) }}
                        </a>
                    </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <!--<ul class="nav navbar-nav tab-graduates-graphtype">
                            <li class="active">
                                <a href="#graduate_status_moda">{{ ucfirst(trans('common.graph_moda')) }}</a>
                            </li>
                            <li>
                                <a href="#graduate_status_jenjang">{{ ucfirst(trans('common.graph_jenjang')) }}</a>
                            </li>
                            <li>
                                <a href="#graduate_status_gender">{{ ucfirst(trans('common.graph_gender')) }}</a>
                            </li>
                        </ul> -->
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <script type='text/javascript' src='https://tableau.bpsdm.dephub.go.id/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 960px; height: 520px;'><object class='tableauViz' width='960' height='520' style='display:none;'><param name='host_url' value='https%3A%2F%2Ftableau.bpsdm.dephub.go.id%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;Daun3' /><param name='name' value='BPSDM_DB_Laravel&#47;Suply_Diklat2' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
    $( document ).ready(function() {
    });
    </script>
@endsection
