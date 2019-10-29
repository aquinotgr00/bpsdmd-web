@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucwords(trans('common.competency')) }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form method="post">
                            @csrf

                            <div class="form-group {{ $errors->has('moda') ? 'has-error' : '' }}">
                                <label for="moda">{{ ucfirst(trans('common.moda')) }} :</label>
                                <select id="moda" name="moda" class="form-control">
                                    <option value="{{ \App\Entities\Competency::MODA_LAUT }}" {{ $competency->getModa() == \App\Entities\Competency::MODA_LAUT ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Competency::MODA_LAUT) }}</option>
                                    <option value="{{ \App\Entities\Competency::MODA_UDARA }}" {{ $competency->getModa() == \App\Entities\Competency::MODA_UDARA ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Competency::MODA_UDARA) }}</option>
                                    <option value="{{ \App\Entities\Competency::MODA_DARAT }}" {{ $competency->getModa() == \App\Entities\Competency::MODA_DARAT ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Competency::MODA_DARAT) }}</option>
                                    <option value="{{ \App\Entities\Competency::MODA_KERETA }}" {{ $competency->getModa() == \App\Entities\Competency::MODA_KERETA ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Competency::MODA_KERETA) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('moda')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">{{ ucfirst(trans('common.type')) }} :</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="{{ \App\Entities\Competency::TYPE_PM7 }}" {{ $competency->getType() == \App\Entities\Competency::TYPE_PM7 ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Competency::TYPE_PM7) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('ckf') ? 'has-error' : '' }}">
                                <label for="ckf">{{ ucfirst(trans('common.competency_key_function')) }}</label>
                                <select class="form-control" id="ckf" name="ckf">
                                    <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.key_function'))])) }}</option>
                                    @if(!empty($ckf))
                                        @foreach($ckf as $item)
                                            @if ($competency->getCompetencyKeyFunction()->getId() == $item->getId())
                                                <option value="{{ $item->getId() }}" selected>{{ $item->getKeyFunction() }}</option>
                                            @else
                                                <option value="{{ $item->getId() }}">{{ $item->getKeyFunction() }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('ckf')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('cmf') ? 'has-error' : '' }}">
                                <label for="cmf">{{ ucfirst(trans('common.main_function')) }}</label>
                                <select class="form-control" id="cmf" name="cmf">
                                    <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.main_function'))])) }}</option>
                                    @if(!empty($cmf))
                                        @foreach($cmf as $item)
                                            @if ($competency->getCompetencyMainFunction()->getId() == $item->getId())
                                                <option value="{{ $item->getId() }}" selected>{{ $item->getMainFunction() }}</option>
                                            @else
                                                <option value="{{ $item->getId() }}">{{ $item->getMainFunction() }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('cmf')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('cmp') ? 'has-error' : '' }}">
                                <label for="cmp">{{ ucfirst(trans('common.main_purpose')) }}</label>
                                <select class="form-control" id="cmp" name="cmp">
                                    <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.competency_unit'))])) }}</option>
                                    @if(!empty($cmp))
                                        @foreach($cmp as $item)
                                            @if ($competency->getCompetencyMainPurpose()->getId() == $item->getId())
                                                <option value="{{ $item->getId() }}" selected>{{ $item->getMainPurpose() }}</option>
                                            @else
                                                <option value="{{ $item->getId() }}">{{ $item->getMainPurpose() }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('cmp')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('cu') ? 'has-error' : '' }}">
                                <label for="cu">{{ ucfirst(trans('common.unit')) }}</label>
                                <select class="form-control" id="cu" name="cu">
                                    <option value="">{{ ucfirst(trans('common.please_choose', ['object' => ucwords(trans('common.unit'))])) }}</option>
                                    @if(!empty($cu))
                                        @foreach($cu as $item)
                                            @if ($competency->getCompetencyUnit()->getId() == $item->getId())
                                                <option value="{{ $item->getId() }}" selected>{{ $item->getUnit() }}</option>
                                            @else
                                                <option value="{{ $item->getId() }}">{{ $item->getUnit() }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('cu')) !!}</span>
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
