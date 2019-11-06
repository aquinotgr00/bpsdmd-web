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

                            <div class="form-group {{ $errors->has('id_dikti') ? 'has-error' : '' }}">
                                <label for="id_dikti">{{ strtoupper(trans('common.id_dikti')) }} :</label>
                                <input type="text" class="form-control" id="id_dikti" name="id_dikti" value="{{ $data->getIdDikti() }}">
                                <span class="help-block ">{!! implode('', $errors->get('id_dikti')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                <label for="code">{{ ucfirst(trans('common.code')) }} :</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $data->getCode() }}">
                                <span class="help-block">{!! implode('', $errors->get('code')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nim') ? 'has-error' : '' }}">
                                <label for="nim">{{ strtoupper(trans('common.nim')) }} :</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="{{ $data->getNim() }}">
                                <span class="help-block ">{!! implode('', $errors->get('nim')) !!}</span>
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

                            <div class="form-group {{ $errors->has('placeOfBirth') ? 'has-error' : '' }}">
                                <label for="placeOfBirth">{{ ucwords(trans('common.place_of_birth')) }} :</label>
                                <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" value="{{  $data->getPlaceOfBirth() }}">
                                <span class="help-block ">{!! implode('', $errors->get('placeOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="date form-control" id="dateOfBirth" name="dateOfBirth" value="{{ $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d-m-Y') : '' }}">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ ucfirst(trans('common.address')) }} :</label>
                                <textarea id="address" name="address" class="form-control" rows="5">{{ $data->getAddress() }}</textarea>
                                <span class="help-block">{!! implode('', $errors->get('address')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                <label for="phone_number">{{ ucwords(trans('common.phone_number')) }} :</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $data->getPhoneNumber() }}">
                                <span class="help-block ">{!! implode('', $errors->get('phone_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('mobile_phone_number') ? 'has-error' : '' }}">
                                <label for="mobile_phone_number">{{ ucwords(trans('common.mobile_phone_number')) }} :</label>
                                <input type="text" class="form-control" id="mobile_phone_number" name="mobile_phone_number" value="{{ $data->getMobilePhoneNumber() }}">
                                <span class="help-block ">{!! implode('', $errors->get('mobile_phone_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ ucwords(trans('common.email')) }} :</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $data->getEmail() }}">
                                <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('religion') ? 'has-error' : '' }}">
                                <label for="religion">{{ ucfirst(trans('common.religion')) }} :</label>
                                <input type="text" class="form-control" id="religion" name="religion" value="{{ $data->getReligion() }}">
                                <span class="help-block ">{!! implode('', $errors->get('religion')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('mother_name') ? 'has-error' : '' }}">
                                <label for="mother_name">{{ ucwords(trans('common.mother_name')) }} :</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ $data->getMotherName() }}">
                                <span class="help-block ">{!! implode('', $errors->get('mother_name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                                <label for="nationality">{{ ucfirst(trans('common.nationality')) }} :</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $data->getNationality() }}">
                                <span class="help-block ">{!! implode('', $errors->get('nationality')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('foreign_citizen') ? 'has-error' : '' }}">
                                <label for="foreign_citizen">{{ strtoupper(trans('common.foreign_citizen')) }} :</label>
                                <input type="text" class="form-control" id="foreign_citizen" name="foreign_citizen" value="{{ $data->getForeignCitizen() }}">
                                <span class="help-block ">{!! implode('', $errors->get('foreign_citizen')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('social_protection_card') ? 'has-error' : '' }}">
                                <label for="social_protection_card">{{ ucwords(trans('common.social_protection_card')) }} :</label>
                                <input type="text" class="form-control" id="social_protection_card" name="social_protection_card" value="{{ $data->getSocialProtectionCard() }}">
                                <span class="help-block ">{!! implode('', $errors->get('social_protection_card')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('occupation_type') ? 'has-error' : '' }}">
                                <label for="occupation_type">{{ ucwords(trans('common.occupation_type')) }} :</label>
                                <input type="text" class="form-control" id="occupation_type" name="occupation_type" value="{{ $data->getOccupationType() }}">
                                <span class="help-block ">{!! implode('', $errors->get('occupation_type')) !!}</span>
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

                            <div class="form-group {{ $errors->has('start_semester') ? 'has-error' : '' }}">
                                <label for="start_semester">{{ ucwords(trans('common.start_semester')) }} :</label>
                                <input type="text" class="form-control" id="start_semester" name="start_semester" value="{{ $data->getStartSemester() }}">
                                <span class="help-block ">{!! implode('', $errors->get('start_semester')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('current_semester') ? 'has-error' : '' }}">
                                <label for="current_semester">{{ ucwords(trans('common.current_semester')) }} :</label>
                                <input type="text" class="form-control" id="current_semester" name="current_semester" value="{{ $data->getCurrentSemester() }}">
                                <span class="help-block ">{!! implode('', $errors->get('current_semester')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('student_credits') ? 'has-error' : '' }}">
                                <label for="student_credits">{{ strtoupper(trans('common.student_credits')) }} :</label>
                                <input type="text" class="form-control" id="student_credits" name="student_credits" value="{{ $data->getStudentCredits() }}">
                                <span class="help-block ">{!! implode('', $errors->get('student_credits')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label for="gender">{{ ucwords(trans('common.gender')) }} :</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="{{ \App\Entities\Student::GENDER_MALE }}" {{ $data->getGender() == \App\Entities\Student::GENDER_MALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Student::GENDER_MALE) }}</option>
                                    <option value="{{ \App\Entities\Student::GENDER_FEMALE }}" {{ $data->getGender() == \App\Entities\Student::GENDER_FEMALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Student::GENDER_FEMALE) }}</option>
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('gender')) !!}</span>
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

                            <div class="form-group {{ $errors->has('certificate_number') ? 'has-error' : '' }}">
                                <label for="certificate_number">{{ ucwords(trans('common.certificate_number')) }} :</label>
                                <input type="text" class="form-control" id="certificate_number" name="certificate_number" value="{{ $data->getCertificateNumber() }}">
                                <span class="help-block ">{!! implode('', $errors->get('certificate_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('enrollment_type') ? 'has-error' : '' }}">
                                <label for="enrollment_type">{{ ucwords(trans('common.enrollment_type')) }} :</label>
                                <input type="text" class="form-control" id="enrollment_type" name="enrollment_type" value="{{ $data->getEnrollmentType() }}">
                                <span class="help-block ">{!! implode('', $errors->get('enrollment_type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('graduation_type') ? 'has-error' : '' }}">
                                <label for="graduation_type">{{ ucwords(trans('common.graduation_type')) }} :</label>
                                <input type="text" class="form-control" id="graduation_type" name="graduation_type" value="{{ $data->getGraduationType() }}">
                                <span class="help-block ">{!! implode('', $errors->get('graduation_type')) !!}</span>
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
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection

