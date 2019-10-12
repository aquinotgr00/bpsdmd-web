@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.employee_certificate')) }}</h1>
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

                            <div class="form-group {{ $errors->has('certificate') ? 'has-error' : '' }}">
                                <label for="certificate">{{ ucfirst(trans('common.certificate')) }}</label>
                                <select class="form-control" id="certificate" name="certificate">
                                    <option value="">{{ ucwords(trans('common.choose_certificate')) }}</option>
                                    @if(!empty($dataCertificate))
                                        @foreach($dataCertificate as $certificate)
                                        <option value="{{ $certificate->getId() }}" {!! old('certificate') == $certificate->getId() ? 'selected':'' !!}>{{ $certificate->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('certificate')) !!}</span>
                            </div>
                            <div class="form-group {{ $errors->has('validityPeriod') ? 'has-error' : '' }}">
                                <label for="validityPeriod">{{ ucwords(trans('common.validity_period')) }} :</label>
                                <input type="text" class="date form-control" id="validityPeriod" name="validityPeriod" value="{{ old('validityPeriod') }}">
                                <span class="help-block">{!! implode('', $errors->get('validityPeriod')) !!}</span>
                            </div>

                            <div class="box-footer" style="text-align: right">
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
