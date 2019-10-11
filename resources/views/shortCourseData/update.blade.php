@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucwords(trans('common.short_course_data')) }}</h1>
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
                                <input type="text" class="date form-control" id="startDate" name="startDate" value="{{ $data->getStartDate() instanceof \DateTime ? $data->getStartDate()->format('d-m-Y') : '' }}">
                                <span class="help-block ">{!! implode('', $errors->get('startDate')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('endDate') ? 'has-error' : '' }}">
                                <label for="endDate">{{ ucwords(trans('common.end_date')) }} :</label>
                                <input type="text" class="date form-control" id="endDate" name="endDate" value="{{ $data->getEndDate() instanceof \DateTime ? $data->getEndDate()->format('d-m-Y') : '' }}">
                                <span class="help-block ">{!! implode('', $errors->get('endDate')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('totalTarget') ? 'has-error' : '' }}">
                                <label for="totalTarget">{{ ucwords(trans('common.total_target_student')) }} :</label>
                                <input type="text" class="form-control" id="totalTarget" name="totalTarget" value="{{ $data->getTotalTarget() }}">
                                <span class="help-block">{!! implode('', $errors->get('totalTarget')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('totalRealization') ? 'has-error' : '' }}">
                                <label for="totalRealization">{{     ucwords(trans('common.total_realization_student')) }} :</label>
                                <input type="text" class="form-control" id="totalRealization" name="totalRealization" value="{{ $data->getTotalRealization() }}">
                                <span class="help-block">{!! implode('', $errors->get('totalRealization')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('openSk') ? 'has-error' : '' }}">
                                <label for="openSk">{{ ucwords(trans('common.open_sk')) }} :</label>
                                <input type="text" class="form-control" id="openSk" name="openSk" value="{{ $data->getOpenSk() }}">
                                <span class="help-block ">{!! implode('', $errors->get('openSk')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('closeSk') ? 'has-error' : '' }}">
                                <label for="closeSk">{{ ucwords(trans('common.close_sk')) }} :</label>
                                <input type="text" class="form-control" id="closeSk" name="closeSk" value="{{ $data->getCloseSk() }}">
                                <span class="help-block ">{!! implode('', $errors->get('closeSk')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('generation') ? 'has-error' : '' }}">
                                <label for="generation">{{ ucwords(trans('common.generation')) }} :</label>
                                <input type="text" class="form-control" id="generation" name="generation" value="{{ $data->getGeneration() }}">
                                <span class="help-block ">{!! implode('', $errors->get('generation')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                                <label for="year">{{ ucwords(trans('common.year')) }} :</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{ $data->getYear() }}">
                                <span class="help-block ">{!! implode('', $errors->get('year')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('shortCourseTime') ? 'has-error' : '' }}">
                                <label for="shortCourseTime">{{ ucwords(trans('common.short_course_time')) }} :</label>
                                <input type="text" class="form-control" id="shortCourseTime" name="shortCourseTime" value="{{ $data->getShortCourseTime() }}">
                                <span class="help-block ">{!! implode('', $errors->get('shortCourseTime')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('place') ? 'has-error' : '' }}">
                                <label for="place">{{ ucwords(trans('common.place')) }} :</label>
                                <input type="text" class="form-control" id="place" name="place" value="{{ $data->getPlace() }}">
                                <span class="help-block ">{!! implode('', $errors->get('place')) !!}</span>
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
