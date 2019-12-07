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

$sankey_jurusan = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Update/SankeyGrafikUnitJurusan?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));
?>
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
                </nav>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="500px" frameborder="0" src="<?php echo $sankey_jurusan; ?>" /></iframe>
                </div>
            </div>
            <!-- <div class="box">
                <div class="box-body tab-content center-block">

                </div>
            </div> -->
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
