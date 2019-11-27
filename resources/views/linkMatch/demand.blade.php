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
        <h1>Link and Match - Demand</h1>
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
                                                    <select name="demand" id="demand-selector" class="form-control">
                                                        <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucfirst(trans('common.company'))])) }}</option>
                                                        @if(!empty($demands))
                                                            @foreach($demands as $id => $name)
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
                                                <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Jabatan</h3>
                                            </div>
                                            <div class="box-body" id="list-jabatan"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                        <div class="box">
                                            <div class="box-header" style="cursor: move;">
                                                <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Kompetensi Demand</h3>
                                            </div>
                                            <div class="box-body" id="kompetensi-jabatan">
                                                <ul class="kompetensi-jabatan"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                        <div class="box">
                                            <div class="box-header" style="cursor: move;">
                                                <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Kompetensi Supply</h3>
                                            </div>
                                            <div class="box-body" id="supply-list"></div>
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
        let listingJabatan = 'div#list-jabatan',
            defJabatan = '<div class="list-jabatan-item">{{ trans('common.no_data') }}</div>',
            listingKompetensi = 'ul.kompetensi-jabatan',
            defKompetensi = '<li>{{ trans('common.no_data') }}</li>',
            listingSupply = 'div#supply-list',
            defSupply = '<div class="row"><div class="col-xs-12 col-md-12"><div class="lowongan-item"><span>{{ trans('common.no_data') }}</span></div></div></div>';

        function clearListing() {
            $(listingJabatan).html(defJabatan);
            $(listingKompetensi).html(defKompetensi);
            $(listingSupply).html(defSupply);
        }

        // init page
        clearListing();

        $('select#demand-selector').live('change', function () {
            let id = $(this).val();

            clearListing();

            if (id > 0) {
                $.get('/link-match/job-title/'+id, function(programs, status){
                    if (status === 'success') {
                        let html = '';

                        $.each(programs, function( index, data ) {
                            html = html + '<div class="list-prodi-item" data-id="'+data.id+'">'+data.name+'</div>';
                        });

                        if (html.length > 0) {
                            $(listingJabatan).html(html);
                        }
                    }
                });
            }
        });

        $('div.list-prodi-item').live('click', function () {
            let id = $(this).data('id');

            $('div.list-prodi-item.active').removeClass('active');
            $(listingKompetensi).html(defKompetensi);
            $(listingSupply).html(defSupply);

            if (id > 0) {
                $(this).addClass('active');

                $.get('/link-match/job-title-license/'+id, function(licenses, status){
                    if (status === 'success') {
                        let html = '';

                        $.each(licenses, function( index, data ) {
                            html = html + '<li>'+data.name+'</li>';
                        });

                        if (html.length > 0) {
                            $(listingKompetensi).html(html);
                        }
                    }
                });

                $.get('/link-match/supply-by-job-title/'+id, function(programs, status){
                    if (status === 'success') {
                        let html = '';

                        $.each(programs, function( index, data ) {
                            let htmlProgram = '';

                            $.each(data.program, function( index, dapro ) {
                                let htmlCompetencies = '';

                                $.each(dapro.competencies, function( index, dacom ) {
                                    htmlCompetencies = htmlCompetencies + '<li>'+dacom+'</li>';
                                });

                                htmlProgram = htmlProgram +
                                    '<div class="lowongan-item"><span>'+dapro.name+'</span>'+
                                    '<ul class="list-kompetensi">'+
                                    htmlCompetencies+
                                    '</ul></div>';
                            });

                            html = html + '<div class="box-body" id="demand-list"><div class="row"><div class="col-xs-2 col-md-2" style="margin-left: 10px;"><img src="'+data.logo+'" alt="" class="img-responsive"></div><div class="col-xs-9 col-md-9" style="padding: 10px;"><span style="font-weight: bold">'+data.company+'</span></div><div class="col-xs-12 col-md-12">' +
                                htmlProgram +
                                '</div></div></div>';
                        });

                        if (html.length > 0) {
                            $(listingSupply).html(html);
                        }
                    }
                });
            }
        });
    </script>
@endsection
