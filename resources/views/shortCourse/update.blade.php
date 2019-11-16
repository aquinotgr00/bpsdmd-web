@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.short_course')) }}</h1>
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
                                        <option value="{{ $org->getId() }}" {!! $data->getOrg() ? ($data->getOrg()->getId() == $org->getId() ? 'selected':''):'' !!}>{{ $org->getName() }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block ">{!! implode('', $errors->get('org')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(trans('common.name')) }} :</label>
                                <input id="name" type="text" name="name" class="form-control" value="{{ $data->getName() }}">
                                <span class="help-block">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">{{ ucfirst(trans('common.type')) }} :</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="{{ \App\Entities\ShortCourse::TYPE_DPM }}" {{ $data->getType() == \App\Entities\ShortCourse::TYPE_DPM ? 'selected' : '' }}>{{ ucfirst(\App\Entities\ShortCourse::TYPE_DPM) }}</option>
                                    <option value="{{ \App\Entities\ShortCourse::TYPE_TEKNIS }}" {{ $data->getType() == \App\Entities\ShortCourse::TYPE_TEKNIS ? 'selected' : '' }}>{{ ucfirst(\App\Entities\ShortCourse::TYPE_TEKNIS) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('type')) !!}</span>
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
