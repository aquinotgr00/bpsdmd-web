@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.license')) }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form method="post">
                            @csrf

                            <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                <label for="code">{{ ucfirst(trans('common.code')) }} :</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                                <span class="help-block ">{!! implode('', $errors->get('code')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('chapter') ? 'has-error' : '' }}">
                                <label for="chapter">{{ ucfirst(trans('common.chapter')) }} :</label>
                                <input type="text" class="form-control" id="chapter" name="chapter" value="{{ old('chapter') }}">
                                <span class="help-block ">{!! implode('', $errors->get('chapter')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(trans('common.name')) }} :</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('moda') ? 'has-error' : '' }}">
                                <label for="moda">{{ ucfirst(trans('common.moda')) }} :</label>
                                <select id="moda" name="moda" class="form-control">
                                    @foreach($moda as $value => $label)
                                        <option value="{{ $value }}" {!! old('moda') == $value ? 'selected':'' !!}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('moda')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('head') ? 'has-error' : '' }}">
                                <label for="head">{{ ucfirst(trans('common.head')) }} :</label>
                                <select id="head" name="head" class="form-control">
                                    @foreach($heads as $value => $label)
                                        <option value="{{ $value }}" {!! old('head') == $value ? 'selected':'' !!}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('head')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('competency') ? 'has-error' : '' }}">
                                <label for="competency">{{ ucfirst(trans('common.competency')) }} :</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="competency" class="form-control">
                                            <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.competency'))])) }}</option>
                                            @if(!empty($competencies))
                                                @foreach($competencies as $competency)
                                                    <option value="{{ $competency->getId() }}" data-id="{{ $competency->getId() }}" data-label="{{ ucfirst($competency->getModa()).' - '.$competency->getName() }}">{{ ucfirst($competency->getModa()).' - '.$competency->getName() }}</option>
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
                                <span class="help-block">{!! implode('', $errors->get('competency')) !!}</span>
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
                input = $(document).find('select#competency option:selected'),
                template = '<li class="list-group-item">\n' +
                    '<input type="hidden" name="competency[]" value="">\n' +
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
                input = $('select#competency');

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
