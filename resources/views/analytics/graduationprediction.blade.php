@extends('layout.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                @include('analytics.navlulusan')
            </div>
        </div>
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <script type='text/javascript' src='https://daun.unpad.ac.id/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 1280px; height: 520px;'><object class='tableauViz' width='960' height='520' style='display:none;'><param name='host_url' value='https%3A%2F%2Fdaun.unpad.ac.id%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='&#47;t&#47;Daun3' /><param name='name' value='BPSDM_DB_Laravel&#47;Suply_Siswa_instansi_ThnKeluar2' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
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

    $(window).load(function() {

    });
    </script>
@endsection
