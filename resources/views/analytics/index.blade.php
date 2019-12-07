@extends('layout.main')

@section('content')
<?php
$url    = 'https://tableau.bpsdm.dephub.go.id/trusted'; // alamat server tableau
$myvars = 'username=bpsdm1&target_site=Daun3&client_ip=10.10.8.100'; // username trusted tableau

//$view   = $_GET['view']; // Path/nama view tableau

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
));

$ticket  = curl_exec($ch);
$lulusan_tahun_tabel = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_ThnKeluar?:embed=yes&:toolbar=no&:tabs=no', $ticket);

$lulusan_tahun_bar = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_ThnKeluar2?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$lulusan_ipk = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_Sebaran_IPK?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$prediksi_lulusan_line = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_Forecast?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$prediksi_lulusan_bar = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_Forecast2?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$lulus_instansi_moda = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Chart_Lulus_Siswa_instansi_Prodi_moda?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$lulus_instansi_gender = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_gender2?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$lulus_instansi_strata = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_Prodi_strata?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$lulus_berlisensi = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_Licensi_TahunKeluar3?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                @include('analytics.navlulusan')
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <div id="graduates_graph_bar_view" class="tab-pane fade active in">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $lulusan_tahun_bar; ?>" /></iframe>
                    </div>
                    <div id="graduates_graph_table_view" class="tab-pane fade">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $lulusan_tahun_tabel; ?>" /></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="330px" frameborder="0" src="<?php echo $lulusan_ipk; ?>" /></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- status kelulusan -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <nav class="navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <i class="fa fa-paper-plane"></i> {{ ucfirst(trans('common.grad_status')) }}
                        </a>
                    </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav tab-graduates-graphtype">
                            <li class="active">
                                <a href="#graduate_status_moda">{{ ucfirst(trans('common.graph_moda')) }}</a>
                            </li>
                            <li>
                                <a href="#graduate_status_jenjang">{{ ucfirst(trans('common.graph_jenjang')) }}</a>
                            </li>
                            <li>
                                <a href="#graduate_status_gender">{{ ucfirst(trans('common.graph_gender')) }}</a>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <div id="graduate_status_moda" class="tab-pane fade active in">
                        <iframe width="100%" height="300px" frameborder="0" src="<?php echo $lulus_instansi_moda; ?>" /></iframe>
                    </div>
                    <div id="graduate_status_jenjang" class="tab-pane fade">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $lulus_instansi_strata; ?>" /></iframe>
                    </div>
                    <div id="graduate_status_gender" class="tab-pane fade">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $lulus_instansi_gender; ?>" /></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- lulusan berlisensi -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="500px" frameborder="0" src="<?php echo $lulus_berlisensi; ?>" /></iframe>
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
                            <i class="fa fa-empire"></i> {{ ucfirst(trans('common.grad_prediction')) }}
                        </a>
                    </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav tab-graduates-graphtype">
                            <li class="active">
                                <a href="#graduate_pred_graph_line_view">{{ ucfirst(trans('common.graph_line_view')) }}</a>
                            </li>
                            <li>
                                <a href="#graduate_pred_graph_bar_view">{{ ucfirst(trans('common.graph_bar_view')) }}</a>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <div id="graduate_pred_graph_line_view" class="tab-pane fade active in">
                        <iframe width="100%" height="250px" frameborder="0" src="<?php echo $prediksi_lulusan_line; ?>" /></iframe>
                    </div>
                    <div id="graduate_pred_graph_bar_view" class="tab-pane fade">
                        <iframe width="100%" height="250px" frameborder="0" src="<?php echo $prediksi_lulusan_bar; ?>" /></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
    $( document ).ready(function() {
        $('.tab-graduates-graphtype a').click(function (e) {
          e.preventDefault();
          $(this).tab('show')
        })
    });

    $(window).load(function() {

    });
    </script>
@endsection
