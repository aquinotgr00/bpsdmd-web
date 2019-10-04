@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.feeder')) }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                            {{ ucfirst(trans('common.upload')) }}
                        </button>
 
                        <!-- Import Excel -->
                        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="post" action="{{ url(route('feeder.upload')) }}" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="upload">{{ ucwords(trans('common.upload')) }}</h5>
                                        </div>
                                        <div class="modal-body">
                 
                                            {{ csrf_field() }}
                 
                                            <label>{{ ucfirst(trans('common.choose_file')) }}</label>
                                            <div class="form-group">
                                                <input type="file" name="file" required="required">
                                            </div>
                 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">{{ ucwords(trans('common.upload')) }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
