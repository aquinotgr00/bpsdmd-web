@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.recruitment')) }}</h1>
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

                            <div class="form-group">
                                <label>{{ ucfirst(trans('common.name')) }} :</label>
                                {{ $data->getStudent() instanceof \App\Entities\Student ? $data->getStudent()->getName() : '-' }}
                            </div>

                            <div class="form-group {{ $errors->has('jobTitle') ? 'has-error' : '' }}">
                                <label for="jobTitle">{{ ucwords(trans('common.job_title')) }} :</label>
                                <select class="form-control" id="jobTitle" name="jobTitle">
                                    <option value="">{{ ucwords(trans('common.choose_job_title')) }}</option>
                                    @if(!empty($dataJobTitle))
                                        @foreach($dataJobTitle as $jobTitle)
                                        <option value="{{ $jobTitle->getId() }}" {!! $data->getJobTitle() ? ($data->getJobTitle()->getId() == $jobTitle->getId() ? 'selected':'') : '' !!}>{{ $jobTitle->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('jobTitle')) !!}</span>
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

