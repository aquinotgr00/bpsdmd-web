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
                <div class="small-box bg-disable">
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
                <div class="small-box bg-disable">
                    <div class="inner">
                        <p> Total Taruna </p>
                        <h3> 3.814 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart-o"></i>
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
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <p> Jumlah Peserta Short Course </p>
                        <h3> 0 </h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <a class="small-box-footer" href="{{url(route('dashboard'))}}" title="Back">
                        <i class="fa fa-arrow-circle-left"></i>
                        Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="row" style="display:">
            <section class="col-lg-12">
                <!-- Box (with bar chart) -->
                <div class="box box-primary" id="loading-example">
                    <div class="box-header" style="cursor: move;">
                        <i class="fa fa-calendar"></i>
                        <h3 class="box-title"> Pilihan Tahun Masuk</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-sm-12">

                                <form action="" method="post" onsubmit="return cekform(this);">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Tahun Masuk</label>

                                            <!-- FormHelper Content BEGIN -->


                                            <select name="tahunMasuk" id="tahunMasuk" class="form-control">

                                                <option value="all">-- SEMUA --</option>

                                                <option value="2019">2019</option>

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
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="row" style="display:none">
            <section class="col-lg-12">
                <!-- Box (with bar chart) -->
                <div class="box box-primary" id="loading-example">
                    <div class="box-header" style="cursor: move;">
                        <i class="fa fa-calendar"></i>
                        <h3 class="box-title"> Pilihan Tahun Masuk : </h3>
                    </div><!-- /.box-header -->
                </div>
            </section>
        </div>

        <div class="row" style="display:">
            <section class="col-lg-12 connectedSortable ui-sortable">
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
                        <h3 class="box-title"> Grafik Peserta Short Course  Keseluruhan </h3>
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
                                <div id="gsContainerPesertaDiklatALl" style="height: 300px; margin: 0" data-highcharts-chart="0"><div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 1190px; height: 300px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="1190" height="300"><desc>Created with Highcharts 4.1.5</desc><defs><clipPath id="highcharts-1"><rect x="0" y="0" width="1190" height="400"></rect></clipPath></defs><rect x="0" y="0" width="1190" height="300" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g zIndex="-3" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 56.46195234435049 197.9619523443505 L 1157.5380476556495 197.9619523443505 L 1157.5380476556495 49.998847040737886 L 56.46195234435049 49.998847040737886 Z" zIndex="51" stroke-linejoin="round"></path></g><g zIndex="-2" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 33 201 L 34 201 L 34 47 L 33 47 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 34 47 L 34 201 L 56.46195234435049 197.9619523443505 L 56.46195234435049 49.998847040737886 Z" zIndex="25.5" stroke-linejoin="round"></path></g><g zIndex="-1" style="stroke:rgba(255,255,255,0);"><path fill="rgba(255,255,255,0)" d="M 34 201 L 1180 201 L 1180 200 L 34 200 Z" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(230,230,230,0)" d="M 0 0" zIndex="0" stroke-linejoin="round"></path><path fill="rgba(255,255,255,0)" d="M 1180 200 L 1157.9615384615386 197.05769230769232 L 56.03846153846155 197.05769230769232 L 34 200 Z" zIndex="25" stroke-linejoin="round"></path></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 34 200.5 L 1180 200.5" stroke="#C0D0E0" stroke-width="1" zIndex="7" visibility="hidden"></path></g><g class="highcharts-axis" zIndex="2"><text x="24" zIndex="7" text-anchor="middle" transform="translate(0,0) rotate(270 24 123.5)" class=" highcharts-yaxis-title" style="color:#707070;fill:#707070;" visibility="visible" y="123.5">Jumlah</text></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-tracker" visibility="visible" zIndex="10" transform="translate(34,47) scale(1 1)" style="" clip-path="url(#highcharts-1)"></g><g class="highcharts-markers" visibility="visible" zIndex="10" transform="translate(34,47) scale(1 1)" clip-path="none"></g></g><text x="595" text-anchor="middle" class="highcharts-title" zIndex="4" style="color:#333333;font-size:18px;fill:#333333;width:1126px;" y="24"><tspan>GRAFIK JUMLAH PESERTA SHORT COURSE  KESELURUHAN</tspan></text><g class="highcharts-data-labels highcharts-tracker" visibility="visible" zIndex="6" transform="translate(34,47) scale(1 1)" opacity="1" style=""></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;white-space:nowrap;" transform="translate(0,-9999)"><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path><path fill="none" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path><path fill="rgba(249, 249, 249, .85)" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" transform="translate(0,20)"></text></g></svg></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="row" style="display:">
            <div class="col-xs-12">
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
                        <i class="fa fa-table"></i>
                        <h3 class="box-title">List Peserta Short Course  Keseluruhan</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <div id="listTaruna_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="listTaruna_length"><label>Show <select name="listTaruna_length" aria-controls="listTaruna" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="listTaruna_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="listTaruna"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="listTaruna" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="listTaruna_info">
                                        <thead>
                                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="listTaruna" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No.: activate to sort column descending">No.</th><th class="sorting" tabindex="0" aria-controls="listTaruna" rowspan="1" colspan="1" aria-label="Nama Sekolah: activate to sort column ascending" style="width: 329px;">Nama Sekolah</th><th class="sorting" tabindex="0" aria-controls="listTaruna" rowspan="1" colspan="1" aria-label="Jumlah Peserta Short Course: activate to sort column ascending" style="width: 591px;">Jumlah Peserta Short Course</th></tr>
                                        </thead>
                                        <tbody>


                                        <tr class="odd"><td valign="top" colspan="3" class="dataTables_empty">No data available in table</td></tr></tbody>
                                        <tfoot>
                                        <tr><th colspan="2" style="text-align:right;" rowspan="1">Total :</th><th style="text-align:right;" rowspan="1" colspan="1"></th></tr>
                                        </tfoot>
                                    </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="listTaruna_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="listTaruna_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="listTaruna_previous"><a href="#" aria-controls="listTaruna" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button next disabled" id="listTaruna_next"><a href="#" aria-controls="listTaruna" data-dt-idx="1" tabindex="0">Next</a></li></ul></div></div></div></div>
                    </div><!-- /.box-body -->
                    <script type="text/javascript">
                        $(function() {
                            $("#listTaruna").dataTable();
                        });
                    </script>
                </div>
            </div>
        </div>

        <!-- separator -->

        <div class="row" style="display:none">
            <div class="col-xs-12">
                <div class="box box-primary" id="loading-example">
                    <div class="box-header" style="cursor: move;">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button onclick="window.location.href = '/index.php?mod=laporan_db&amp;sub=dbTarunaDiklat&amp;act=view&amp;typ=html'" class="btn btn-primary btn-sm" data-toggle="tooltip" title="" data-original-title="Back">
                                <i class="fa fa-arrow-circle-left"></i> Back
                            </button>
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" title="" data-toggle="tooltip" data-widget="remove" data-original-title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div><!-- /. tools -->
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">
                            List Taruna Peserta Diklat <span class="keywordDetail"></span>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <div id="listTarunaFak_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="listTarunaFak_length"><label>Show <select name="listTarunaFak_length" aria-controls="listTarunaFak" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="listTarunaFak_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="listTarunaFak"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="listTarunaFak" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="listTarunaFak_info">
                                        <thead>
                                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="listTarunaFak" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No.: activate to sort column descending">No.</th><th class="sorting" tabindex="0" aria-controls="listTarunaFak" rowspan="1" colspan="1" aria-label="NIM: activate to sort column ascending" style="width: 0px;">NIM</th><th class="sorting" tabindex="0" aria-controls="listTarunaFak" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 0px;">Nama</th><th class="sorting" tabindex="0" aria-controls="listTarunaFak" rowspan="1" colspan="1" aria-label="Tahun Masuk: activate to sort column ascending" style="width: 0px;">Tahun Masuk</th><th class="sorting" tabindex="0" aria-controls="listTarunaFak" rowspan="1" colspan="1" aria-label="Prodi: activate to sort column ascending" style="width: 0px;">Prodi</th></tr>
                                        </thead>
                                        <tbody>

                                        <tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">No data available in table</td></tr></tbody>
                                    </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="listTarunaFak_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="listTarunaFak_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="listTarunaFak_previous"><a href="#" aria-controls="listTarunaFak" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button next disabled" id="listTarunaFak_next"><a href="#" aria-controls="listTarunaFak" data-dt-idx="1" tabindex="0">Next</a></li></ul></div></div></div></div>
                    </div><!-- /.box-body -->
                    <script type="text/javascript">
                        $(function() {
                            $("#listTarunaFak").dataTable();
                        });
                    </script>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('select').on('change', function(e){
                this.form.submit()
            });
        </script>
    </section><!-- /.content -->
@endsection
