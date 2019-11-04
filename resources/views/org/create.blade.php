@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.institute')) }}</h1>
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

                            <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                                <label for="short_name">{{ ucwords(trans('common.short_name')) }} :</label>
                                <input type="text" class="form-control" id="short_name" name="short_name" value="{{ old('short_name') }}">
                                <span class="help-block ">{!! implode('', $errors->get('short_name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('letter_of_est') ? 'has-error' : '' }}">
                                <label for="letter_of_est">{{ ucwords(trans('common.letter_of_est')) }} :</label>
                                <input type="text" class="form-control" id="letter_of_est" name="letter_of_est" value="{{ old('letter_of_est') }}">
                                <span class="help-block ">{!! implode('', $errors->get('letter_of_est')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('date_of_est') ? 'has-error' : '' }}">
                                <label for="date_of_est">{{ ucwords(trans('common.date_of_est')) }} :</label>
                                <input type="text" class="date form-control" id="date_of_est" name="date_of_est" value="{{ old('date_of_est') }}">
                                <span class="help-block ">{!! implode('', $errors->get('date_of_est')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('letter_of_opr') ? 'has-error' : '' }}">
                                <label for="letter_of_opr">{{ ucwords(trans('common.letter_of_opr')) }} :</label>
                                <input type="text" class="form-control" id="letter_of_opr" name="letter_of_opr" value="{{ old('letter_of_opr') }}">
                                <span class="help-block ">{!! implode('', $errors->get('letter_of_opr')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('date_of_opr') ? 'has-error' : '' }}">
                                <label for="date_of_opr">{{ ucwords(trans('common.date_of_opr')) }} :</label>
                                <input type="text" class="date form-control" id="date_of_opr" name="date_of_opr" value="{{ old('date_of_opr') }}">
                                <span class="help-block ">{!! implode('', $errors->get('date_of_opr')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status">{{ ucfirst(trans('common.status')) }} :</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}">
                                <span class="help-block ">{!! implode('', $errors->get('status')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">{{ ucfirst(trans('common.type')) }} :</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="{{ \App\Entities\Organization::TYPE_SUPPLY }}" {{ old('type') == \App\Entities\Organization::TYPE_SUPPLY ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_SUPPLY) }}</option>
                                    <option value="{{ \App\Entities\Organization::TYPE_DEMAND }}" {{ old('type') == \App\Entities\Organization::TYPE_DEMAND ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_DEMAND) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('moda') ? 'has-error' : '' }}">
                                <label for="moda">{{ ucfirst(trans('common.moda')) }} :</label>
                                <select id="moda" name="moda" class="form-control">
                                    <option value="{{ \App\Entities\Organization::MODA_LAUT }}" {{ old('moda') == \App\Entities\Organization::MODA_LAUT ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::MODA_LAUT) }}</option>
                                    <option value="{{ \App\Entities\Organization::MODA_UDARA }}" {{ old('moda') == \App\Entities\Organization::MODA_UDARA ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::MODA_UDARA) }}</option>
                                    <option value="{{ \App\Entities\Organization::MODA_DARAT }}" {{ old('moda') == \App\Entities\Organization::MODA_DARAT ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::MODA_DARAT) }}</option>
                                    <option value="{{ \App\Entities\Organization::MODA_KERETA }}" {{ old('moda') == \App\Entities\Organization::MODA_KERETA ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::MODA_KERETA) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('moda')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">{{ ucfirst(trans('common.address')) }} :</label>
                                <textarea class="form-control" id="address" name="address" rows="5">{{ old('address') }}</textarea>
                                <span class="help-block">{!! implode('', $errors->get('address')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">{{ ucfirst(trans('common.description')) }} :</label>
                                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                <span class="help-block">{!! implode('', $errors->get('description')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                <label for="phone_number">{{ ucwords(trans('common.phone_number')) }} :</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                <span class="help-block ">{!! implode('', $errors->get('phone_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('fax') ? 'has-error' : '' }}">
                                <label for="fax">{{ ucfirst(trans('common.fax')) }} :</label>
                                <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax') }}">
                                <span class="help-block ">{!! implode('', $errors->get('fax')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                                <label for="website">{{ ucfirst(trans('common.website')) }} :</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}">
                                <span class="help-block ">{!! implode('', $errors->get('website')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ ucwords(trans('common.email')) }} :</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                <span class="help-block ">{!! implode('', $errors->get('email')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('ownership_status') ? 'has-error' : '' }}">
                                <label for="ownership_status">{{ ucwords(trans('common.ownership_status')) }} :</label>
                                <input type="text" class="form-control" id="ownership_status" name="ownership_status" value="{{ old('ownership_status') }}">
                                <span class="help-block ">{!! implode('', $errors->get('ownership_status')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('under_supervision') ? 'has-error' : '' }}">
                                <label for="under_supervision">{{ ucwords(trans('common.under_supervision')) }} :</label>
                                <input type="text" class="form-control" id="under_supervision" name="under_supervision" value="{{ old('under_supervision') }}">
                                <span class="help-block ">{!! implode('', $errors->get('under_supervision')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('education_type') ? 'has-error' : '' }}">
                                <label for="education_type">{{ ucwords(trans('common.education_type')) }} :</label>
                                <input type="text" class="form-control" id="education_type" name="education_type" value="{{ old('education_type') }}">
                                <span class="help-block ">{!! implode('', $errors->get('education_type')) !!}</span>
                            </div>

                            <div class="form-group accreditation {{ $errors->has('accreditation') ? 'has-error' : '' }}">
                                <label for="accreditation">{{ ucfirst(trans('common.accreditation')) }} :</label>
                                <select id="accreditation" name="accreditation" class="form-control">
                                    <option value="{{ \App\Entities\Organization::ACCREDITATION_A }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_A ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_A) }}</option>
                                    <option value="{{ \App\Entities\Organization::ACCREDITATION_B }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_B ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_B) }}</option>
                                    <option value="{{ \App\Entities\Organization::ACCREDITATION_C }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_C ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_C) }}</option>
                                    <option value="{{ \App\Entities\Organization::ACCREDITATION_NA }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_NA ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_NA) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('accreditation')) !!}</span>
                            </div>

                            <div class="input-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                <div class="input-group-prepend">
                                    <label class="custom-file-label" for="inputGroupFile01">{{ ucfirst(trans('common.logo')) }}</label>
                                    <span class="help-block">{{ trans('common.allowed_photo') }}</span>
                                    <span class="help-block">{{ __('common.max_photo', ['max' => '500KB']) }}</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo">
                                    <span class="help-block ">{!! implode('', $errors->get('photo')) !!}</span>
                                </div>
                            </div>

                            <div class="box-footer" style="text-align: right">
                                <button class="btn btn-primary pull-right">{{ ucfirst(trans('common.add')) }}</button>
                            </div>
                            <script type="text/javascript">
                                $(function(){
                                    $('#type').change(function(){
                                        var value = $(this).val();
                                        if(value == "<?= \App\Entities\Organization::TYPE_SUPPLY ?>"){
                                            $('.accreditation').show();
                                        }else{
                                            $('.accreditation').hide();
                                        }
                                    });

                                    $('#type').change();
                                });
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