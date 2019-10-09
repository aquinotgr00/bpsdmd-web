@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.teacher')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcel" style="padding:4px 6px;font-size:12px">
                    <i class="fa fa-upload"></i> {{ ucwords(trans('common.teacher_feeder')) }}
                </button>
                <a href="{{ $urlCreate }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.teacher')) }}
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
                                    <th>{{ strtoupper(trans('common.nip')) }}</th>
                                    <th>{{ ucfirst(trans('common.name')) }}</th>
                                    <th>{{ ucfirst(trans('common.institute')) }}</th>
                                    <th>{{ ucwords(trans('common.identity_number')) }}</th>
                                    <th>{{ strtoupper(trans('common.nidn')) }}</th>
                                    <th style="text-align: center;">{{ ucfirst(trans('common.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                                foreach ($data as $item) {
                                ?>
                                <tr class="even pointer">
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ $item->getNip() ? $item->getNip() : '-' }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ $item->getOrg() instanceof \App\Entities\Organization ? $item->getOrg()->getName() : '-' }}</td>
                                    <td>{{ $item->getIdentityNumber() ? $item->getIdentityNumber() : '-' }}</td>
                                    <td>{{ $item->getNidn() ? $item->getNidn() : '-' }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewTeacher" data-teacher="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ $urlUpdate($item->getId()) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ $urlDelete($item->getId()) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>

                                @if(!count($data))
                                    <tr class="even pointer">
                                        <td colspan="7">{{ ucfirst(trans('common.no_data')) }}</td>
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

    <div id="modalDetailTeacher" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">{{ ucwords(trans('common.teacher_information')) }}</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th width="30%">{{ strtoupper(trans('common.nip')) }}</th>
                            <td width="5%">:</td>
                            <td class="teacherNip"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.name')) }}</th>
                            <td>:</td>
                            <td class="teacherName"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.institute')) }}</th>
                            <td>:</td>
                            <td class="teacherInstitute"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.front_degree')) }}</th>
                            <td>:</td>
                            <td class="teacherFrontDegree"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.back_degree')) }}</th>
                            <td>:</td>
                            <td class="teacherBackDegree"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.date_of_birth')) }}</th>
                            <td>:</td>
                            <td class="teacherDateOfBirth"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.identity_number')) }}</th>
                            <td>:</td>
                            <td class="teacherIdentityNumber"></td>
                        </tr>
                        <tr>
                            <th>{{ strtoupper(trans('common.nidn')) }}</th>
                            <td>:</td>
                            <td class="teacherNidn"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ $urlUpload }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="upload">{{ ucwords(trans('common.teacher_feeder')) }}</h5>
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
    </section><!-- /.content -->
@endsection

@section('script')
<script>
    $('a.viewTeacher').on('click', function () {
        let teacher = $(this).data('teacher'),
            modalHtml = $('#modalDetailTeacher'),
            url = '{{ $urlDetail }}';

        modalHtml.modal('hide');

        $.get(url+'/'+teacher, function(teacher, status){
            if (status === 'success') {
                modalHtml.find('.teacherNip').html(teacher.nip);
                modalHtml.find('.teacherName').html(teacher.name);
                modalHtml.find('.teacherInstitute').html(teacher.org);
                modalHtml.find('.teacherFrontDegree').html(teacher.front_degree);
                modalHtml.find('.teacherBackDegree').html(teacher.back_degree);
                modalHtml.find('.teacherDateOfBirth').html(teacher.date_of_birth);
                modalHtml.find('.teacherIdentityNumber').html(teacher.identity_number);
                modalHtml.find('.teacherNidn').html(teacher.nidn);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailTeacher').on('hidden.bs.modal', function (e) {
        modalHtml.find('.teacherNip').html('');
        modalHtml.find('.teacherName').html('');
        modalHtml.find('.teacherInstitute').html('');
        modalHtml.find('.teacherFrontDegree').html('');
        modalHtml.find('.teacherBackDegree').html('');
        modalHtml.find('.teacherDateOfBirth').html('');
        modalHtml.find('.teacherIdentityNumber').html('');
        modalHtml.find('.teacherNidn').html('');
    })
</script>
@endsection
