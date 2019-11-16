@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.job_title')) }}</h1>
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
                                <input type="text" class="form-control" id="code" name="code" value="{{ $data->getCode() }}">
                                <span class="help-block">{!! implode('', $errors->get('code')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(trans('common.name')) }} :</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $data->getName() }}">
                                <span class="help-block">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('education_minimal') ? 'has-error' : '' }}">
                                <label for="education_minimal">{{ ucwords(trans('common.education_minimal')) }} :</label>
                                <input type="text" class="form-control" id="education_minimal" name="education_minimal" value="{{ $data->getEducationMinimal() }}">
                                <span class="help-block ">{!! implode('', $errors->get('education_minimal')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gpa_minimal') ? 'has-error' : '' }}">
                                <label for="gpa_minimal">{{ ucwords(trans('common.gpa_minimal')) }} :</label>
                                <input type="text" class="form-control" id="gpa_minimal" name="gpa_minimal" value="{{ $data->getGpaMinimal() }}">
                                <span class="help-block ">{!! implode('', $errors->get('gpa_minimal')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('age_minimal') ? 'has-error' : '' }}">
                                <label for="age_minimal">{{ ucwords(trans('common.age_minimal')) }} :</label>
                                <input type="text" class="form-control" id="age_minimal" name="age_minimal" value="{{ $data->getExperienceMinimal() }}">
                                <span class="help-block ">{!! implode('', $errors->get('age_minimal')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('experience_minimal') ? 'has-error' : '' }}">
                                <label for="experience_minimal">{{ ucwords(trans('common.experience_minimal')) }} :</label>
                                <input type="text" class="form-control" id="experience_minimal" name="experience_minimal" value="{{ $data->getAgeMinimal() }}">
                                <span class="help-block ">{!! implode('', $errors->get('experience_minimal')) !!}</span>
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

