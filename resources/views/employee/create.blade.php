@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.employee')) }}</h1>
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

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ ucfirst(trans('common.email')) }} :</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                                <label for="identity_number">{{ ucwords(trans('common.identity_number')) }} :</label>
                                <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ old('identity_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('identity_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label for="gender">{{ ucwords(trans('common.gender')) }} :</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="{{ \App\Entities\Employee::GENDER_MALE }}" {{ old('gender') == \App\Entities\Employee::GENDER_MALE ? 'selected' : '' }}>{{ ucfirst(trans('common.male')) }}</option>
                                    <option value="{{ \App\Entities\Employee::GENDER_FEMALE }}" {{ old('gender') == \App\Entities\Employee::GENDER_FEMALE ? 'selected' : '' }}>{{ ucfirst(trans('common.female')) }}</option>
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('gender')) !!}</span>
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

                            <div class="form-group {{ $errors->has('language') ? 'has-error' : '' }}">
                                <label for="language">{{ ucfirst(trans('common.language')) }} :</label>
                                <input type="text" class="form-control" id="language" name="language" value="{{ old('language') }}">
                                <span class="help-block ">{!! implode('', $errors->get('language')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                                <label for="nationality">{{ ucfirst(trans('common.nationality')) }} :</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality') }}">
                                <span class="help-block ">{!! implode('', $errors->get('nationality')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('degree') ? 'has-error' : '' }}">
                                <label for="degree">{{ ucfirst(trans('common.degree')) }} :</label>
                                <input type="text" class="form-control" id="degree" name="degree" value="{{ old('degree') }}">
                                <span class="help-block ">{!! implode('', $errors->get('degree')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('education_level') ? 'has-error' : '' }}">
                                <label for="education_level">{{ ucwords(trans('common.education_level')) }} :</label>
                                <input type="text" class="form-control" id="education_level" name="education_level" value="{{ old('education_level') }}">
                                <span class="help-block ">{!! implode('', $errors->get('education_level')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                <label for="location">{{ ucfirst(trans('common.location')) }} :</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                                <span class="help-block ">{!! implode('', $errors->get('location')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                                <label for="duration">{{ ucfirst(trans('common.duration')) }} :</label>
                                <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration') }}">
                                <span class="help-block ">{!! implode('', $errors->get('duration')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('major') ? 'has-error' : '' }}">
                                <label for="major">{{ ucfirst(trans('common.major')) }} :</label>
                                <input type="text" class="form-control" id="major" name="major" value="{{ old('major') }}">
                                <span class="help-block ">{!! implode('', $errors->get('major')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                <label for="phone_number">{{ ucfirst(trans('common.phone_number')) }} :</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('phone_number')) !!}</span>
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
