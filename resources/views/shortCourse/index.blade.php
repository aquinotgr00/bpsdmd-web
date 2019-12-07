@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.short_course')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#" data-target="#import-modal" data-toggle="modal">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.import')) }} {{ ucfirst(trans('common.short_course')) }}
                </a>
            </li>
            <li>
                <a href="{{ url(route('administrator.shortCourse.create')) }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.short_course')) }}
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        @include('layout.partial.alert')

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>{{ ucfirst(trans('common.name')) }}</th>
                                    <th>{{ ucfirst(trans('common.type')) }}</th>
                                    <th>{{ ucfirst(trans('common.institute')) }}</th>
                                    <th>{{ ucfirst(trans('common.generation')) }}</th>
                                    <th style="text-align: center;">{{ ucfirst(trans('common.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                                /** @var \App\Entities\Organization $item */
                                foreach ($data as $item) {
                                ?>
                                <tr class="even pointer">
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ ucfirst($item->getType()) }}</td>
                                    <td>{{ $item->getOrg() instanceof \App\Entities\Organization ? $item->getOrg()->getName() : '-' }}</td>
                                    <td>{{ ucfirst($item->getShortCourseData(){0}->getGeneration()) }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewShortCourse" data-shortcourse="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <!-- <a href="{{ url(route('administrator.shortCourse.update', [$item->getId()])) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> | -->
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ url(route('administrator.shortCourse.delete', [$item->getId()])) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                        <a href="{{ url(route('administrator.shortCourseData.index', [$item->getId()])) }}"><i class="fa fa-book"></i> {{ ucwords(trans('common.short_course_data')) }}</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>

                                @if(!count($data))
                                    <tr class="even pointer">
                                        <td colspan="5">{{ ucfirst(trans('common.no_data')) }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <nav>
                            {{ $data->links() }}
                        </nav>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>

    <div id="modalDetailShortCourse" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">{{ ucfirst(trans('common.short_course_information')) }}</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th width="30%">{{ ucfirst(trans('common.name')) }}</th>
                            <td width="5%">:</td>
                            <td class="shortCourseName"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.type')) }}</th>
                            <td>:</td>
                            <td class="shortCourseType"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.institute')) }}</th>
                            <td>:</td>
                            <td class="shortCourseInstitute"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </section><!-- /.content -->

    <div class="modal fade" tabindex="-1" role="dialog" id="import-modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{route('administrator.shortCourse.upload')}}" method="POST" enctype="multipart/form-data">@csrf
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ ucfirst(trans('common.upload')) }} {{ ucfirst(trans('common.diklat')) }}</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  @if(currentUser()->getOrg() === null)
                      <label for="file">{{ ucfirst(trans('common.choose_institute')) }}</label>
                      <select class="form-control" name="org_id" >
                          @foreach ($orgs as $org)
                              <option value="{{$org->getId()}}">{{$org->getName()}}</option>
                          @endforeach
                      </select>
                  @else
                      <label for="file">{{ ucfirst(trans('common.company')) }}</label>
                      <input type="text" style="display:none;" name="org_id" value="{{currentUser()->getOrg()->getId()}}" readonly>
                      <input type="text" class="form-control" value="{{currentUser()->getOrg()->getName()}}" readonly>
                  @endif
                </div>
                <label for="file">{{ ucfirst(trans('common.choose_file')) }}</label>
                <input type="file" name="file" class="form-control">
                <p>Unduh contoh file: <a href="{{route('administrator.shortCourse.template.download')}}">template</a></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">{{ ucfirst(trans('common.upload')) }}</button>
              </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
<script>
    $('a.viewShortCourse').on('click', function () {
        let shortCourse = $(this).data('shortcourse'),
            modalHtml = $('#modalDetailShortCourse');
            url = '{{ $urlDetail }}';

        $.get(url+'/'+shortCourse, function(shortCourse, status){
            if (status === 'success') {
                modalHtml.find('.shortCourseName').html(shortCourse.name);
                modalHtml.find('.shortCourseType').html(shortCourse.type);
                modalHtml.find('.shortCourseInstitute').html(shortCourse.org);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailShortCourse').on('hidden.bs.modal', function (e) {
        let modalHtml = $('#modalDetailShortCourse');

        modalHtml.find('.shortCourseName').html('');
        modalHtml.find('.shortCourseType').html('');
        modalHtml.find('.shortCourseInstitute').html('');
    })
</script>
@endsection
