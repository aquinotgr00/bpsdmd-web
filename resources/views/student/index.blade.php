@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.student')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importExcel" style="padding:4px 6px;font-size:12px">
                    <i class="fa fa-upload"></i> {{ ucwords(trans('common.student_feeder')) }}
                </button>
                <a href="{{ $urlCreate }}">
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

                        <form class="row">
                            <div class="col-sm-3 col-sm-offset-6">
                                <select name="prodi" id="prodi" class="select2 form-control">
                                    <option value="">Pilih Program Studi</option>
                                    @foreach($studyPrograms as $sp)
                                        @if(Request::get("prodi") == $sp->id)
                                            <option selected value="{{ $sp->id }}">{{ $sp->nama }}</option>
                                        @else
                                            <option value="{{ $sp->id }}">{{ $sp->nama }}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="keyword" name="keyword"
                                           placeholder="NIM/Nama" value="{{ Request::get("keyword") }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>{{ ucfirst(trans('common.nim')) }}</th>
                                <th>{{ ucfirst(trans('common.name')) }}</th>
                                <th>{{ ucfirst(trans('common.institute')) }}</th>
                                <th>{{ ucwords(trans('common.study_program')) }}</th>
                                <th>{{ ucwords(trans('common.period')) }}</th>
                                <th>{{ ucwords(trans('common.curriculum')) }}</th>
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
                                <td>{{ $item->getNim() ? $item->getNim() : '-' }}</td>
                                <td>{{ $item->getName() }}</td>
                                <td>{{ $item->getOrg() instanceof \App\Entities\Organization ? $item->getOrg()->getName() : '-' }}</td>
                                <td>{{ $item->getStudyProgram() instanceof \App\Entities\StudyProgram ? $item->getStudyProgram()->getName() : '-' }}</td>
                                <td>{{ $item->getPeriod() ?? "-" }}</td>
                                <td>{{ $item->getCurriculum() ?? "-" }}</td>
                                <td>{{ $item->getIpk() ? $item->getIpk() : '-' }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="viewStudent"
                                       data-student="{{ $item->getId() }}"><i
                                            class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                    <a href="{{ $urlUpdate($item->getId()) }}"><i
                                            class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                    <a onclick="return confirm('{{ trans('common.confirm_delete') }}')"
                                       href="{{ $urlDelete($item->getId()) }}"><i
                                            class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>

                            @if(!count($data))
                                <tr class="even pointer">
                                    <td colspan="9">{{ ucfirst(trans('common.no_data')) }}</td>
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
                        <div style="text-align: center; margin-bottom: 22px">
                            <img class="studentPhoto" src="" width="100px" height="100px">
                        </div>
                        <table class="table">
                            <tr>
                                <th width="30%">{{ ucfirst(trans('common.nim')) }}</th>
                                <td width="5%">:</td>
                                <td class="studentNim"></td>
                            </tr>
                            <tr>
                                <th>{{ strtoupper(trans('common.id_dikti')) }}</th>
                                <td>:</td>
                                <td class="studentIdDikti"></td>
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
                                <th>{{ ucwords(trans('common.identity_number')) }}</th>
                                <td>:</td>
                                <td class="studentIdentityNumber"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.gender')) }}</th>
                                <td>:</td>
                                <td class="studentGender"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.place_of_birth')) }}</th>
                                <td>:</td>
                                <td class="studentPlaceOfBirth"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.date_of_birth')) }}</th>
                                <td>:</td>
                                <td class="studentDateOfBirth"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.address')) }}</th>
                                <td>:</td>
                                <td class="studentAddress"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.phone_number')) }}</th>
                                <td>:</td>
                                <td class="studentPhoneNumber"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.mobile_phone_number')) }}</th>
                                <td>:</td>
                                <td class="studentMobilePhoneNumber"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.email')) }}</th>
                                <td>:</td>
                                <td class="studentEmail"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.religion')) }}</th>
                                <td>:</td>
                                <td class="studentReligion"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.mother_name')) }}</th>
                                <td>:</td>
                                <td class="studentMotherName"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.nationality')) }}</th>
                                <td>:</td>
                                <td class="studentNationality"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.foreign_citizen')) }}</th>
                                <td>:</td>
                                <td class="studentForeignCitizen"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.social_protection_card')) }}</th>
                                <td>:</td>
                                <td class="studentSocialProtectionCard"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.occupation_type')) }}</th>
                                <td>:</td>
                                <td class="studentOccupationType"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.enrollment_date_start')) }}</th>
                                <td>:</td>
                                <td class="studentEnrollmentDateStart"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.enrollment_date_end')) }}</th>
                                <td>:</td>
                                <td class="studentEnrollmentDateEnd"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.start_semester')) }}</th>
                                <td>:</td>
                                <td class="studentStartSemester"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.current_semester')) }}</th>
                                <td>:</td>
                                <td class="studentCurrentSemester"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.student_credits')) }}</th>
                                <td>:</td>
                                <td class="studentStudentCredits"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.certificate_number')) }}</th>
                                <td>:</td>
                                <td class="studentCertificateNumber"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.graduation_judgement_date')) }}</th>
                                <td>:</td>
                                <td class="studentGraduationJudgementDate"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.enrollment_type')) }}</th>
                                <td>:</td>
                                <td class="studentEnrollmentType"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.graduation_type')) }}</th>
                                <td>:</td>
                                <td class="studentGraduationType"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.status')) }}</th>
                                <td>:</td>
                                <td class="studentStatus"></td>
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
                            <tr>
                                <th>{{ ucwords(trans('common.graduation_year')) }}</th>
                                <td>:</td>
                                <td class="studentGraduationYear"></td>
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
                            <h5 class="modal-title" id="upload">{{ ucwords(trans('common.student_feeder')) }}</h5>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <label>{{ ucfirst(trans('common.choose_file')) }}</label>
                            <div class="form-group">
                                <input type="file" name="file" required="required">
                                <p>{{ ucfirst(trans('common.download_sample_file')) }}: <a href="{{ $urlTemplate }}">{{ ucfirst(trans('common.template')) }}</a></p>
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

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 35px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script !src="">
        $(function () {
            $(".select2").select2({width: "100%"});
        })
    </script>
    <script>
        $('a.viewStudent').on('click', function () {
            let student = $(this).data('student'),
                modalHtml = $('#modalDetailStudent'),
                url = '{{ $urlDetail }}';

            modalHtml.modal('hide');

            $.get(url + '/' + student, function (student, status) {
                if (status === 'success') {
                let modalHtml = $('#modalDetailStudent');

                modalHtml.find('.studentNim').html(student.nim);
                modalHtml.find('.studentIdDikti').html(student.id_dikti);
                modalHtml.find('.studentName').html(student.name);
                modalHtml.find('.studentInstitute').html(student.org);
                modalHtml.find('.studentStudyProgram').html(student.study_program);
                modalHtml.find('.studentPeriod').html(student.period);
                modalHtml.find('.studentCurriculum').html(student.curriculum);
                modalHtml.find('.studentIdentityNumber').html(student.identity_number);
                modalHtml.find('.studentGender').html(student.gender);
                modalHtml.find('.studentPlaceOfBirth').html(student.place_of_birth);
                modalHtml.find('.studentDateOfBirth').html(student.date_of_birth);
                modalHtml.find('.studentAddress').html(student.address);
                modalHtml.find('.studentPhoneNumber').html(student.phone_number);
                modalHtml.find('.studentMobilePhoneNumber').html(student.mobile_phone_number);
                modalHtml.find('.studentEmail').html(student.email);
                modalHtml.find('.studentReligion').html(student.religion);
                modalHtml.find('.studentMotherName').html(student.mother_name);
                modalHtml.find('.studentNationality').html(student.nationality);
                modalHtml.find('.studentForeignCitizen').html(student.foreign_citizen);
                modalHtml.find('.studentSocialProtectionCard').html(student.social_protection_card);
                modalHtml.find('.studentOccupationType').html(student.occupation_type);
                modalHtml.find('.studentEnrollmentDateStart').html(student.enrollment_date_start);
                modalHtml.find('.studentEnrollmentDateEnd').html(student.enrollment_date_end);
                modalHtml.find('.studentStartSemester').html(student.start_semester);
                modalHtml.find('.studentCurrentSemester').html(student.current_semester);
                modalHtml.find('.studentStudentCredits').html(student.student_credits);
                modalHtml.find('.studentCertificateNumber').html(student.certificate_number);
                modalHtml.find('.studentGraduationJudgementDate').html(student.graduation_judgement_date);
                modalHtml.find('.studentEnrollmentType').html(student.enrollment_type);
                modalHtml.find('.studentGraduationType').html(student.graduation_type);
                modalHtml.find('.studentStatus').html(student.status);
                modalHtml.find('.studentClass').html(student.class);
                modalHtml.find('.studentIpk').html(student.ipk);
                modalHtml.find('.studentGraduationYear').html(student.graduation_year);
                modalHtml.find('.studentPhoto').attr("src",student.photo);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailStudent').on('hidden.bs.modal', function (e) {
        modalHtml.find('.studentNim').html('');
        modalHtml.find('.studentIdDikti').html('');
        modalHtml.find('.studentName').html('');
        modalHtml.find('.studentInstitute').html('');
        modalHtml.find('.studentStudyProgram').html('');
        modalHtml.find('.studentPeriod').html('');
        modalHtml.find('.studentCurriculum').html('');
        modalHtml.find('.studentIdentityNumber').html('');
        modalHtml.find('.studentGender').html('');
        modalHtml.find('.studentPlaceOfBirth').html('');
        modalHtml.find('.studentDateOfBirth').html('');
        modalHtml.find('.studentAddress').html('');
        modalHtml.find('.studentPhoneNumber').html('');
        modalHtml.find('.studentMobilePhoneNumber').html('');
        modalHtml.find('.studentEmail').html('');
        modalHtml.find('.studentReligion').html('');
        modalHtml.find('.studentMotherName').html('');
        modalHtml.find('.studentNationality').html('');
        modalHtml.find('.studentForeignCitizen').html('');
        modalHtml.find('.studentSocialProtectionCard').html('');
        modalHtml.find('.studentOccupationType').html('');
        modalHtml.find('.studentEnrollmentDateStart').html('');
        modalHtml.find('.studentEnrollmentDateEnd').html('');
        modalHtml.find('.studentStartSemester').html('');
        modalHtml.find('.studentCurrentSemester').html('');
        modalHtml.find('.studentStudentCredits').html('');
        modalHtml.find('.studentCertificateNumber').html('');
        modalHtml.find('.studentGraduationJudgementDate').html('');
        modalHtml.find('.studentEnrollmentType').html('');
        modalHtml.find('.studentGraduationType').html('');
        modalHtml.find('.studentStatus').html('');
        modalHtml.find('.studentClass').html('');
        modalHtml.find('.studentIpk').html('');
        modalHtml.find('.studentGraduationYear').html('');
        modalHtml.find('.studentPhoto').attr('src','');
    })
</script>
@endsection
