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

$dashboard = sprintf($url . '/%s/t/Daun3/views/BPSDM_DB_LARAVEL_Dashboard/SuperPrescriptive?:embed=yes&:toolbar=no&:tabs=no', curl_exec($ch));

?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body tab-content">
                    <iframe width="100%" height="900px" frameborder="0" src="<?php echo $dashboard; ?>" /></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection
