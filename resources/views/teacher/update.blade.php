@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.edit')) }} {{ ucfirst(trans('common.teacher')) }}</h1>
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

                            <div class="form-group {{ $errors->has('nip') ? 'has-error' : '' }}">
                                <label for="nip">{{ strtoupper(trans('common.nip')) }} :</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="{{ $data->getNip() }}">
                                <span class="help-block">{!! implode('', $errors->get('nip')) !!}</span>
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

                            <div class="form-group {{ $errors->has('front_degree') ? 'has-error' : '' }}">
                                <label for="front_degree">{{ ucwords(trans('common.front_degree')) }} :</label>
                                <input type="text" class="form-control" id="front_degree" name="front_degree" value="{{ $data->getFrontDegree() }}">
                                <span class="help-block ">{!! implode('', $errors->get('front_degree')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('back_degree') ? 'has-error' : '' }}">
                                <label for="back_degree">{{ ucwords(trans('common.back_degree')) }} :</label>
                                <input type="text" class="form-control" id="back_degree" name="back_degree" value="{{ $data->getBackDegree() }}">
                                <span class="help-block ">{!! implode('', $errors->get('back_degree')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="form-control" id="dateOfBirth" name="dateOfBirth" value="{{ $data->getDateOfBirth() }}">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                                <label for="identity_number">{{ ucwords(trans('common.identity_number')) }} :</label>
                                <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ $data->getIdentityNumber() }}">
                                <span class="help-block ">{!! implode('', $errors->get('class')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nidn') ? 'has-error' : '' }}">
                                <label for="nidn">{{ strtoupper(trans('common.nidn')) }} :</label>
                                <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $data->getNidn() }}">
                                <span class="help-block ">{!! implode('', $errors->get('nidn')) !!}</span>
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
