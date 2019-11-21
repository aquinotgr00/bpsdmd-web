@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <p> Jumlah Sekolah </p>
                        <h3> {{ $countSchools }} </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-area-chart"></i>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <p> Total Dosen </p>
                        <h3> {{ $countTeachers }} </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <p> Jumlah Taruna</p>
                        <div class="gsSeparatorIdle"></div>
                        <h3> {{ $countStudents }} </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <p> Jumlah Diklat </p>
                        <h3> {{ $countShortCourses }} </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box box-danger" id="loading-example">
                    <div class="box-header">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Grafik Jumlah Taruna</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="gsContainerTarunaNonDiklatALl" style="height: 300px; margin: 0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </section><!-- /.content -->
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            // Create the chart
            $('#gsContainerTarunaNonDiklatALl').highcharts({
                // DATA BASIC
                "chart":{"type":"column","marginBottom":100,"options3d":{"enabled":"true","alpha":0,"beta":0,"depth":50}},
                "title":{"text":"GRAFIK TARUNA"},
                "subtitle":{"text":""},
                "xAxis":{"type":"category"},
                "yAxis":{"title":{"text":"Jumlah"}},
                "legend":{"enabled":false},
                "plotOptions":{series:{borderWidth:0,colorByPoint:true,dataLabels:{enabled:true}},column:{depth:50}},

                // DATA
                series:
                    [
                        {
                            name: 'Jumlah Taruna',
                            "data": {!! $dataGraphTrend !!}
                        }
                    ]
            })
        });
    </script>
@endsection
