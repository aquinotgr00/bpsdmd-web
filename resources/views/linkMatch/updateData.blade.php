@extends('layout.main')
@section('content')
<section class="content-header">
    <h1>Edit Relasi Link and Match <br /><small>{{ $org->getName() }} - {{ $program->getName() }}</small></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="2afeDsRvN951yVEvOWxSdVLtgVZcJFxvH24ruefM">

                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="license">Pilih Lisensi :</label>
                                        <select id="license" class="form-control">
                                            <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.license'))])) }}</option>
                                            @if(!empty($licenses))
                                                @foreach($licenses as $license)
                                                    <option value="{{ $license->getId() }}" data-id="{{ $license->getId() }}" data-label="{{ $license->getCode().' '.$license->getChapter().' - '.$license->getName() }}">{{ $license->getCode().' '.$license->getChapter().' - '.$license->getName() }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        <div style="text-align: right;margin: 10px 0 30px 0;">
                                            <a href="javascript:void(0)" class="btn btn-default btnChooser">Pilih</a>
                                        </div>

                                        <ul id="license-group" class="list-group">
                                            @foreach($selectedLicense as $sl)
                                                <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="{{ $sl->getId() }}">
                                                    <span class="name">{{ $sl->getCode().' '.$sl->getChapter().' - '.$sl->getName() }}</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="instansi-demand">Pilih Instansi Demand :</label>
                                        <select id="demand" class="form-control">
                                            <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.demand'))])) }}</option>
                                            @if(!empty($demands))
                                                @foreach($demands as $demand)
                                                    <option value="{{ $demand->getId() }}">{{ $demand->getName() }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <br /><br />
                                        <!-- sesuai matra, jika matra instansi udara, maka tampilkan semua jabatan yang terhubung dengan matra udara -->
                                        <label for="jobTitle">Pilih Jabatan :</label>
                                        <select id="jobTitle" class="form-control">
                                            <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.job_title'))])) }}</option>
                                        </select>

                                        <div style="text-align: right;margin: 10px 0 30px 0;">
                                            <a href="javascript:void(0)" class="btn btn-default btnChooserJobTitle">Pilih</a>
                                        </div>

                                        <ul id="jobTitle-group" class="list-group">
                                            @foreach($jobTitles as $jobTitle)
                                                <li class="list-group-item">
                                                    <input type="hidden" name="job_title[]" value="{{ $jobTitle->getId() }}">
                                                    <span class="name">{{ $jobTitle->getName() }}</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemoveJobTitle">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <span class="help-block"></span>
                            </div>

                            <div class="box-footer" style="text-align: right;min-height: 50px;">
                                <button class="btn btn-primary pull-right">Ubah Relasi Link and Match</button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        $('select#demand').live('change', function () {
            let id = $(this).val();

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

        $('a.btnChooser').live('click', function () {
            var listing = $('#license-group'),
                input = $(document).find('select#license option:selected'),
                template = '<li class="list-group-item">\n' +
                    '<input type="hidden" name="license[]" value="">\n' +
                    '<span class="name"></span>\n' +
                    '<a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">\n' +
                    '<span class="glyphicon glyphicon-remove"></span>\n' +
                    '</a>\n' +
                    '</li>';

            if (input.val()) {
                var rendered = $(template);

                rendered.find('input').val(input.data('id'));
                rendered.find('span.name').html(input.data('label'));

                listing.append(rendered);
                input.remove();
            }
        });

        $('a.btnRemove').live('click', function () {
            var selector = $(this).parent(),
                id = selector.find('input').val(),
                label = selector.find('span.name').html(),
                template = '<option value="" data-id="" data-label=""></option>',
                input = $('select#license');

            var rendered = $(template);

            rendered.attr('value', id);
            rendered.attr('data-id', id);
            rendered.attr('data-label', label);
            rendered.text(label);

            input.append(rendered);
            $(this).parent().remove();
        });

        $('a.btnChooserJobTitle').live('click', function () {
            var listing = $('#jobTitle-group'),
                input = $(document).find('select#jobTitle option:selected'),
                template = '<li class="list-group-item">\n' +
                    '<input type="hidden" name="job_title[]" value="">\n' +
                    '<span class="name"></span>\n' +
                    '<a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemoveJobTitle">\n' +
                    '<span class="glyphicon glyphicon-remove"></span>\n' +
                    '</a>\n' +
                    '</li>';

            if (input.val()) {
                var rendered = $(template);

                rendered.find('input').val(input.data('id'));
                rendered.find('span.name').html(input.data('label'));

                listing.append(rendered);
                input.remove();
            }
        });

        $('a.btnRemoveJobTitle').live('click', function () {
            var selector = $(this).parent(),
                id = selector.find('input').val(),
                label = selector.find('span.name').html(),
                template = '<option value="" data-id="" data-label=""></option>',
                input = $('select#jobTitle');

            var rendered = $(template);

            rendered.attr('value', id);
            rendered.attr('data-id', id);
            rendered.attr('data-label', label);
            rendered.text(label);

            input.append(rendered);
            $(this).parent().remove();
        });
    </script>
@endsection
