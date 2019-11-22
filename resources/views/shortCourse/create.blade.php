@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.short_course')) }}</h1>
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

                            <div class="form-group {{ $errors->has('org') ? 'has-error' : '' }}">
                                <label for="org">{{ ucwords(trans('common.institute')) }} :</label>
                                <select class="form-control" id="org" name="org">
                                    <option value="">{{ ucwords(trans('common.choose_institute')) }}</option>
                                    @if(!empty($dataOrg))
                                        @foreach($dataOrg as $org)
                                        <option value="{{ $org->getId() }}" {{ old('org') == $org->getId() ? 'selected' : '' }}>{{ $org->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('org')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(trans('common.name')) }} :</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">{{ ucfirst(trans('common.type')) }} :</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="{{ \App\Entities\ShortCourse::TYPE_DPM }}" {{ old('type') == \App\Entities\ShortCourse::TYPE_DPM ? 'selected' : '' }}>{{ ucfirst(\App\Entities\ShortCourse::TYPE_DPM) }}</option>
                                    <option value="{{ \App\Entities\ShortCourse::TYPE_TEKNIS }}" {{ old('type') == \App\Entities\ShortCourse::TYPE_TEKNIS ? 'selected' : '' }}>{{ ucfirst(\App\Entities\ShortCourse::TYPE_TEKNIS) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('startDate') ? 'has-error' : '' }}">
                                <label for="startDate">{{ ucwords(trans('common.start_date')) }} :</label>
                                <input type="text" class="date form-control" id="startDate" name="startDate" value="{{ old('startDate') }}">
                                <span class="help-block ">{!! implode('', $errors->get('startDate')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('endDate') ? 'has-error' : '' }}">
                                <label for="endDate">{{ ucwords(trans('common.end_date')) }} :</label>
                                <input type="text" class="date form-control" id="endDate" name="endDate" value="{{ old('endDate') }}">
                                <span class="help-block ">{!! implode('', $errors->get('endDate')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('totalTarget') ? 'has-error' : '' }}">
                                <label for="totalTarget">{{ ucwords(trans('common.total_target_student')) }} :</label>
                                <input type="text" class="form-control" id="totalTarget" name="totalTarget" value="{{ old('totalTarget') }}">
                                <span class="help-block">{!! implode('', $errors->get('totalTarget')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('totalRealization') ? 'has-error' : '' }}">
                                <label for="totalRealization">{{ ucwords(trans('common.total_realization_student')) }} :</label>
                                <input type="text" class="form-control" id="totalRealization" name="totalRealization" value="{{ old('totalRealization') }}">
                                <span class="help-block">{!! implode('', $errors->get('totalRealization')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('openSk') ? 'has-error' : '' }}">
                                <label for="openSk">{{ ucwords(trans('common.open_sk')) }} :</label>
                                <input type="text" class="form-control" id="openSk" name="openSk" value="{{ old('openSk') }}">
                                <span class="help-block ">{!! implode('', $errors->get('openSk')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('closeSk') ? 'has-error' : '' }}">
                                <label for="closeSk">{{ ucwords(trans('common.close_sk')) }} :</label>
                                <input type="text" class="form-control" id="closeSk" name="closeSk" value="{{ old('closeSk') }}">
                                <span class="help-block ">{!! implode('', $errors->get('closeSk')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('generation') ? 'has-error' : '' }}">
                                <label for="generation">{{ ucwords(trans('common.generation')) }} :</label>
                                <input type="text" class="form-control" id="generation" name="generation" value="{{ old('generation') }}">
                                <span class="help-block ">{!! implode('', $errors->get('generation')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
                                <label for="year">{{ ucwords(trans('common.year')) }} :</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}">
                                <span class="help-block ">{!! implode('', $errors->get('year')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('shortCourseTime') ? 'has-error' : '' }}">
                                <label for="shortCourseTime">{{ ucwords(trans('common.short_course_time')) }} :</label>
                                <input type="number" class="form-control" id="shortCourseTime" name="shortCourseTime" value="{{ old('shortCourseTime') }}">
                                <span class="help-block ">{!! implode('', $errors->get('shortCourseTime')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('place') ? 'has-error' : '' }}">
                                <label for="place">{{ ucwords(trans('common.place')) }} :</label>
                                <input type="text" class="form-control" id="place" name="place" value="{{ old('place') }}">
                                <span class="help-block ">{!! implode('', $errors->get('place')) !!}</span>
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
