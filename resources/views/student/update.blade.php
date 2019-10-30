@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.student')) }}</h1>
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

                            <div class="form-group {{ $errors->has('studyProgram') ? 'has-error' : '' }}">
                                <label for="studyProgram">{{ ucwords(trans('common.study_program')) }} :</label>
                                <select class="form-control" id="studyProgram" name="studyProgram">
                                    <option value="">{{ ucwords(trans('common.choose_program')) }}</option>
                                    @if(!empty($dataStudyProgram))
                                        @foreach($dataStudyProgram as $studyProgram)
                                        <option value="{{ $studyProgram->getId() }}" {!! $data->getStudyProgram() ? ($data->getStudyProgram()->getId() == $studyProgram->getId() ? 'selected':'') : '' !!}>{{ $studyProgram->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('studyProgram')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('period') ? 'has-error' : '' }}">
                                <label for="period">{{ ucwords(trans('common.period')) }} :</label>
                                <input type="text" class="form-control" id="period" name="period" value="{{ $data->getPeriod() }}">
                                <span class="help-block ">{!! implode('', $errors->get('period')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('curriculum') ? 'has-error' : '' }}">
                                <label for="curriculum">{{ ucwords(trans('common.curriculum')) }} :</label>
                                <input type="text" class="form-control" id="curriculum" name="curriculum" value="{{ $data->getCurriculum() }}">
                                <span class="help-block ">{!! implode('', $errors->get('curriculum')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                                <label for="identity_number">{{ ucwords(trans('common.identity_number')) }} :</label>
                                <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ $data->getIdentityNumber() }}">
                                <span class="help-block ">{!! implode('', $errors->get('identity_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label for="gender">{{ ucwords(trans('common.gender')) }} :</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="{{ \App\Entities\Student::GENDER_MALE }}" {{ $data->getGender() == \App\Entities\Student::GENDER_MALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Student::GENDER_MALE) }}</option>
                                    <option value="{{ \App\Entities\Student::GENDER_FEMALE }}" {{ $data->getGender() == \App\Entities\Student::GENDER_FEMALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Student::GENDER_FEMALE) }}</option>
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('gender')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="date form-control" id="dateOfBirth" name="dateOfBirth" value="{{ $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d-m-Y') : '' }}">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('class') ? 'has-error' : '' }}">
                                <label for="class">{{ ucfirst(trans('common.class')) }} :</label>
                                <input type="text" class="form-control" id="class" name="class" value="{{ $data->getClass() }}">
                                <span class="help-block ">{!! implode('', $errors->get('class')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('ipk') ? 'has-error' : '' }}">
                                <label for="ipk">{{ strtoupper(trans('common.ipk')) }} :</label>
                                <input type="text" class="form-control" id="ipk" name="ipk" value="{{ $data->getIpk() }}">
                                <span class="help-block ">{!! implode('', $errors->get('ipk')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status">{{ ucwords(trans('common.status')) }} :</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ $data->getStatus() }}">
                                <span class="help-block ">{!! implode('', $errors->get('status')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('graduationYear') ? 'has-error' : '' }}">
                                <label for="graduationYear">{{ ucwords(trans('common.graduation_year')) }} :</label>
                                <input type="text" class="form-control" id="graduationYear" name="graduationYear" value="{{ $data->getGraduationYear() }}">
                                <span class="help-block ">{!! implode('', $errors->get('graduationYear')) !!}</span>
                            </div>

                            <div class="input-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                <img src="">
                                <div class="input-group-prepend">
                                    <label class="custom-file-label" for="inputGroupFile01">{{ ucfirst(trans('common.photo')) }}</label>
                                    <span class="help-block">{{ trans('common.allowed_photo') }}</span>
                                    <span class="help-block">{{ __('common.max_photo', ['max' => '500KB']) }}</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01" name="photo">
                                    <span class="help-block ">{!! implode('', $errors->get('photo')) !!}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <img src="{{ $data->getPhoto() ? url(\App\Entities\Student::UPLOAD_PATH.'/'.$data->getPhoto()) : url('img/avatar.png') }}" width="100px" height="100px">
                            </div>

                            <div class="box-footer">
                                <button class="btn btn-primary pull-right">{{ ucfirst(trans('common.edit')) }}</button>
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

