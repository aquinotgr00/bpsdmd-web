@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.job_title')) }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                <label for="code">{{ ucfirst(trans('common.code')) }} :</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                                <span class="help-block ">{!! implode('', $errors->get('code')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(trans('common.name')) }} :</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('education_minimal') ? 'has-error' : '' }}">
                                <label for="education_minimal">{{ ucwords(trans('common.education_minimal')) }} :</label>
                                <input type="text" class="form-control" id="education_minimal" name="education_minimal" value="{{ old('education_minimal') }}">
                                <span class="help-block ">{!! implode('', $errors->get('education_minimal')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gpa_minimal') ? 'has-error' : '' }}">
                                <label for="gpa_minimal">{{ ucwords(trans('common.gpa_minimal')) }} :</label>
                                <input type="text" class="form-control" id="gpa_minimal" name="gpa_minimal" value="{{ old('gpa_minimal') }}">
                                <span class="help-block ">{!! implode('', $errors->get('gpa_minimal')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('age_minimal') ? 'has-error' : '' }}">
                                <label for="age_minimal">{{ ucwords(trans('common.age_minimal')) }} :</label>
                                <input type="text" class="form-control" id="age_minimal" name="age_minimal" value="{{ old('age_minimal') }}">
                                <span class="help-block ">{!! implode('', $errors->get('age_minimal')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('experience_minimal') ? 'has-error' : '' }}">
                                <label for="experience_minimal">{{ ucwords(trans('common.experience_minimal')) }} :</label>
                                <input type="text" class="form-control" id="experience_minimal" name="experience_minimal" value="{{ old('experience_minimal') }}">
                                <span class="help-block ">{!! implode('', $errors->get('experience_minimal')) !!}</span>
                            </div>

                            <div class="form-group has-job-function">
                                <label for="name">{{ ucfirst(trans('common.is_there_job_function')) }}</label>
                                <div id="radioJobFunction" style="margin-left: 5px">
                                    <label for="withJobFunction">
                                        <input type="radio" id="withJobFunction" name="job_function_exist" value="yes"> {{ ucfirst(trans('common.yes')) }} &nbsp;
                                    </label>
                                    <label for="noJobFunction" style="margin-left: 15px">
                                        <input type="radio" id="noJobFunction" name="job_function_exist" value="no"> {{ ucfirst(trans('common.no')) }}
                                    </label>
                                </div>
                                <span class="help-block ">{!! implode('', $errors->get('withJobFunction')) !!}</span>
                            </div>

                            <div id="noJobFunctionInput" class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
                                <label for="license">{{ ucfirst(trans('common.license')) }} :</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="license" class="form-control">
                                            <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.license'))])) }}</option>
                                            @if(!empty($licenses))
                                                @foreach($licenses as $license)
                                                    <option value="{{ $license->getId() }}" data-id="{{ $license->getId() }}" data-label="{{ $license->getCode().' '.$license->getChapter().' - '.$license->getName() }}">{{ $license->getCode().' '.$license->getChapter().' - '.$license->getName() }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="javascript:void(0)" class="btn btn-default btnChooser">{{ ucfirst(trans('common.choose')) }}</a>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 20px">
                                        <ul class="list-group"></ul>
                                    </div>
                                </div>
                                <span class="help-block">{!! implode('', $errors->get('license')) !!}</span>
                            </div>

                            <div id="withJobFunctionInput" class="form-group {{ $errors->has('job_function') ? 'has-error' : '' }}">
                                <label for="job_function">{{ ucfirst(trans('common.job_function')) }} :</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="function" class="form-control">
                                            <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.job_function'))])) }}</option>
                                            @if(!empty($functions))
                                                @foreach($functions as $function)
                                                    <option value="{{ $function->getId() }}" data-id="{{ $function->getId() }}" data-label="{{ $function->getCode().' - '.$function->getName() }}">{{ $function->getCode().' - '.$function->getName() }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="javascript:void(0)" class="btn btn-default btnChooserFunction">Pilih</a>
                                    </div>

                                    <div class="item-job-function"></div>
                                </div>
                                <span class="help-block">{!! implode('', $errors->get('job_function')) !!}</span>
                            </div>

                            <div class="box-footer" style="text-align: right;min-height: 50px;">
                                <button class="btn btn-primary pull-right">{{ ucfirst(trans('common.add')) }}</button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@section('script')
    <script>
        let withJobFunctionInput = $(document).find('div#withJobFunctionInput'),
            noJobFunctionInput = $(document).find('div#noJobFunctionInput');

        withJobFunctionInput.hide();
        noJobFunctionInput.hide();

        $('#radioJobFunction input').on('change', function () {
            let value = $(this).val();

            if (value === 'yes') {
                noJobFunctionInput.hide();
                withJobFunctionInput.show();
            } else {
                withJobFunctionInput.hide();
                noJobFunctionInput.show();
            }
        });

        // no job function
        $('a.btnChooser').live('click', function () {
            let listing = $('.list-group'),
                input = $(this).parent().parent().find('select#license option:selected'),
                template = '<li class="list-group-item">\n' +
                    '<input type="hidden" name="license[]" value="">\n' +
                    '<span class="name"></span>\n' +
                    '<a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">\n' +
                    '<span class="glyphicon glyphicon-remove"></span>\n' +
                    '</a>\n' +
                    '</li>';

            if (input.val()) {
                let rendered = $(template);

                rendered.find('input').val(input.data('id'));
                rendered.find('span.name').html(input.data('label'));

                listing.append(rendered);
                input.remove();
            }
        });

        $('a.btnRemove').live('click', function () {
            let selector = $(this).parent(),
                id = selector.find('input').val(),
                label = selector.find('span.name').html(),
                template = '<option value="" data-id="" data-label=""></option>',
                input = $('select#license');

            let rendered = $(template);

            rendered.attr('value', id);
            rendered.attr('data-id', id);
            rendered.attr('data-label', label);
            rendered.text(label);

            input.append(rendered);
            $(this).parent().remove();
        });

        // with job function selector
        let licenses = {!! $arrayLicenses !!},
            licenseOptions = '';

        $.each(licenses, function( index, data ) {
            licenseOptions = licenseOptions + '<option value="'+data.id+'" data-id="'+data.id+'" data-label="'+data.label+'">'+data.label+'</option>';
        });

        $('a.btnChooserFunction').live('click', function () {
            let listing = $('.item-job-function'),
                input = $(this).parent().parent().find('select#function option:selected'),
                template = '<div class="job-functions form-group">'+
                '<div class="col-md-6 sub-form">'+
                '<div class="sub-form-group">'+
                '<a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemoveFunction"><span class="glyphicon glyphicon-remove"></span></a>'+
                '<p class="name"><b>{{ ucwords(trans('common.job_function')) }}</b></p>'+
                '<input type="hidden" name="job_function[]" value="">' +
                '<hr>'+
                '<select id="licenseJF" class="form-control">'+
                '<option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucfirst(trans('common.license'))])) }}</option>'+ licenseOptions +
                '</select>'+
                '<div style="margin-top:10px;text-align: right">'+
                '<a href="javascript:void(0)" class="btn btn-default btnChooserLicenseJF">{{ ucfirst(trans('common.choose')) }}</a>'+
                '</div>'+
                '<div style="margin-top: 20px">'+
                '<ul class="list-group-licenseJF" style="padding-inline-start: 0px;"></ul>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div><div class="clearfix"></div>';

            if (input.val()) {
                let rendered = $(template);

                rendered.find('input').val(input.data('id'));
                rendered.find('p.name').html(input.data('label'));

                listing.append(rendered);
                input.remove();
            }
        });

        $('a.btnRemoveFunction').live('click', function () {
            let selector = $(this).parent(),
                id = selector.find('input').val(),
                label = selector.find('p.name').html(),
                template = '<option value="" data-id="" data-label=""></option>',
                input = $('select#function');

            let rendered = $(template);

            rendered.attr('value', id);
            rendered.attr('data-id', id);
            rendered.attr('data-label', label);
            rendered.text(label);

            input.append(rendered);
            $(this).parent().parent().remove();
        });

        // with job function license
        $('a.btnChooserLicenseJF').live('click', function () {
            let jobFunction = $(this).parent().parent().find('input').val(),
                listing = $(this).parent().parent().find('.list-group-licenseJF'),
                input = $(this).parent().parent().find('select#licenseJF option:selected'),
                template = '<li class="list-group-item">\n' +
                    '<input type="hidden" name="license['+jobFunction+'][]" value="">\n' +
                    '<span class="name"></span>\n' +
                    '<a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemoveLicenseJF">\n' +
                    '<span class="glyphicon glyphicon-remove"></span>\n' +
                    '</a>\n' +
                    '</li>';

            if (input.val()) {
                let rendered = $(template);

                rendered.find('input').val(input.data('id'));
                rendered.find('span.name').html(input.data('label'));

                listing.append(rendered);
                input.remove();
            }
        });

        $('a.btnRemoveLicenseJF').live('click', function () {
            let selector = $(this).parent(),
                id = selector.find('input').val(),
                label = selector.find('span.name').html(),
                template = '<option value="" data-id="" data-label=""></option>',
                input = $(this).parent().parent().parent().parent().find('select#licenseJF');

            let rendered = $(template);

            rendered.attr('value', id);
            rendered.attr('data-id', id);
            rendered.attr('data-label', label);
            rendered.text(label);

            input.append(rendered);
            $(this).parent().remove();
        });
    </script>
@endsection
