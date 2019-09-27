@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Tambah Program Studi</h1>
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
                                <input id="name" name="name" type="text" class="form-control" placeholder="Nama Program Studi" value="{{ old('name') }}">
                                <span class="help-block">{!! implode('', $errors->get('name')) !!}</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('jenjang') ? 'has-error' : '' }}">
                            <label for="jenjang" class="col-sm-2 control-label">Jenjang</label>
                            <div class="col-sm-10">
                                <input id="jenjang" name="jenjang" type="text" class="form-control" placeholder="Nama Jenjang" value="{{ old('jenjang') }}">
                                <span class="help-block">{!! implode('', $errors->get('jenjang')) !!}</span>
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
