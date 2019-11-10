<div class="row">
    <div class="col-md-12">
        <div class="box">
            <nav class="navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                        <i class="fa fa-credit-card"></i> {{ ucfirst(trans('common.licensed_grad')) }}
                    </a>
                </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav tab-graduates-graphtype">
                        <li class="active">
                            <a href="#licensed_graduates_per_year">{{ ucfirst(trans('common.licensed_grad_per_year')) }}</a>
                        </li>
                        <li>
                            <a href="#licensed_graduates_moda">{{ ucfirst(trans('common.licensed_grad_moda')) }}</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-body tab-content">
                <div id="licensed_graduates_per_year" class="tab-pane fade active in">
                    <script type='text/javascript' src='https://daun.unpad.ac.id/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 1280px; height: 520px;'><object class='tableauViz' width='960' height='520' style='display:none;'><param name='host_url' value='https%3A%2F%2Fdaun.unpad.ac.id%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;Daun3' /><param name='name' value='BPSDM_DB_Laravel&#47;Suply_Siswa_Licensi_TahunKeluar' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
                </div>
                <div id="licensed_graduates_moda" class="tab-pane fade">
                    <script type='text/javascript' src='https://daun.unpad.ac.id/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 1280px; height: 520px;'><object class='tableauViz' width='960' height='520' style='display:none;'><param name='host_url' value='https%3A%2F%2Fdaun.unpad.ac.id%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;Daun3' /><param name='name' value='BPSDM_DB_Laravel&#47;Suply_Siswa_instansi_Prodi_moda_Licsensi' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
                </div>
            </div>
        </div>
    </div>
</div>
