@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucwords(trans('common.employee_certificate')) }}</h1>
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

                            <div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
                                <label for="employee">{{ ucfirst(trans('common.employee')) }}</label>
                                <select class="form-control" id="employee" name="employee">
                                    <option value="">{{ ucwords(trans('common.choose_employee')) }}</option>
                                    @if(!empty($dataEmployee))
                                        @foreach($dataEmployee as $employee)
                                        <option value="{{ $employee->getId() }}" {!! $data->getEmployee()->getId() == $employee->getId() ? 'selected':'' !!}>{{ $employee->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('employee')) !!}</span>
                            </div>
                            <div class="form-group {{ $errors->has('certificate') ? 'has-error' : '' }}">
                                <label for="certificate">{{ ucfirst(trans('common.certificate')) }}</label>
                                <select class="form-control" id="certificate" name="certificate">
                                    <option value="">{{ ucwords(trans('common.choose_school')) }}</option>
                                    @if(!empty($dataCertificate))
                                        @foreach($dataCertificate as $certificate)
                                        <option value="{{ $certificate->getId() }}" {!! $data->getCertificate()->getId() == $certificate->getId() ? 'selected':'' !!}>{{ $certificate->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('certificate')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('validityPeriod') ? 'has-error' : '' }}">
                                <label for="validityPeriod">{{ ucwords(trans('common.validity_period')) }} :</label>
                                <input type="text" class="form-control" id="validityPeriod" name="validityPeriod" value="{{ $data->getValidityPeriod() ? $data->getValidityPeriod() : '' }}">
                                <span class="help-block">{!! implode('', $errors->get('validityPeriod')) !!}</span>
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

