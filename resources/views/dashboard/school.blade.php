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
                    <a class="small-box-footer" href="{{url(route('dashboard'))}}" title="Back">
                        <i class="fa fa-arrow-circle-left"></i>
                        Dashboard
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
                        <h3 class="box-title">PROFIL SEKOLAH BADAN PENGEMBANGAN SDM PERHUBUNGAN</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <div id="listDiklat_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="listDiklat_length"><label>Show <select name="listDiklat_length" aria-controls="listDiklat" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="listDiklat_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="listDiklat"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="listDiklat" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="listDiklat_info">
                                        <thead>
                                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="listDiklat" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No.: activate to sort column descending">No.</th><th class="sorting" tabindex="0" aria-controls="listDiklat" rowspan="1" colspan="1" aria-label="Sekolah: activate to sort column ascending" style="width: 336px;">Sekolah</th><th class="sorting" tabindex="0" aria-controls="listDiklat" rowspan="1" colspan="1" aria-label="Program Studi: activate to sort column ascending" style="width: 501px;">Program Studi</th></tr>
                                        </thead>
                                        <tbody>


                                        <tr class="odd"><td valign="top" colspan="3" class="dataTables_empty">No data available in table</td></tr></tbody>
                                        <tfoot>
                                        <tr><th colspan="2" style="text-align:right;" rowspan="1">Total</th><th style="text-align:right;" rowspan="1" colspan="1"></th></tr>
                                        </tfoot>
                                    </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="listDiklat_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="listDiklat_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="listDiklat_previous"><a href="#" aria-controls="listDiklat" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button next disabled" id="listDiklat_next"><a href="#" aria-controls="listDiklat" data-dt-idx="1" tabindex="0">Next</a></li></ul></div></div></div></div>
                    </div><!-- /.box-body -->
                    <script type="text/javascript">
                        $(function() {
                            $("#listDiklat").dataTable();
                        });
                    </script>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection
