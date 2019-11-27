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

                            <div class="form-group {{ $errors->has('id_dikti') ? 'has-error' : '' }}">
                                <label for="id_dikti">{{ strtoupper(trans('common.id_dikti')) }} :</label>
                                <input type="text" class="form-control" id="id_dikti" name="id_dikti" value="{{ old('id_dikti') }}">
                                <span class="help-block ">{!! implode('', $errors->get('id_dikti')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nim') ? 'has-error' : '' }}">
                                <label for="nim">{{ strtoupper(trans('common.nim')) }} :</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim') }}">
                                <span class="help-block ">{!! implode('', $errors->get('nim')) !!}</span>
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

                            <div class="form-group {{ $errors->has('place_of_birth') ? 'has-error' : '' }}">
                                <label for="place_of_birth">{{ ucwords(trans('common.place_of_birth')) }} :</label>
                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') }}">
                                <span class="help-block ">{!! implode('', $errors->get('place_of_birth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="date form-control" id="dateOfBirth" name="dateOfBirth" value="{{ old('dateOfBirth') }}">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ ucfirst(trans('common.address')) }} :</label>
                                <textarea class="form-control" id="address" name="address" rows="5">{{ old('address') }}</textarea>
                                <span class="help-block">{!! implode('', $errors->get('address')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                <label for="phone_number">{{ ucwords(trans('common.phone_number')) }} :</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('phone_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('mobile_phone_number') ? 'has-error' : '' }}">
                                <label for="mobile_phone_number">{{ ucwords(trans('common.mobile_phone_number')) }} :</label>
                                <input type="text" class="form-control" id="mobile_phone_number" name="mobile_phone_number" value="{{ old('mobile_phone_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('mobile_phone_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ ucwords(trans('common.email')) }} :</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('religion') ? 'has-error' : '' }}">
                                <label for="religion">{{ ucfirst(trans('common.religion')) }} :</label>
                                <input type="text" class="form-control" id="religion" name="religion" value="{{ old('religion') }}">
                                <span class="help-block ">{!! implode('', $errors->get('religion')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('mother_name') ? 'has-error' : '' }}">
                                <label for="mother_name">{{ ucwords(trans('common.mother_name')) }} :</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ old('mother_name') }}">
                                <span class="help-block ">{!! implode('', $errors->get('mother_name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                                <label for="nationality">{{ ucfirst(trans('common.nationality')) }} :</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality') }}">
                                <span class="help-block ">{!! implode('', $errors->get('nationality')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('foreign_citizen') ? 'has-error' : '' }}">
                                <label for="foreign_citizen">
                                    {{ ucwords(trans('common.foreign_citizen')) }} :
                                </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="foreign_citizen" value="t" checked> {{ ucfirst(trans('common.yes')) }}
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="foreign_citizen" value="f"> {{ ucfirst(trans('common.no')) }}
                                    </label>
                                </div>
                                <span class="help-block ">{!! implode('', $errors->get('foreign_citizen')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('social_protection_card') ? 'has-error' : '' }}">
                                <label for="social_protection_card">
                                    {{ ucwords(trans('common.social_protection_card')) }} :
                                </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="social_protection_card" value="t" checked> {{ ucfirst(trans('common.yes')) }}
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="social_protection_card" value="f"> {{ ucfirst(trans('common.no')) }}
                                    </label>
                                </div>
                                <span class="help-block ">{!! implode('', $errors->get('social_protection_card')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('occupation_type') ? 'has-error' : '' }}">
                                <label for="occupation_type">{{ ucwords(trans('common.occupation_type')) }} :</label>
                                <input type="text" class="form-control" id="occupation_type" name="occupation_type" value="{{ old('occupation_type') }}">
                                <span class="help-block ">{!! implode('', $errors->get('occupation_type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('period') ? 'has-error' : '' }}">
                                <label for="period">{{ ucwords(trans('common.period')) }} :</label>
                                <input type="text" class="form-control" id="period" name="period" value="{{ old('period') }}">
                                <span class="help-block ">{!! implode('', $errors->get('period')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('curriculum') ? 'has-error' : '' }}">
                                <label for="curriculum">{{ ucwords(trans('common.curriculum')) }} :</label>
                                <input type="text" class="form-control" id="curriculum" name="curriculum" value="{{ old('curriculum') }}">
                                <span class="help-block ">{!! implode('', $errors->get('curriculum')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                                <label for="identity_number">{{ ucwords(trans('common.identity_number')) }} :</label>
                                <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ old('identity_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('identity_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('enrollment_date_start') ? 'has-error' : '' }}">
                                <label for="enrollment_date_start">{{ ucwords(trans('common.enrollment_date_start')) }} :</label>
                                <input type="text" class="date form-control" id="enrollment_date_start" name="enrollment_date_start" value="{{ old('enrollment_date_start') }}">
                                <span class="help-block ">{!! implode('', $errors->get('enrollment_date_start')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('enrollment_date_end') ? 'has-error' : '' }}">
                                <label for="enrollment_date_end">{{ ucwords(trans('common.enrollment_date_end')) }} :</label>
                                <input type="text" class="date form-control" id="enrollment_date_end" name="enrollment_date_end" value="{{ old('enrollment_date_end') }}">
                                <span class="help-block ">{!! implode('', $errors->get('enrollment_date_end')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('start_semester') ? 'has-error' : '' }}">
                                <label for="start_semester">{{ ucwords(trans('common.start_semester')) }} :</label>
                                <input type="text" class="form-control" id="start_semester" name="start_semester" value="{{ old('start_semester') }}">
                                <span class="help-block ">{!! implode('', $errors->get('start_semester')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('current_semester') ? 'has-error' : '' }}">
                                <label for="current_semester">{{ ucwords(trans('common.current_semester')) }} :</label>
                                <input type="text" class="form-control" id="current_semester" name="current_semester" value="{{ old('current_semester') }}">
                                <span class="help-block ">{!! implode('', $errors->get('current_semester')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('student_credits') ? 'has-error' : '' }}">
                                <label for="student_credits">{{ strtoupper(trans('common.student_credits')) }} :</label>
                                <input type="text" class="form-control" id="student_credits" name="student_credits" value="{{ old('student_credits') }}">
                                <span class="help-block ">{!! implode('', $errors->get('student_credits')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label for="gender">{{ ucwords(trans('common.gender')) }} :</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="{{ \App\Entities\Student::GENDER_MALE }}" {{ old('gender') == \App\Entities\Student::GENDER_MALE ? 'selected' : '' }}>{{ ucfirst(trans('common.male')) }}</option>
                                    <option value="{{ \App\Entities\Student::GENDER_FEMALE }}" {{ old('gender') == \App\Entities\Student::GENDER_FEMALE ? 'selected' : '' }}>{{ ucfirst(trans('common.female')) }}</option>
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('gender')) !!}</span>
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

                            <div class="form-group {{ $errors->has('certificate_number') ? 'has-error' : '' }}">
                                <label for="certificate_number">{{ ucwords(trans('common.certificate_number')) }} :</label>
                                <input type="text" class="form-control" id="certificate_number" name="certificate_number" value="{{ old('certificate_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('certificate_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('graduation_judgement_date') ? 'has-error' : '' }}">
                                <label for="graduation_judgement_date">{{ ucwords(trans('common.graduation_judgement_date')) }} :</label>
                                <input type="text" class="date form-control" id="graduation_judgement_date" name="graduation_judgement_date" value="{{ old('graduation_judgement_date') }}">
                                <span class="help-block ">{!! implode('', $errors->get('graduation_judgement_date')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('enrollment_type') ? 'has-error' : '' }}">
                                <label for="enrollment_type">{{ ucwords(trans('common.enrollment_type')) }} :</label>
                                <input type="text" class="form-control" id="enrollment_type" name="enrollment_type" value="{{ old('enrollment_type') }}">
                                <span class="help-block ">{!! implode('', $errors->get('enrollment_type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('graduation_type') ? 'has-error' : '' }}">
                                <label for="graduation_type">{{ ucwords(trans('common.graduation_type')) }} :</label>
                                <input type="text" class="form-control" id="graduation_type" name="graduation_type" value="{{ old('graduation_type') }}">
                                <span class="help-block ">{!! implode('', $errors->get('graduation_type')) !!}</span>
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
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
