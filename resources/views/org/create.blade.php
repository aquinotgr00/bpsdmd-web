@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Tambah Organisasi</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form method="post">
                        @csrf

                            <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                <label for="code">Kode :</label>
                                <input type="text" class="form-control" id="code" name="code">
                                <span class="help-block ">{!! implode('', $errors->get('code')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nama :</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                                <label for="short_name">Nama Pendek :</label>
                                <input type="text" class="form-control" id="short_name" name="short_name">
                                <span class="help-block ">{!! implode('', $errors->get('short_name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">Tipe :</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="{{ \App\Entities\Organization::TYPE_SUPPLY }}" {{ old('type') == \App\Entities\Organization::TYPE_DEMAND ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_SUPPLY) }}</option>
                                    <option value="{{ \App\Entities\Organization::TYPE_DEMAND }}" {{ old('type') == \App\Entities\Organization::TYPE_DEMAND ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_DEMAND) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('moda') ? 'has-error' : '' }}">
                                <label for="moda">Moda :</label>
                                <input type="text" class="form-control" id="moda" name="moda">
                                <span class="help-block">{!! implode('', $errors->get('moda')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">Alamat :</label>
                                <textarea class="form-control" id="address" name="address" rows="5"></textarea>
                                <span class="help-block">{!! implode('', $errors->get('address')) !!}</span>
                            </div>

                            <div class="box-footer" style="text-align: right">
                                <input type="submit" value="Tambah" class="btn btn-primary">
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
