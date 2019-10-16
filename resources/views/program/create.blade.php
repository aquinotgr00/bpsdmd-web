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

                            <div class="box-footer" style="text-align: right">
                                <button class="btn btn-primary pull-right">{{ ucfirst(trans('common.add')) }}</button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
