@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.study_program')) }}</h1>
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

                            <div class="form-group {{ $errors->has('id_dikti') ? 'has-error' : '' }}">
                                <label for="id_dikti">{{ strtoupper(trans('common.id_dikti')) }} :</label>
                                <input type="text" class="form-control" id="id_dikti" name="id_dikti" value="{{ old('id_dikti') }}">
                                <span class="help-block ">{!! implode('', $errors->get('id_dikti')) !!}</span>
                            </div>

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

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status">{{ ucfirst(trans('common.status')) }} :</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}">
                                <span class="help-block ">{!! implode('', $errors->get('status')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('vision') ? 'has-error' : '' }}">
                                <label for="vision">{{ ucfirst(trans('common.vision')) }} :</label>
                                <input type="text" class="form-control" id="vision" name="vision" value="{{ old('vision') }}">
                                <span class="help-block ">{!! implode('', $errors->get('vision')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('mission') ? 'has-error' : '' }}">
                                <label for="mission">{{ ucfirst(trans('common.mission')) }} :</label>
                                <input type="text" class="form-control" id="mission" name="mission" value="{{ old('mission') }}">
                                <span class="help-block ">{!! implode('', $errors->get('mission')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('passing_grade_credits') ? 'has-error' : '' }}">
                                <label for="passing_grade_credits">{{ ucwords(trans('common.passing_grade_credits')) }} :</label>
                                <input type="text" class="form-control" id="passing_grade_credits" name="passing_grade_credits" value="{{ old('passing_grade_credits') }}">
                                <span class="help-block ">{!! implode('', $errors->get('passing_grade_credits')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('degree') ? 'has-error' : '' }}">
                                <label for="degree">{{ ucfirst(trans('common.degree')) }} :</label>
                                <select id="degree" name="degree" class="form-control">
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_D1 }}" {{ old('degree') == \App\Entities\StudyProgram::DEGREE_D1 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_D1) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_D2 }}" {{ old('degree') == \App\Entities\StudyProgram::DEGREE_D2 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_D2) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_D3 }}" {{ old('degree') == \App\Entities\StudyProgram::DEGREE_D3 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_D3) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_S1 }}" {{ old('degree') == \App\Entities\StudyProgram::DEGREE_S1 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_S1) }}</option>
                                    <option value="{{ \App\Entities\StudyProgram::DEGREE_S2 }}" {{ old('degree') == \App\Entities\StudyProgram::DEGREE_S2 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\StudyProgram::DEGREE_S2) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('degree')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('est_date') ? 'has-error' : '' }}">
                                <label for="est_date">{{ ucwords(trans('common.est_date')) }} :</label>
                                <input type="text" class="date form-control" id="est_date" name="est_date" value="{{ old('est_date') }}">
                                <span class="help-block ">{!! implode('', $errors->get('est_date')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('letter_of_est') ? 'has-error' : '' }}">
                                <label for="letter_of_est">{{ ucwords(trans('common.letter_of_est')) }} :</label>
                                <input type="text" class="form-control" id="letter_of_est" name="letter_of_est" value="{{ old('letter_of_est') }}">
                                <span class="help-block ">{!! implode('', $errors->get('letter_of_est')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('date_of_est') ? 'has-error' : '' }}">
                                <label for="date_of_est">{{ ucwords(trans('common.date_of_est')) }} :</label>
                                <input type="text" class="date form-control" id="date_of_est" name="date_of_est" value="{{ old('date_of_est') }}">
                                <span class="help-block ">{!! implode('', $errors->get('date_of_est')) !!}</span>
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
                                        <ul class="list-group"></ul>
                                    </div>
                                </div>
                                <span class="help-block">{!! implode('', $errors->get('license')) !!}</span>
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
