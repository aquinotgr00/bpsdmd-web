@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucwords(trans('common.recruitment')) }}</h1>
        <ol class="breadcrumb">
            <li>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content recruitment">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box-body">
                    @include('layout.partial.alert')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jurusan</th>
                                    <th>Jabatan yang Ditawarkan</th>
                                    <th>Sekolah</th>
                                    <th>IPK</th>
                                    <th>{{ ucfirst(trans('common.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection
