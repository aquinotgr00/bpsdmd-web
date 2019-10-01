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
                    <form class="form-horizontal" method="post">
                    @csrf

                        <div class="box-body">
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
                                <span class="help-block">{!! implode('', $errors->get('moda')) !!}</span>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary pull-right">{{ ucfirst(trans('common.edit')) }}</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
