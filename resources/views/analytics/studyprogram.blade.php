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
                            <i class="fa fa-indent"></i>
                            {{ ucfirst(trans('common.graph_study_program_mapping')) }}
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
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">STPI Curug <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">APKA Madiun</a></li>
                                        <li><a href="#">ATKP Makassar</a></li>
                                    </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <script type='text/javascript' src='https://tableau.bpsdm.dephub.go.id/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 960px; height: 1227px;'><object class='tableauViz' width='960' height='1227' style='display:none;'><param name='host_url' value='https%3A%2F%2Ftableau.bpsdm.dephub.go.id%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;Daun3' /><param name='name' value='SankeyGrafikBpsdm_laravel&#47;SankeyGrafikUnitJurusan' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
                </div>
            </div>
            <div class="box">
                <div class="box-body tab-content center-block">
                    <script type='text/javascript' src='https://tableau.bpsdm.dephub.go.id/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 800px; height: 577px;'><object class='tableauViz' width='800' height='577' style='display:none;'><param name='host_url' value='https%3A%2F%2Ftableau.bpsdm.dephub.go.id%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;Daun3' /><param name='name' value='SankeyMinimalJob_titlerelasi&#47;SankeyUnitdanJobTitle' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
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
