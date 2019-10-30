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
