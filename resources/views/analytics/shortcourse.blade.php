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

$instansi_diklat_year = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Diklat?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$jenis_diklat = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Diklat_Jenis?:embed=yes&:toolbar=no&:tabs=no&:showVizHome=no', curl_exec($ch));

$peserta_diklat = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Graph_PesertaDiklat?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$peserta_diklat_per_diklat = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Grap_Peserta_Diklat_Jenisdiklat?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$scatter_plot_trg_realisasi = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Scattercharttarg_Real_diklat?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$pie_chart_dpm_per_matra = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_ePelaporan/Upt_Dpm?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$pie_chart_dpm_lulus = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_ePelaporan/DPM_PesertaDiklat_Matra2?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$bar_chart_dpm_lulus = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_ePelaporan/Chart_DPM_PesertaDiklat_UPT?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));
?>
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
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $instansi_diklat_year; ?>" /></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $jenis_diklat; ?>" /></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $pie_chart_dpm_per_matra; ?>" /></iframe>
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
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $peserta_diklat_per_diklat; ?>" /></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $peserta_diklat; ?>" /></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <iframe width="100%" height="380px" frameborder="0" src="<?php echo $scatter_plot_trg_realisasi; ?>" /></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $pie_chart_dpm_lulus; ?>" /></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $bar_chart_dpm_lulus; ?>" /></iframe>
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
