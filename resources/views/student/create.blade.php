@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.student')) }}</h1>
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

                            <div class="form-group {{ $errors->has('studyProgram') ? 'has-error' : '' }}">
                                <label for="studyProgram">{{ ucwords(trans('common.study_program')) }} :</label>
                                <select class="form-control" id="studyProgram" name="studyProgram" value="{{ old('studyProgram') }}">
                                    <option value="">{{ ucwords(trans('common.choose_program')) }}</option>
                                    @if(!empty($dataStudyProgram))
                                        @foreach($dataStudyProgram as $studyProgram)
                                        <option value="{{ $studyProgram->getId() }}" {{ old('studyProgram') == $studyProgram->getId() ? 'selected' : '' }}>{{ $studyProgram->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('studyProgram')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('period') ? 'has-error' : '' }}">
                                <label for="period">{{ ucfirst(trans('common.period')) }} :</label>
                                <input type="text" class="form-control" id="period" name="period" value="{{ old('period') }}">
                                <span class="help-block ">{!! implode('', $errors->get('period')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('curriculum') ? 'has-error' : '' }}">
                                <label for="curriculum">{{ ucfirst(trans('common.curriculum')) }} :</label>
                                <input type="text" class="form-control" id="curriculum" name="curriculum" value="{{ old('curriculum') }}">
                                <span class="help-block ">{!! implode('', $errors->get('curriculum')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                                <label for="identity_number">{{ ucwords(trans('common.identity_number')) }} :</label>
                                <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ old('identity_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('identity_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label for="gender">{{ ucwords(trans('common.gender')) }} :</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="{{ \App\Entities\Student::GENDER_MALE }}" {{ old('gender') == \App\Entities\Student::GENDER_MALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Student::GENDER_MALE) }}</option>
                                    <option value="{{ \App\Entities\Student::GENDER_FEMALE }}" {{ old('gender') == \App\Entities\Student::GENDER_FEMALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Student::GENDER_FEMALE) }}</option>
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('gender')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="date form-control" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('class') ? 'has-error' : '' }}">
                                <label for="class">{{ ucfirst(trans('common.class')) }} :</label>
                                <input type="text" class="form-control" id="class" name="class" value="{{ old('class') }}">
                                <span class="help-block ">{!! implode('', $errors->get('class')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('ipk') ? 'has-error' : '' }}">
                                <label for="ipk">{{ strtoupper(trans('common.ipk')) }} :</label>
                                <input type="text" class="form-control" id="ipk" name="ipk" value="{{ old('ipk') }}">
                                <span class="help-block ">{!! implode('', $errors->get('ipk')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status">{{ ucwords(trans('common.status')) }} :</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}">
                                <span class="help-block ">{!! implode('', $errors->get('status')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('graduationYear') ? 'has-error' : '' }}">
                                <label for="graduationYear">{{ ucwords(trans('common.graduation_year')) }} :</label>
                                <input type="text" class="form-control" id="graduationYear" name="graduationYear" value="{{ old('graduationYear') }}">
                                <span class="help-block ">{!! implode('', $errors->get('graduationYear')) !!}</span>
                            </div>

                            <div class="input-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                <div class="input-group-prepend">
                                    <label class="custom-file-label" for="inputGroupFile01">{{ ucfirst(trans('common.photo')) }}</label>
                                    <span class="help-block">{{ trans('common.allowed_photo') }}</span>
                                    <span class="help-block">{{ __('common.max_photo', ['max' => '500KB']) }}</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo">
                                    <span class="help-block ">{!! implode('', $errors->get('photo')) !!}</span>
                                </div>
                            </div>

                            <div class="box-footer" style="text-align: right;min-height: 50px;">
                                <button class="btn btn-primary pull-right">{{ ucfirst(trans('common.add')) }}</button>
                            </div>
                            <script type="text/javascript">
                                $('.date').datepicker({
                                    format: 'dd-mm-yyyy' // HTML 5
                                });
                            </script>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
