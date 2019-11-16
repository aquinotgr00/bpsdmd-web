@extends('layout.main')

@section('style')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="content-header">
        <h1>{{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.short_course_participant')) }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <form method="post" enctype="multipart/form-data">@csrf
                        <input type="hidden" name="short_course_id" value="{{ Request::segment(2) }}">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ ucwords(trans('common.name')) }} :</label>
                                <select class="form-control" name="employee_id" id="name"></select>
                                <span class="help-block ">{!! implode('', $errors->get('name')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('background') ? 'has-error' : '' }}">
                                <label for="background">{{ ucwords(trans('common.background')) }} :</label>
                                <input type="text" class="form-control" id="background" name="background" value="{{ old('background') }}">
                                <span class="help-block ">{!! implode('', $errors->get('background')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('competence_certificat') ? 'has-error' : '' }}">
                                <label for="competence_certificat">{{ ucwords(trans('common.competence_certificat')) }} :</label>
                                <input type="text" class="form-control" id="competence_certificat" name="competence_certificat" value="{{ old('competence_certificat') }}">
                                <span class="help-block ">{!! implode('', $errors->get('competence_certificat')) !!}</span>
                            </div>

                            <div class="form-group {{ $errors->has('graduate') ? 'has-error' : '' }}">
                                <label for="graduate">{{ ucwords(trans('common.graduate')) }} :</label><br />
                                <input class="form-control" type="radio" name="graduate" value="1" checked>{{ trans('common.done') }}
                                <input class="form-control" type="radio" name="graduate" value="0">{{ trans('common.not_yet') }}
                                <span class="help-block ">{!! implode('', $errors->get('graduate')) !!}</span>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer" style="text-align: right;min-height: 50px;">
                            <button class="btn btn-primary">{{ ucfirst(trans('common.add')) }}</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
  $(document).ready(function () {
    $('#name').select2({
      placeholder: 'Cari pegawai',
      ajax: {
        type: 'POST',
        url: `{{ route('demand.employee.get_by_name') }}`,
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.name,
                id: item.id
              }
            })
          };
        },
        cache: true
      }
    });
  })
</script>
@endsection
