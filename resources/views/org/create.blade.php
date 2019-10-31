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
                                <label for="short_name">{{ ucfirst(trans('common.short_name')) }} :</label>
                                <input type="text" class="form-control" id="short_name" name="short_name" value="{{ old('short_name') }}">
                                <span class="help-block ">{!! implode('', $errors->get('short_name')) !!}</span>
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

                            <div class="form-group {{ $errors->has('accreditation') ? 'has-error' : '' }}">
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
