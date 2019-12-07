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
$siswa_instansi_aktif_bar = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_statusAktif?:embed=yes&:toolbar=no&:tabs=no', $ticket);

$siswa_status_pie = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/PieChart_Siswa_Status?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$sebaran_siswa = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/SebaranSiswa?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$jumlah_siswa_instansi_gender = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Suply_Siswa_instansi_gender?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <nav class="navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <i class="fa fa-black-tie"></i> {{ ucfirst(trans('common.graph_student_amount')) }}
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
                    <div id="students_amount" class="tab-pane fade active in">
                        <iframe width="100%" height="500px" frameborder="0" src="<?php echo $siswa_instansi_aktif_bar ?>" /></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <div id="" class="tab-pane fade active in">
                        <iframe width="100%" height="500px" frameborder="0" src="<?php echo $siswa_status_pie ?>" /></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <nav class="navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <i class="fa fa-black-tie"></i> Sebaran siswa berdasarkan tempat lahir
                        </a>
                    </div>
                </nav>
                <div class="box-body tab-content">
                    <div id="" class="tab-pane fade active in">
                        <iframe width="100%" height="500px" frameborder="0" src="<?php echo $sebaran_siswa ?>" /></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <div id="" class="tab-pane fade active in">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $jumlah_siswa_instansi_gender ?>" /></iframe>
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
    });
    </script>
@endsection
