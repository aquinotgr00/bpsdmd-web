@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box box-danger" style="min-height: 400px">
                    <div class="box-header"></div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 style="text-align: center">{{ $org->getName() }}</h1>
                                <p style="text-align: center">{{ $org->getDescription() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section><!-- /.content -->
@endsection
