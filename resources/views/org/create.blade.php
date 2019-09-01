@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Tambah Instansi</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <form class="form-horizontal" method="post">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nama Instansi" value="{{ old('name') }}">
                                <span class="help-block">{!! implode('', $errors->get('name')) !!}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                            <label for="short_name" class="col-sm-2 control-label">Short Name</label>
                            <div class="col-sm-10">
                                <input id="short_name" name="short_name" type="text" class="form-control" placeholder="Nama Pendek" value="{{ old('short_name') }}">
                                <span class="help-block">{!! implode('', $errors->get('short_name')) !!}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label for="type" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                <select id="type" name="type" class="form-control">
                                    <option value="{{ \App\Entities\Organization::TYPE_SUPPLY }}" {{ old('type') == \App\Entities\Organization::TYPE_DEMAND ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_SUPPLY) }}</option>
                                    <option value="{{ \App\Entities\Organization::TYPE_DEMAND }}" {{ old('type') == \App\Entities\Organization::TYPE_DEMAND ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_DEMAND) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('type')) !!}</span>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer" style="text-align: right">
                        <input type="submit" value="Tambah" class="btn btn-primary">
                    </div>
                </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
