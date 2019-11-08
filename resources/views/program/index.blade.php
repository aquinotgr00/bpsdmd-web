@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucwords(trans('common.study_program')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ $urlCreate }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.study_program')) }}
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
                                    <th>{{ ucfirst(trans('common.degree')) }}</th>
                                    <th style="text-align: center;">{{ ucfirst(trans('common.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                                /** @var \App\Entities\StudyProgram $item */
                                foreach ($data as $item) {
                                ?>
                                <tr class="even pointer">
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ $item->getCode() ? $item->getCode() : '-' }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ ucfirst($item->getDegree()) }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewProgram" data-program="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ $urlUpdate($item->getId()) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ $urlDelete($item->getId()) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
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

        <div id="modalDetailProgram" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">{{ ucwords(trans('common.program_information')) }}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th width="30%">{{ ucwords(trans('common.code')) }}</th>
                                <td width="5%">:</td>
                                <td class="programCode"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.name')) }}</th>
                                <td>:</td>
                                <td class="programName"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.institute')) }}</th>
                                <td>:</td>
                                <td class="programInstitute"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.status')) }}</th>
                                <td>:</td>
                                <td class="programStatus"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.vision')) }}</th>
                                <td>:</td>
                                <td class="programVision"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.mission')) }}</th>
                                <td>:</td>
                                <td class="programMission"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.passing_grade_credits')) }}</th>
                                <td>:</td>
                                <td class="programPassingGradeCredits"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.degree')) }}</th>
                                <td>:</td>
                                <td class="programDegree"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.est_date')) }}</th>
                                <td>:</td>
                                <td class="programEstDate"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.letter_of_est')) }}</th>
                                <td>:</td>
                                <td class="programLetterOfEst"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.date_of_est')) }}</th>
                                <td>:</td>
                                <td class="programDateOfEst"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.license')) }}</th>
                                <td>:</td>
                                <td class="programLicense"></td>
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
    $('a.viewProgram').on('click', function () {
        let program = $(this).data('program'),
            modalHtml = $('#modalDetailProgram'),
            url = '{{ $urlDetail }}';

        modalHtml.modal('hide');

        $.get(url+'/'+program, function(program, status){
            if (status === 'success') {
                modalHtml.find('.programCode').html(program.code);
                modalHtml.find('.programName').html(program.name);
                modalHtml.find('.programInstitute').html(program.org);
                modalHtml.find('.programStatus').html(program.status);
                modalHtml.find('.programVision').html(program.vision);
                modalHtml.find('.programMission').html(program.mission);
                modalHtml.find('.programPassingGradeCredits').html(program.passing_grade_credits);
                modalHtml.find('.programDegree').html(program.degree);
                modalHtml.find('.programEstDate').html(program.est_date);
                modalHtml.find('.programLetterOfEst').html(program.letter_of_est);
                modalHtml.find('.programDateOfEst').html(program.date_of_est);
                modalHtml.find('.programLicense').html(program.license);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailProgram').on('hidden.bs.modal', function (e) {
        let modalHtml = $('#modalDetailProgram');

        modalHtml.find('.programCode').html('');
        modalHtml.find('.programName').html('');
        modalHtml.find('.programInstitute').html('');
        modalHtml.find('.programStatus').html('');
        modalHtml.find('.programVision').html('');
        modalHtml.find('.programMission').html('');
        modalHtml.find('.programPassingGradeCredits').html('');
        modalHtml.find('.programDegree').html('');
        modalHtml.find('.programEstDate').html('');
        modalHtml.find('.programLetterOfEst').html('');
        modalHtml.find('.programDateOfEst').html('');
        modalHtml.find('.programLicense').html('');
    })
</script>
@endsection
