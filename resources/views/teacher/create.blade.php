@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.teacher')) }}</h1>
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
                                <input type="text" class="form-control" id="nip" name="nip">
                                <span class="help-block ">{!! implode('', $errors->get('nip')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucfirst(trans('common.name')) }} :</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('front_degree') ? 'has-error' : '' }}">
                                <label for="front_degree">{{ ucwords(trans('common.front_degree')) }} :</label>
                                <input type="text" class="form-control" id="front_degree" name="front_degree">
                                <span class="help-block ">{!! implode('', $errors->get('front_degree')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('back_degree') ? 'has-error' : '' }}">
                                <label for="back_degree">{{ ucwords(trans('common.back_degree')) }} :</label>
                                <input type="text" class="form-control" id="back_degree" name="back_degree">
                                <span class="help-block ">{!! implode('', $errors->get('back_degree')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('dateOfBirth') ? 'has-error' : '' }}">
                                <label for="dateOfBirth">{{ ucwords(trans('common.date_of_birth')) }} :</label>
                                <input type="text" class="date form-control" id="dateOfBirth" name="dateOfBirth">
                                <span class="help-block ">{!! implode('', $errors->get('dateOfBirth')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                                <label for="identity_number">{{ ucwords(trans('common.identity_number')) }} :</label>
                                <input type="text" class="form-control" id="identity_number" name="identity_number">
                                <span class="help-block ">{!! implode('', $errors->get('identity_number')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('nidn') ? 'has-error' : '' }}">
                                <label for="nidn">{{ strtoupper(trans('common.nidn')) }} :</label>
                                <input type="text" class="form-control" id="nidn" name="nidn">
                                <span class="help-block ">{!! implode('', $errors->get('nidn')) !!}</span>
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
