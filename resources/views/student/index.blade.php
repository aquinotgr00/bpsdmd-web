@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.student')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(route('student.create')) }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.student')) }}
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
                                    <th>{{ ucfirst(trans('common.code')) }}</th>
                                    <th>{{ ucfirst(trans('common.name')) }}</th>
                                    <th>{{ ucfirst(trans('common.institute')) }}</th>
                                    <th>{{ ucwords(trans('common.study_program')) }}</th>
                                    <th>{{ strtoupper(trans('common.ipk')) }}</th>
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
                                    <td>{{ $item->getCode() ? $item->getCode() : '-' }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ $item->getOrg() instanceof \App\Entities\Organization ? $item->getOrg()->getName() : '-' }}</td>
                                    <td>{{ $item->getStudyProgram() instanceof \App\Entities\StudyProgram ? $item->getStudyProgram()->getName() : '-' }}</td>
                                    <td>{{ $item->getIpk() ? $item->getIpk() : '-' }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewStudent" data-student="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ url(route('student.update', [$item->getId()])) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                        <a onclick="return confirm('Apakah anda yakin ?')" href="{{ url(route('student.delete', [$item->getId()])) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
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

    <div id="modalDetailStudent" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">{{ ucwords(trans('common.student_information')) }}</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th width="30%">{{ ucfirst(trans('common.code')) }}</th>
                            <td width="5%">:</td>
                            <td class="studentCode"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.name')) }}</th>
                            <td>:</td>
                            <td class="studentName"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.institute')) }}</th>
                            <td>:</td>
                            <td class="studentInstitute"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.study_program')) }}</th>
                            <td>:</td>
                            <td class="studentStudyProgram"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.period')) }}</th>
                            <td>:</td>
                            <td class="studentPeriod"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.curriculum')) }}</th>
                            <td>:</td>
                            <td class="studentCurriculum"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.date_of_birth')) }}</th>
                            <td>:</td>
                            <td class="studentDateOfBirth"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.class')) }}</th>
                            <td>:</td>
                            <td class="studentClass"></td>
                        </tr>
                        <tr>
                            <th>{{ strtoupper(trans('common.ipk')) }}</th>
                            <td>:</td>
                            <td class="studentIpk"></td>
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
@endsection

@section('script')
<script>
    $('a.viewStudent').on('click', function () {
        let student = $(this).data('student'),
            modalHtml = $('#modalDetailStudent');

        modalHtml.modal('hide');

        $.get('/student/'+student, function(student, status){
            if (status === 'success') {
                modalHtml.find('.studentCode').html(student.code);
                modalHtml.find('.studentName').html(student.name);
                modalHtml.find('.studentInstitute').html(student.org);
                modalHtml.find('.studentStudyProgram').html(student.study_program);
                modalHtml.find('.studentPeriod').html(student.period);
                modalHtml.find('.studentCurriculum').html(student.curriculum);
                modalHtml.find('.studentDateOfBirth').html(student.date_of_birth);
                modalHtml.find('.studentClass').html(student.class);
                modalHtml.find('.studentIpk').html(student.ipk);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailStudent').on('hidden.bs.modal', function (e) {
        modalHtml.find('.studentCode').html('');
        modalHtml.find('.studentName').html('');
        modalHtml.find('.studentInstitute').html('');
        modalHtml.find('.studentStudyProgram').html('');
        modalHtml.find('.studentPeriod').html('');
        modalHtml.find('.studentCurriculum').html('');
        modalHtml.find('.studentDateOfBirth').html('');
        modalHtml.find('.studentClass').html('');
        modalHtml.find('.studentIpk').html('');
    })
</script>
@endsection
