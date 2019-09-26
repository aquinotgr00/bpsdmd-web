@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Ubah Organisasi</h1>
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
                                <input id="code" name="code" type="text" class="form-control" value="{{ $data->getCode() }}">
                                <span class="help-block">{!! implode('', $errors->get('code')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nama :</label>
                                <input id="name" type="text" name="name" class="form-control" value="{{ $data->getName() }}">
                                <span class="help-block">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                                <label for="short_name">Nama Pendek</label>
                                <input id="short_name" name="short_name" type="text" class="form-control" value="{{ $data->getShortName() }}">
                                <span class="help-block">{!! implode('', $errors->get('short_name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label for="type">Tipe :</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="{{ \App\Entities\Organization::TYPE_SUPPLY }}" {{ $data->getType() == \App\Entities\Organization::TYPE_SUPPLY ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_SUPPLY) }}</option>
                                    <option value="{{ \App\Entities\Organization::TYPE_DEMAND }}" {{ $data->getType() == \App\Entities\Organization::TYPE_DEMAND ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::TYPE_DEMAND) }}</option>
                                </select>
                                <span class="help-block">{!! implode('', $errors->get('type')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('moda') ? 'has-error' : '' }}">
                                <label for="moda">Moda :</label>
                                <input id="moda" name="moda" type="text" class="form-control" value="{{ $data->getModa() }}">
                                <span class="help-block">{!! implode('', $errors->get('moda')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="address">Alamat :</label>
                                <textarea id="address" name="address" class="form-control" rows="5">{{ $data->getAddress() }}</textarea>
                                <span class="help-block">{!! implode('', $errors->get('address')) !!}</span>
                            </div>

                            <div class="box-footer" style="text-align: right">
                                <input type="submit" value="Ubah" class="btn btn-primary">
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
