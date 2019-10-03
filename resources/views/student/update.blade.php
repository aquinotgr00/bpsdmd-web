@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.institute')) }}</h1>
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

                            <div class="form-group {{ $errors->has('org') ? 'has-error' : '' }}">
                                <label for="org">{{ ucfirst(trans('common.institute')) }}</label>
                                <select class="form-control" id="org" name="org">
                                    <option value="">{{ ucwords(trans('common.choose_institute')) }}</option>
                                    @if(!empty($dataOrg))
                                        @foreach($dataOrg as $org)
                                        <option value="{{ $org->getId() }}" {!! $data->getOrg()->getId() == $org->getId() ? 'selected':'' !!}>{{ $org->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('org')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('studyProgram') ? 'has-error' : '' }}">
                                <label for="studyProgram">{{ ucwords(trans('common.study_program')) }} :</label>
                                <select class="form-control" id="studyProgram" name="studyProgram">
                                    <option value="">{{ ucwords(trans('common.choose_program')) }}</option>
                                    @if(!empty($dataStudyProgram))
                                        @foreach($dataStudyProgram as $studyProgram)
                                        <option value="{{ $studyProgram->getId() }}" {!! $data->getStudyProgram()->getId() == $studyProgram->getId() ? 'selected':'' !!}>{{ $studyProgram->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('studyProgram')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('period') ? 'has-error' : '' }}">
                                <label for="period">{{ ucfirst(trans('common.period')) }} :</label>
                                <input type="text" class="form-control" id="period" name="period" value="{{ $data->getPeriod() }}">
                                <span class="help-block ">{!! implode('', $errors->get('period')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('curriculum') ? 'has-error' : '' }}">
                                <label for="curriculum">{{ ucfirst(trans('common.curriculum')) }} :</label>
                                <input type="text" class="form-control" id="curriculum" name="curriculum" value="{{ $data->getCurriculum() }}">
                                <span class="help-block ">{!! implode('', $errors->get('curriculum')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="form-control" id="dateOfBirth" name="dateOfBirth" value="{{ $data->getDateOfBirth() }}">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('class') ? 'has-error' : '' }}">
                                <label for="class">{{ ucfirst(trans('common.class')) }} :</label>
                                <input type="text" class="form-control" id="class" name="class" value="{{ $data->getClass() }}">
                                <span class="help-block ">{!! implode('', $errors->get('class')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('ipk') ? 'has-error' : '' }}">
                                <label for="ipk">{{ strtoupper(trans('common.ipk')) }} :</label>
                                <input type="text" class="form-control" id="ipk" name="ipk" value="{{ $data->getIpk() }}">
                                <span class="help-block ">{!! implode('', $errors->get('ipk')) !!}</span>
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
