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

$pegawai_degree_pie = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Pegawai_Pendidikan_Instansi?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$pegawai_degree_bubble = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Peg_Asn_sebaranJafung?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$relasi_pegawai_usia = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/RelasiUsiapegawaidanPendidikan?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$pegawai_usia_box = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/demand_peg_Usia2?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$pegawai_usia_bubble = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/demand_peg_Usia3?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$pegawai_usia_bar = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Pegawai_Usia_Instansi?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

$mapping_pegawai_usia = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/Asn_petapegawai?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <nav class="navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <i class="fa fa-black-tie"></i>
                            {{ ucfirst(trans('common.employee_comp_deg')) }}
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $pegawai_degree_pie; ?>" /></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $pegawai_degree_bubble; ?>" /></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $relasi_pegawai_usia; ?>" /></iframe>
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
                            <i class="fa fa-black-tie"></i>
                            {{ ucfirst(trans('common.employee_age_mapping')) }}
                        </a>
                    </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav tab-graduates-graphtype">
                            <li class="active">
                                <a href="#employee_boxed">{{ ucfirst(trans('common.graph_employee_box')) }}</a>
                            </li>
                            <li>
                                <a href="#employee_bubbles">{{ ucfirst(trans('common.graph_employee_bubble')) }}</a>
                            </li>
                            <li>
                                <a href="#employee_bar">{{ ucfirst(trans('common.graph_employee_bar')) }}</a>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <div id="employee_boxed" class="tab-pane fade active in">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $pegawai_usia_box; ?>" /></iframe>
                    </div>
                    <div id="employee_bubbles" class="tab-pane fade">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $pegawai_usia_bubble; ?>" /></iframe>
                    </div>
                    <div id="employee_bar" class="tab-pane fade">
                        <iframe width="100%" height="400px" frameborder="0" src="<?php echo $pegawai_usia_bar; ?>" /></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="400px" frameborder="0" src="<?php echo $mapping_pegawai_usia; ?>" /></iframe>
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
    </script>
@endsection
