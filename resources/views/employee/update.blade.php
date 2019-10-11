@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.employee')) }}</h1>
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

                            <div class="form-group {{ $errors->has('school') ? 'has-error' : '' }}">
                                <label for="school">{{ ucfirst(trans('common.school')) }}</label>
                                <select class="form-control" id="school" name="school">
                                    <option value="">{{ ucwords(trans('common.choose_school')) }}</option>
                                    @if(!empty($dataSchool))
                                        @foreach($dataSchool as $school)
                                        <option value="{{ $school->getId() }}" {!! $data->getSchool()->getId() == $school->getId() ? 'selected':'' !!}>{{ $school->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('school')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                                <label for="identity_number">{{ ucwords(trans('common.identity_number')) }} :</label>
                                <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ $data->getIdentityNumber() }}">
                                <span class="help-block ">{!! implode('', $errors->get('identity_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                <label for="gender">{{ ucwords(trans('common.gender')) }} :</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="{{ \App\Entities\Employee::GENDER_MALE }}" {{ $data->getGender() == \App\Entities\Employee::GENDER_MALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Employee::GENDER_MALE) }}</option>
                                    <option value="{{ \App\Entities\Employee::GENDER_FEMALE }}" {{ $data->getGender() == \App\Entities\Employee::GENDER_FEMALE ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Employee::GENDER_FEMALE) }}</option>
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('gender')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('placeOfBirth') ? 'has-error' : '' }}">
                                <label for="placeOfBirth">{{ ucwords(trans('common.place_of_birth')) }} :</label>
                                <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" value="{{ $data->getPlaceOfBirth() }}">
                                <span class="help-block ">{!! implode('', $errors->get('placeOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="date form-control" id="dateOfBirth" name="dateOfBirth" value="{{ $data->getDateOfBirth() instanceof \DateTime ? $data->getDateOfBirth()->format('d-m-Y') : '' }}">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('language') ? 'has-error' : '' }}">
                                <label for="language">{{ ucfirst(trans('common.language')) }} :</label>
                                <input type="text" class="form-control" id="language" name="language" value="{{ $data->getLanguage() }}">
                                <span class="help-block ">{!! implode('', $errors->get('language')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                                <label for="nationality">{{ ucfirst(trans('common.nationality')) }} :</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $data->getNationality() }}">
                                <span class="help-block ">{!! implode('', $errors->get('nationality')) !!}</span>
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
                                <img src="{{ $data->getPhoto() ? url(\App\Entities\Employee::UPLOAD_PATH.'/'.$data->getPhoto()) : url('img/avatar.png') }}" width="100px" height="100px">
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

