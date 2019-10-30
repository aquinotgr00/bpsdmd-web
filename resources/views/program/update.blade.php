@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucwords(trans('common.study_program')) }}</h1>
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
                                <input id="code" name="code" type="text" class="form-control" value="{{ $data->getCode() }}">
                                <span class="help-block">{!! implode('', $errors->get('code')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(trans('common.name')) }} :</label>
                                <input id="name" type="text" name="name" class="form-control" value="{{ $data->getName() }}">
                                <span class="help-block">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('degree') ? 'has-error' : '' }}">
                                <label for="degree">{{ ucfirst(trans('common.degree')) }} :</label>
                                <select id="degree" name="degree" class="form-control">
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_D1 }}" {{ $data->getDegree() == \App\Entities\StudyProgram::DEGREE_D1 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_D1) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_D2 }}" {{ $data->getDegree() == \App\Entities\StudyProgram::DEGREE_D2 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_D2) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_D3 }}" {{ $data->getDegree() == \App\Entities\StudyProgram::DEGREE_D3 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_D3) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_S1 }}" {{ $data->getDegree() == \App\Entities\StudyProgram::DEGREE_S1 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_S1) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_S2 }}" {{ $data->getDegree() == \App\Entities\StudyProgram::DEGREE_S2 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_S2) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('degree')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('license') ? 'has-error' : '' }}">
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
                                        <a href="javascript:void(0)" class="btn btn-default btnChooser">Pilih</a>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 20px">
                                        <ul class="list-group">
                                            @foreach($data->getLicenseStudyProgram() as $lp)
                                                <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="{{ $lp->getLicense()->getId() }}">
                                                    <span class="name">{{ $lp->getLicense()->getCode().' '.$lp->getLicense()->getChapter().' - '.$lp->getLicense()->getName() }}</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <span class="help-block">{!! implode('', $errors->get('license')) !!}</span>
                            </div>

                            <div class="box-footer" style="text-align: right;min-height: 50px;">
                                <button class="btn btn-primary pull-right">{{ ucfirst(trans('common.edit')) }}</button>
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
        $('a.btnChooser').live('click', function () {
            var listing = $('.list-group'),
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
    </script>
@endsection
