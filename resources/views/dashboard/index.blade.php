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
                    <a class="small-box-footer" href="{{url(route('data.lecturer'))}}" title="Info Lebih Lanjut">
                        Info Lebih Lanjut
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!--  -->
            <div class="col-lg-6 col-xs-6" style="display:none;">
                <div class="small-box bg-green">
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
                <div class="small-box bg-yellow">
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
                <div class="small-box bg-green">
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
                <div class="small-box bg-yellow">
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

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">

                <div id="charttrendsekolah">
                    <!-- FormHelper Content BEGIN -->
                    <!-- Box (with bar chart) -->
                    <div class="box box-primary" id="loading-example">
                        <div class="box-header" style="cursor: move;">
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="remove" data-original-title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div><!-- /. tools -->
                            <i class="fa fa-bar-chart-o"></i>
                            <h3 class="box-title">Grafik Trend</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <form action="" method="post">
                                    <div class="col-sm-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Pilihan Tahun Awal</label>

                                                <!-- FormHelper Content BEGIN -->


                                                <select name="tahunMasukAwal" id="tahunMasukAwal" class="form-control">

                                                    <option value="">-- PILIH --</option>

                                                    <option value="2019">2019</option>

                                                    <option value="2018">2018</option>

                                                    <option value="2017">2017</option>

                                                    <option value="2016">2016</option>

                                                    <option value="2015">2015</option>

                                                    <option value="2014">2014</option>

                                                    <option value="2013" selected="">2013</option>

                                                    <option value="2012">2012</option>

                                                    <option value="2011">2011</option>

                                                    <option value="2010">2010</option>

                                                    <option value="2009">2009</option>

                                                </select>


                                                <!-- FormHelper Content END-->

                                                <script>if(window.ButtonAccess){ var ba = new ButtonAccess(""); ba.removeButton();}
                                                </script>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Pilihan Tahun Akhir</label>

                                                <!-- FormHelper Content BEGIN -->


                                                <select name="tahunMasukAkhir" id="tahunMasukAkhir" class="form-control">

                                                    <option value="">-- PILIH --</option>

                                                    <option value="2019" selected="">2019</option>

                                                    <option value="2018">2018</option>

                                                    <option value="2017">2017</option>

                                                    <option value="2016">2016</option>

                                                    <option value="2015">2015</option>

                                                    <option value="2014">2014</option>

                                                    <option value="2013">2013</option>

                                                    <option value="2012">2012</option>

                                                    <option value="2011">2011</option>

                                                    <option value="2010">2010</option>

                                                    <option value="2009">2009</option>

                                                </select>


                                                <!-- FormHelper Content END-->

                                                <script>if(window.ButtonAccess){ var ba = new ButtonAccess(""); ba.removeButton();}
                                                </script>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                </form>
                                <div class="col-sm-12">
                                    <div id="gsContainerTrendSekolah" style="height: 300px; margin: 0" data-highcharts-chart="0"><div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 1190px; height: 300px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="1190" height="300"><desc>Created with Highcharts 4.1.5</desc><defs><clipPath id="highcharts-1"><rect x="0" y="0" width="1190" height="400"></rect></clipPath></defs><rect x="0" y="0" width="1190" height="300" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g zIndex="-3" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 56.46195234435049 197.9619523443505 L 1157.5380476556495 197.9619523443505 L 1157.5380476556495 49.998847040737886 L 56.46195234435049 49.998847040737886 Z" zIndex="51" stroke-linejoin="round"></path></g><g zIndex="-2" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 33 201 L 34 201 L 34 47 L 33 47 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 34 47 L 34 201 L 56.46195234435049 197.9619523443505 L 56.46195234435049 49.998847040737886 Z" zIndex="25.5" stroke-linejoin="round"></path></g><g zIndex="-1" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 34 201 L 1180 201 L 1180 200 L 34 200 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 1180 200 L 1157.9615384615386 197.05769230769232 L 56.03846153846155 197.05769230769232 L 34 200 Z" zIndex="25" stroke-linejoin="round"></path></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 34 200.5 L 1180 200.5" stroke="#C0D0E0" stroke-width="1" zIndex="7" visibility="hidden"></path></g><g class="highcharts-axis" zIndex="2"><text x="24" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 24 123.5)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" visibility="visible" y="123.5">Jumlah</text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series" visibility="visible" zIndex="0.1" transform="translate(34,47) scale(1 1)" clip-path="url(#highcharts-1)"><path fill="none" d="M 0 0" stroke-linejoin="round" visibility="visible" stroke="rgba(192,192,192,0.0001)" stroke-width="22" zIndex="2" class=" highcharts-tracker" style=""></path></g><g class="highcharts-markers highcharts-tracker" visibility="visible" zIndex="0.1" transform="translate(34,47) scale(1 1)" clip-path="url(#highcharts-2)" style=""></g></g><text x="595" text-anchor="middle" class="highcharts-title" zIndex="4" style="color:#333333;font-size:18px;fill:#333333;width:1126px;" y="24"><tspan>GRAFIK TREND JUMLAH TARUNA</tspan></text><g class="highcharts-data-labels" visibility="visible" zIndex="6" transform="translate(34,47) scale(1 1)" opacity="1"></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;white-space:nowrap;" transform="translate(0,-9999)"><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path><path fill="rgba(249, 249, 249, .85)" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" transform="translate(0,20)"></text></g></svg></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(function () {
                            // Create the chart
                            $('#gsContainerTrendSekolah').highcharts({
                                // DATA BASIC
                                "chart":{"type":"line","marginBottom":100,"options3d":{"enabled":"true","alpha":0,"beta":0,"depth":50}},
                                "title":{"text":"GRAFIK TREND JUMLAH TARUNA"},
                                "subtitle":{"text":""},
                                "xAxis":{"type":"category"},
                                "yAxis":{"title":{"text":"Jumlah"}},
                                "legend":{"enabled":false},
                                "plotOptions":{series:{borderWidth:0,colorByPoint:false,dataLabels:{enabled:true}},column:{depth:50}},

                                // DATA
                                series:
                                    [
                                        {
                                            name: 'Jumlah Taruna',
                                            "data": []
                                        }
                                    ]
                            })
                        });
                    </script>

                    <script type="text/javascript">
                        function getData(){
                            var tahunMasukAwal  = $('#tahunMasukAwal').val();
                            var tahunMasukAkhir = $('#tahunMasukAkhir').val();

                            if (tahunMasukAwal == '') {
                                alert("Silahkan mengisikan Pilihan Tahun Awal");
                                return false;
                            };

                            if (tahunMasukAwal > tahunMasukAkhir) {
                                alert("Pilihan Tahun Akhir Harus Lebih Besar Dari Pilihan Tahun Awal");
                                return false;
                            };

                            if (tahunMasukAwal == tahunMasukAkhir) {
                                alert("Pilihan Tahun Akhir Tidak Boleh Sama Dengan Pilihan Tahun Awal");
                                return false;
                            };

                            if (tahunMasukAwal != '' && tahunMasukAkhir != '') {
                                $.ajax({
                                    url: "/index.php?mod=laporan_db&sub=renderChartTrendSekolah&act=view&typ=html",
                                    data:{tahunMasukAwal:tahunMasukAwal,tahunMasukAkhir:tahunMasukAkhir},
                                    type:"post",
                                    success: function(result){
                                        $("#charttrendsekolah").html(result);
                                    }});
                            };

                        }

                        $('#tahunMasukAkhir').on('change', getData);
                    </script>

                    <!-- FormHelper Content END-->

                    <script>if(window.ButtonAccess){ var ba = new ButtonAccess(""); ba.removeButton();}
                    </script>
                </div>

                <!-- Box (with bar chart) -->
                <div class="box box-primary" id="loading-example">
                    <div class="box-header" style="cursor: move;">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="remove" data-original-title="Remove">
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
                                <div id="gsContainerDosenALl" style="height: 300px; margin: 0" data-highcharts-chart="1"><div class="highcharts-container" id="highcharts-4" style="position: relative; overflow: hidden; width: 1190px; height: 300px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="1190" height="300"><desc>Created with Highcharts 4.1.5</desc><defs><clipPath id="highcharts-5"><rect x="0" y="0" width="1146" height="128"></rect></clipPath></defs><rect x="0" y="0" width="1190" height="300" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 34 175.5 L 1180 175.5" stroke="#C0D0E0" stroke-width="1" zIndex="7" visibility="visible"></path></g><g class="highcharts-axis" zIndex="2"><text x="24" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 24 111)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" visibility="visible" y="111">Jumlah</text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-tracker" visibility="visible" zIndex="0.1" transform="translate(34,47) scale(1 1)" style="" clip-path="url(#highcharts-5)"></g><g class="highcharts-markers" visibility="visible" zIndex="0.1" transform="translate(34,47) scale(1 1)" clip-path="none"></g></g><text x="595" text-anchor="middle" class="highcharts-title" zIndex="4" style="color:#333333;font-size:18px;fill:#333333;width:1126px;" y="24"><tspan>GRAFIK DOSEN KESELURUHAN</tspan></text><g class="highcharts-data-labels highcharts-tracker" visibility="visible" zIndex="6" transform="translate(34,47) scale(1 1)" opacity="1" style=""></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;white-space:nowrap;" transform="translate(0,-9999)"><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path><path fill="rgba(249, 249, 249, .85)" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" transform="translate(0,20)"></text></g></svg></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Box (with bar chart) -->
                <div class="box box-primary" id="loading-example">
                    <div class="box-header" style="cursor: move;">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="remove" data-original-title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div><!-- /. tools -->
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Grafik Jumlah Taruna</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-sm-12">

                                <!-- FormHelper Content BEGIN -->

                                <script type="text/javascript">
                                    $(function () {
                                        // Create the chart
                                        $('#gsContainerTarunaNonDiklatALl').highcharts({
                                            // DATA BASIC
                                            "chart":{"type":"column","marginBottom":100,"options3d":{"enabled":"true","alpha":0,"beta":0,"depth":50}},
                                            "title":{"text":"GRAFIK TARUNA  KESELURUHAN"},
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
                                                        "data": []
                                                    }
                                                ]
                                        })
                                    });
                                </script>

                                <!-- FormHelper Content END-->

                                <script>if(window.ButtonAccess){ var ba = new ButtonAccess(""); ba.removeButton();}
                                </script>
                                <div id="gsContainerTarunaNonDiklatALl" style="height: 300px; margin: 0" data-highcharts-chart="2"><div class="highcharts-container" id="highcharts-6" style="position: relative; overflow: hidden; width: 1190px; height: 300px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="1190" height="300"><desc>Created with Highcharts 4.1.5</desc><defs><clipPath id="highcharts-7"><rect x="0" y="0" width="1190" height="400"></rect></clipPath></defs><rect x="0" y="0" width="1190" height="300" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g zIndex="-3" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 56.46195234435049 197.9619523443505 L 1157.5380476556495 197.9619523443505 L 1157.5380476556495 49.998847040737886 L 56.46195234435049 49.998847040737886 Z" zIndex="51" stroke-linejoin="round"></path></g><g zIndex="-2" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 33 201 L 34 201 L 34 47 L 33 47 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 34 47 L 34 201 L 56.46195234435049 197.9619523443505 L 56.46195234435049 49.998847040737886 Z" zIndex="25.5" stroke-linejoin="round"></path></g><g zIndex="-1" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 34 201 L 1180 201 L 1180 200 L 34 200 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 1180 200 L 1157.9615384615386 197.05769230769232 L 56.03846153846155 197.05769230769232 L 34 200 Z" zIndex="25" stroke-linejoin="round"></path></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 34 200.5 L 1180 200.5" stroke="#C0D0E0" stroke-width="1" zIndex="7" visibility="hidden"></path></g><g class="highcharts-axis" zIndex="2"><text x="24" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 24 123.5)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" visibility="visible" y="123.5">Jumlah</text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-tracker" visibility="visible" zIndex="10" transform="translate(34,47) scale(1 1)" style="" clip-path="url(#highcharts-7)"></g><g class="highcharts-markers" visibility="visible" zIndex="10" transform="translate(34,47) scale(1 1)" clip-path="none"></g></g><text x="595" text-anchor="middle" class="highcharts-title" zIndex="4" style="color:#333333;font-size:18px;fill:#333333;width:1126px;" y="24"><tspan>GRAFIK TARUNA  KESELURUHAN</tspan></text><g class="highcharts-data-labels highcharts-tracker" visibility="visible" zIndex="6" transform="translate(34,47) scale(1 1)" opacity="1" style=""></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;white-space:nowrap;" transform="translate(0,-9999)"><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path><path fill="rgba(249, 249, 249, .85)" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" transform="translate(0,20)"></text></g></svg></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Box (with bar chart) -->
                <div class="box box-primary" id="loading-example">
                    <div class="box-header" style="cursor: move;">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="remove" data-original-title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div><!-- /. tools -->
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Grafik Jumlah Peserta Short Course</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-sm-12">

                                <!-- FormHelper Content BEGIN -->

                                <script type="text/javascript">
                                    $(function () {
                                        // Create the chart
                                        $('#gsContainerPesertaDiklatALl').highcharts({
                                            // DATA BASIC
                                            "chart":{"type":"column","marginBottom":100,"options3d":{"enabled":"true","alpha":0,"beta":0,"depth":50}},
                                            "title":{"text":"GRAFIK JUMLAH PESERTA SHORT COURSE  KESELURUHAN"},
                                            "subtitle":{"text":""},
                                            "xAxis":{"type":"category"},
                                            "yAxis":{"title":{"text":"Jumlah"}},
                                            "legend":{"enabled":false},
                                            "plotOptions":{series:{borderWidth:0,colorByPoint:true,dataLabels:{enabled:true}},column:{depth:50}},

                                            // DATA
                                            series:
                                                [
                                                    {
                                                        name: 'Jumlah Peserta Diklat',
                                                        "data": []
                                                    }
                                                ]
                                        })
                                    });
                                </script>

                                <!-- FormHelper Content END-->

                                <script>if(window.ButtonAccess){ var ba = new ButtonAccess(""); ba.removeButton();}
                                </script>
                                <div id="gsContainerPesertaDiklatALl" style="height: 300px; margin: 0" data-highcharts-chart="3"><div class="highcharts-container" id="highcharts-8" style="position: relative; overflow: hidden; width: 1190px; height: 300px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="1190" height="300"><desc>Created with Highcharts 4.1.5</desc><defs><clipPath id="highcharts-9"><rect x="0" y="0" width="1190" height="400"></rect></clipPath></defs><rect x="0" y="0" width="1190" height="300" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g zIndex="-3" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 56.46195234435049 197.9619523443505 L 1157.5380476556495 197.9619523443505 L 1157.5380476556495 49.998847040737886 L 56.46195234435049 49.998847040737886 Z" zIndex="51" stroke-linejoin="round"></path></g><g zIndex="-2" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 33 201 L 34 201 L 34 47 L 33 47 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 34 47 L 34 201 L 56.46195234435049 197.9619523443505 L 56.46195234435049 49.998847040737886 Z" zIndex="25.5" stroke-linejoin="round"></path></g><g zIndex="-1" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 34 201 L 1180 201 L 1180 200 L 34 200 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 1180 200 L 1157.9615384615386 197.05769230769232 L 56.03846153846155 197.05769230769232 L 34 200 Z" zIndex="25" stroke-linejoin="round"></path></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 34 200.5 L 1180 200.5" stroke="#C0D0E0" stroke-width="1" zIndex="7" visibility="hidden"></path></g><g class="highcharts-axis" zIndex="2"><text x="24" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 24 123.5)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" visibility="visible" y="123.5">Jumlah</text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-tracker" visibility="visible" zIndex="10" transform="translate(34,47) scale(1 1)" style="" clip-path="url(#highcharts-9)"></g><g class="highcharts-markers" visibility="visible" zIndex="10" transform="translate(34,47) scale(1 1)" clip-path="none"></g></g><text x="595" text-anchor="middle" class="highcharts-title" zIndex="4" style="color:#333333;font-size:18px;fill:#333333;width:1126px;" y="24"><tspan>GRAFIK JUMLAH PESERTA SHORT COURSE  KESELURUHAN</tspan></text><g class="highcharts-data-labels highcharts-tracker" visibility="visible" zIndex="6" transform="translate(34,47) scale(1 1)" opacity="1" style=""></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;white-space:nowrap;" transform="translate(0,-9999)"><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path><path fill="rgba(249, 249, 249, .85)" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" transform="translate(0,20)"></text></g></svg></div></div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>

    </section><!-- /.content -->
@endsection
