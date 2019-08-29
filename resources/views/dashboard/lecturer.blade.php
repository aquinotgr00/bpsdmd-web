@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-disable">
                    <div class="inner">
                        <p> Jumlah Sekolah </p>
                        <h3> 0 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-area-chart"></i>
                    </div>
                    <a class="small-box-footer" href="{{url(route('data.school'))}}" title="Info Lebih Lanjut">
                        Info Lebih Lanjut
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <p> Total Dosen </p>
                        <h3> 0 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a class="small-box-footer" href="{{url(route('dashboard'))}}" title="Back">
                        <i class="fa fa-arrow-circle-left"></i>
                        Dashboard
                    </a>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6" style="display:none;">
                <div class="small-box bg-disable">
                    <div class="inner">
                        <p> Total Taruna </p>
                        <h3> 3.814 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <a class="small-box-footer" href="{{url(route('data.cadet'))}}" title="Info Lebih Lanjut">
                        Info Lebih Lanjut
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6" style="display:none;">
                <div class="small-box bg-disable">
                    <div class="inner">
                        <p> Total Alumni </p>
                        <h3> 408 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                    <a class="small-box-footer" href="#" title="Info Lebih Lanjut">
                        Info Lebih Lanjut
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-disable">
                    <div class="inner">
                        <p> Jumlah Taruna</p>
                        <div class="gsSeparatorIdle"></div>
                        <h3> 0 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                    <a class="small-box-footer" href="{{url(route('data.cadet'))}}" title="Info Lebih Lanjut">
                        Info Lebih Lanjut
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-disable">
                    <div class="inner">
                        <p> Jumlah Peserta Short Course </p>
                        <h3> 0 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <a class="small-box-footer" href="{{url(route('data.course'))}}" title="Info Lebih Lanjut">
                        Info Lebih Lanjut
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row" style="display:">
            <section class="col-lg-12 connectedSortable">
                <!-- Box (with bar chart) -->
                <div class="box box-primary" id="loading-example">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div><!-- /. tools -->
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Grafik Dosen</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-sm-12">

                                <!-- FormHelper Content BEGIN -->

                                <script type="text/javascript">
                                    $(function () {
                                        // Create the chart
                                        $('#gsContainerDosenALl').highcharts({
                                            // DATA BASIC
                                            "chart":{"type":"column","marginBottom":125,"options3d":{"enabled":false,"alpha":0,"beta":0,"depth":50}},
                                            "title":{"text":"GRAFIK DOSEN KESELURUHAN"},
                                            "subtitle":{"text":""},
                                            "xAxis":{"type":"category"},
                                            "yAxis":{"title":{"text":"Jumlah"}},
                                            "legend":{"enabled":false},
                                            "plotOptions":{series:{borderWidth:0,colorByPoint:true,dataLabels:{enabled:true}},column:{depth:50}},

                                            // DATA
                                            series:
                                                [
                                                    {
                                                        name: 'Jumlah Dosen',
                                                        "data": []
                                                    }
                                                ]
                                        })
                                    });
                                </script>

                                <!-- FormHelper Content END-->

                                <script>if(window.ButtonAccess){ var ba = new ButtonAccess(""); ba.removeButton();}
                                </script>
                                <div id="gsContainerDosenALl" style="height: 300px; margin: 0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="row" style="display:">
            <div class="col-xs-12">
                <div class="box box-primary" id="loading-example">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div><!-- /. tools -->
                        <i class="fa fa-table"></i>
                        <h3 class="box-title">List Dosen Keseluruhan</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="listDosen" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Sekolah</th>
                                <th>Jumlah Dosen</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2" style="text-align:right;">Total Keseluruhan :</th>
                                <th style="text-align:right;">0</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                    <script type="text/javascript">
                        $(function() {
                            $("#listDosen").dataTable();
                        });
                    </script>
                </div>
            </div>
        </div>

        <!-- separator -->

        <div class="row" style="display:none">
            <div class="col-xs-12">
                <div class="box box-primary" id="loading-example">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button onclick="window.location.href = 'url(route('data.lecturer'))'" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Back">
                                <i class="fa fa-arrow-circle-left"></i> Back
                            </button>
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" title="Remove" data-toggle="tooltip" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div><!-- /. tools -->
                        <i class="fa fa-table"></i>
                        <h3 class="box-title">
                            List Dosen <span class="keywordDetail"></span>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="listDosenFak" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>NAMA</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>NAMA</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                    <script type="text/javascript">
                        $(function() {
                            $("#listDosenFak").dataTable();
                        });
                    </script>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection
