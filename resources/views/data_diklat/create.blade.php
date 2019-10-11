@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.data_diklat')) }}</h1>
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

                            <div class="form-group {{ $errors->has('startDate') ? 'has-error' : '' }}">
                                <label for="startDate">{{ ucwords(trans('common.start_date')) }} :</label>
                                <input type="text" class="date form-control" id="startDate" name="startDate">
                                <span class="help-block ">{!! implode('', $errors->get('startDate')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('endDate') ? 'has-error' : '' }}">
                                <label for="endDate">{{ ucwords(trans('common.end_date')) }} :</label>
                                <input type="text" class="date form-control" id="endDate" name="endDate">
                                <span class="help-block ">{!! implode('', $errors->get('endDate')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('totalTarget') ? 'has-error' : '' }}">
                                <label for="totalTarget">{{ ucwords(trans('common.total_target_student')) }} :</label>
                                <input type="text" class="form-control" id="totalTarget" name="totalTarget">
                                <span class="help-block">{!! implode('', $errors->get('totalTarget')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('totalRealization') ? 'has-error' : '' }}">
                                <label for="totalRealization">{{ ucwords(trans('common.total_realization_student')) }} :</label>
                                <input type="text" class="form-control" id="totalRealization" name="totalRealization">
                                <span class="help-block">{!! implode('', $errors->get('totalRealization')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('requirement') ? 'has-error' : '' }}">
                                <label for="requirement">{{ ucwords(trans('common.requirement_student')) }} :</label>
                                <input type="text" class="form-control" id="requirement" name="requirement">
                                <span class="help-block ">{!! implode('', $errors->get('requirement')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('target') ? 'has-error' : '' }}">
                                <label for="target">{{ ucwords(trans('common.target_student')) }} :</label>
                                <input type="text" class="form-control" id="target" name="target">
                                <span class="help-block ">{!! implode('', $errors->get('target')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('outputDiklat') ? 'has-error' : '' }}">
                                <label for="outputDiklat">{{ ucwords(trans('common.output_diklat')) }} :</label>
                                <input type="text" class="form-control" id="outputDiklat" name="outputDiklat">
                                <span class="help-block ">{!! implode('', $errors->get('outputDiklat')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('outcomeDiklat') ? 'has-error' : '' }}">
                                <label for="outcomeDiklat">{{ ucwords(trans('common.outcome_diklat')) }} :</label>
                                <input type="text" class="form-control" id="outcomeDiklat" name="outcomeDiklat">
                                <span class="help-block ">{!! implode('', $errors->get('outcomeDiklat')) !!}</span>
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
