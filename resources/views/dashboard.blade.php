@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Ini adalah nama company</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-user"></i> {FAK_LABEL_USER}
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        Welcome to dashboard page!
    </section><!-- /.content -->
@endsection
