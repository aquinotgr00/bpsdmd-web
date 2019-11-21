@extends('layout.main')

@section('style')
    <style>
        .list-prodi-item.active {
            background-color: rgb(102, 102, 102);
            color: rgb(255, 255, 255);
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>Link and Match - Supply</h1>
        <ol class="breadcrumb">
            <li>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content recruitment">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box-body">
                    @include('layout.partial.alert')
                    <section class="content" id="subcontent-element">
                        <section class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <form action="" method="post">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label>{{ ucwords(trans('common.school_name')) }}</label>
                                                    <select name="sekolah" id="sekolah-selector" class="form-control">
                                                    <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucfirst(trans('common.school'))])) }}</option>
                                                        @if(!empty($schools))
                                                            @foreach($schools as $id => $name)
                                                               <option value="{{ $id }}">{{ $name }}</option>
                                                            @endforeach
                                                        @endif
                                                	</select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                        <div class="box">
                                            <div class="box-header" style="cursor: move;">
                                                <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Program Studi</h3>
                                            </div>
                                            <div class="box-body" id="list-prodi"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                    <div class="box">
                                        <div class="box-header" style="cursor: move;">
                                            <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Kompetensi Supply</h3>
                                        </div>
                                        <div class="box-body" id="kompetensi-prodi">
                                            <ul class="kompetensi-prodi"></ul>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                        <div class="box">
                                            <div class="box-header" style="cursor: move;">
                                                <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Kompetensi Demand</h3>
                                            </div>
                                            <div class="box-body" id="demand-list"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                </section>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@section('script')
    <script>
        let listingProdi = 'div#list-prodi',
            defProdi = '<div class="list-prodi-item">{{ trans('common.no_data') }}</div>',
            listingSupply = 'ul.kompetensi-prodi',
            defSupply = '<li>{{ trans('common.no_data') }}</li>',
            listingDemand = 'div#demand-list',
            defDemand = '<div class="row"><div class="col-xs-12 col-md-12"><div class="lowongan-item"><span>{{ trans('common.no_data') }}</span></div></div></div>';

        function clearListing() {
            $(listingProdi).html(defProdi);
            $(listingSupply).html(defSupply);
            $(listingDemand).html(defDemand);
        }

        // init page
        clearListing();

        $('select#sekolah-selector').live('change', function () {
            let id = $(this).val();

            clearListing();

            if (id > 0) {
                $.get('/link-match/program/'+id, function(programs, status){
                    if (status === 'success') {
                        let html = '';

                        $.each(programs, function( index, data ) {
                            html = html + '<div class="list-prodi-item" data-id="'+data.id+'">'+data.name+'</div>';
                        });

                        if (html.length > 0) {
                            $(listingProdi).html(html);
                        }
                    }
                });
            }
        });

        $('div.list-prodi-item').live('click', function () {
            let id = $(this).data('id');

            $('div.list-prodi-item.active').removeClass('active');
            $(listingSupply).html(defSupply);
            $(listingDemand).html(defDemand);

            if (id > 0) {
                $(this).addClass('active');

                $.get('/link-match/program-license/'+id, function(licenses, status){
                    if (status === 'success') {
                        let html = '';

                        $.each(licenses, function( index, data ) {
                            html = html + '<li>'+data.name+'</li>';
                        });

                        if (html.length > 0) {
                            $(listingSupply).html(html);
                        }
                    }
                });

                $.get('/link-match/demand-by-program/'+id, function(jobTitles, status){
                    if (status === 'success') {
                        let html = '';

                        $.each(jobTitles, function( index, data ) {
                            let htmlJobTitle = '';

                            $.each(data.jobTitle, function( index, dajo ) {
                                let htmlCompetencies = '';

                                $.each(dajo.competencies, function( index, dacom ) {
                                    htmlCompetencies = htmlCompetencies + '<li>'+dacom+'</li>';
                                });

                                htmlJobTitle = htmlJobTitle +
                                    '<div class="lowongan-item"><span>'+dajo.name+'</span>'+
                                    '<ul class="list-kompetensi">'+
                                    htmlCompetencies+
                                    '</ul></div>';
                            });

                            html = html + '<div class="box-body" id="demand-list"><div class="row"><div class="col-xs-2 col-md-2" style="margin-left: 10px;"><img src="'+data.logo+'" alt="" class="img-responsive"></div><div class="col-xs-9 col-md-9" style="padding: 10px;"><span style="font-weight: bold">'+data.company+'</span></div><div class="col-xs-12 col-md-12">' +
                            htmlJobTitle +
                            '</div></div></div>';
                        });

                        if (html.length > 0) {
                            $(listingDemand).html(html);
                        }
                    }
                });
            }
        });
    </script>
@endsection
