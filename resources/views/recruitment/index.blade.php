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
                    <div class="col-xs-6 col-sm-3">
                        <div class="white-box">
                            <form method="post">
                                @csrf
                                <h3 class="box-title m-b-0">{{ ucwords(trans('common.detailed_search')) }}</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ ucwords(trans('common.job_title')) }}</label>
                                            <select class="form-control" id="studyProgram" name="studyProgram">
                                                <option value="" selected="">--{{ ucwords(trans('common.choose_job_title')) }}--</option>
                                                @if(!empty($dataProgram))
                                                    @foreach($dataProgram as $program)
                                                    <option value="{{ $program->getId() }}" {{ old('program') == $program->getId() ? 'selected' : '' }}>{{ $program->getName() }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span class="help-block" id="span-helper"> {{ ucfirst(trans('common.program_filter')) }} </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group lisensi">
                                            <label class="control-label" id="label-license" style="display: none;">{{ ucwords(trans('common.license')) }}</label>
                                            <div class="progress" style="display:none;">
                                                <div class="progress-bar progress-bar-info active progress-bar-striped" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 100%" role="progressbar"> <span class="sr-only">Processing</span> </div>
                                            </div>
                                            <div class="" id="list-license" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group rentang-usia">
                                            <label class="control-label">{{ ucwords(trans('common.age_range')) }}</label><br>
                                            <input type="number" id="age" class="form-control" value="{{ old('age') }}" placeholder="min" name="age" step="1" min="21">
                                            <input type="number" id="age-max" class="form-control" value="{{ old('agemax') }}" placeholder="max" name="agemax" step="1" min="21">
                                            <span class="help-block">{{ ucfirst(trans('common.minimum_age')) }} </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Indeks Prestasi Kumulatif</label>
                                            <input type="number" id="ipk" class="form-control" value="{{ old('ipk') }}" placeholder="" name="ipk" step="0.01" min="0" max="4"> <span class="help-block"> {{ ucfirst(trans('common.minimum_ipk')) }} </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ ucwords(trans('common.gender')) }}</label>
                                            <select id="gender" name="gender" class="form-control">
                                                <option value="" selected="">{{ ucwords(trans('common.all_gender')) }}</option>
                                                <option value="{{ \App\Entities\Student::GENDER_MALE }}" {{ old('gender') == \App\Entities\Student::GENDER_MALE ? 'selected' : '' }}>{{ ucfirst(trans('common.male')) }}</option>
                                                <option value="{{ \App\Entities\Student::GENDER_FEMALE }}" {{ old('gender') == \App\Entities\Student::GENDER_FEMALE ? 'selected' : '' }}>{{ ucfirst(trans('common.female')) }}</option>
                                            </select>
                                            <span class="help-block">{{ ucwords(trans('common.gender')) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{ ucwords(trans('common.accreditation')) }}</label>
                                            <select id="accreditation" name="accreditation" class="form-control">
                                                <option value="" selected="">{{ ucwords(trans('common.all_accreditation')) }}</option>
                                                <option value="{{ \App\Entities\Organization::ACCREDITATION_A }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_A ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_A) }}</option>
                                                <option value="{{ \App\Entities\Organization::ACCREDITATION_B }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_B ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_B) }}</option>
                                                <option value="{{ \App\Entities\Organization::ACCREDITATION_C }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_C ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_C) }}</option>
                                                <option value="{{ \App\Entities\Organization::ACCREDITATION_NA }}" {{ old('accreditation') == \App\Entities\Organization::ACCREDITATION_NA ? 'selected' : '' }}>{{ ucfirst(\App\Entities\Organization::ACCREDITATION_NA) }}</option>
                                            </select>
                                            <span class="help-block">{{ ucwords(trans('common.school_accreditation')) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn-block btn-info m-t-10"><i class=" ti-search"></i> {{ ucwords(trans('common.find_taruna')) }}</button>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8 search-result-students">
                        <div class="row overview-results">
                            <div class="white-box m-b-15">
                                <div class="row row-in">
                                    <!-- <div class="col-lg-3 col-sm-6 row-in-br demand-logo b-r-none">
                                        <ul class="col-in">
                                            <li class="col-middle">
                                                <img src="/bo/demand/home/static/plugins/images/logo-airnav.jpeg" alt="" />
                                            </li>
                                        </ul>
                                    </div> -->
                                    <div class="col-lg-3 col-sm-6 row-in-br hasil-pencarian b-r-none">
                                        <ul class="col-in">
                                            <li class="col-last">
                                                <h3 class="counter text-right m-t-15"><?=count($data)?></h3>
                                            </li>
                                            <li class="col-middle">
                                                <h4>{{ ucwords(trans('common.search_result')) }}</h4>
                                                <div class="progress">
                                                    <?php $searchPersen = (count($data) / (count($allStudent) ? count($allStudent) : 1))*100;?>
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?=$searchPersen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$searchPersen?>%">
                                                        <span class="sr-only"><?=$searchPersen?>% Complete (success)</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 daftar-penawaran b-0">
                                        <ul class="col-in">
                                            <li>
                                                <a href="{{ url(route('demand.offering.index')) }}"><span class="circle circle-md bg-success"><i class="fa fa-shopping-cart"></i></span></a>
                                            </li>
                                            <li class="col-last">
                                                <h3 class="counter text-right m-t-15"><?=count($recruitment)?></h3>
                                            </li>
                                            <li class="col-middle">
                                                <h4 style="font-size:14px;">{{ ucwords(trans('common.list_candidate')) }}</h4>
                                                <div class="progress">
                                                    <?php $persen = (count($recruitment) / (count($allStudent) ? count($allStudent) : 1))*100;?>
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%">
                                                        <span class="sr-only"><?=$persen?>% Complete (success)</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="white-box">
                                <div class="table-responsive">
                                    <table id="daftar_taruna_2" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>{{ ucfirst(trans('common.name')) }}</th>
                                                <th>{{ ucfirst(trans('common.school')) }}</th>
                                                <th>{{ ucfirst(trans('common.degree')) }}</th>
                                                <th>{{ ucwords(trans('common.graduation_year')) }}</th>
                                                <th>{{ strtoupper(trans('common.ipk')) }}</th>
                                                <th>{{ ucwords(trans('common.gender')) }}</th>
                                                <th style="text-align: center;">{{ ucfirst(trans('common.action')) }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                                            /** @var \App\Entities\Student $item */
                                            foreach ($data as $item) {
                                            ?>
                                                <tr>
                                                    <td>{{ $item->getName() }}</td>
                                                    <td>{{ $item->getOrg() instanceof \App\Entities\Organization ? $item->getOrg()->getName() : '-' }}</td>
                                                    <td>{{ $item->getStudyProgram() instanceof \App\Entities\StudyProgram ? $item->getStudyProgram()->getDegree() : '-' }}</td>
                                                    <td>{{ $item->getGraduationYear() ? $item->getGraduationYear() : '-' }}</td>
                                                    <td>{{ $item->getIpk() ? $item->getIpk() : '-' }}</td>
                                                    <td>{{ $item->getGender() ? $item->getGender() : '-' }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-block btn-info viewStudent" data-student="{{ $item->getId() }}">{{ ucfirst(trans('common.view')) }}</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

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
                            </div>
                        </div>
                    </div>
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
                                    <th>{{ ucwords(trans('common.date_of_birth')) }}</th>
                                    <td>:</td>
                                    <td class="studentDateOfBirth"></td>
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
                            <label for="job-title">{{ ucwords(trans('common.job_title')) }}</label>
                            <select name="job-title" id="job-title" class="form-control">
                                @foreach ($jobTitles as $jobTitle)
                                    <option value="{{$jobTitle->getId()}}">{{$jobTitle->getName()}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-href="" class="btn btn-info chart chart-submit" style="width:50px"><i class="fa fa-shopping-cart"></i></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    $('.chart-submit').on('click', (el) => {
        $.ajax({
          type: "POST",
          url: el.currentTarget.getAttribute('data-href'),
          data: {jobTitle: $('#job-title').val()},
          success: data => {
            window.location.reload()
          },
        });
    })
    $('a.viewStudent').on('click', function () {
        let student = $(this).data('student'),
            modalHtml = $('#modalDetailStudent'),
            url = '{{ $urlDetail }}';

        modalHtml.modal('hide');

        $.get(url+'/'+student, function(student, status){
            if (status === 'success') {
                modalHtml.find('.studentNim').html(student.nim);
                modalHtml.find('.studentName').html(student.name);
                modalHtml.find('.studentInstitute').html(student.org);
                modalHtml.find('.studentStudyProgram').html(student.study_program);
                modalHtml.find('.studentPeriod').html(student.period);
                modalHtml.find('.studentCurriculum').html(student.curriculum);
                modalHtml.find('.studentIdentityNumber').html(student.identity_number);
                modalHtml.find('.studentDateOfBirth').html(student.date_of_birth);
                modalHtml.find('.studentStatus').html(student.status);
                modalHtml.find('.studentClass').html(student.class);
                modalHtml.find('.studentIpk').html(student.ipk);
                modalHtml.find('.studentGraduationYear').html(student.graduation_year);
                modalHtml.find('.studentPhoto').attr("src",student.photo);
                modalHtml.find('.chart').attr("data-href",student.add_chart);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailStudent').on('hidden.bs.modal', function (e) {
        let modalHtml = $('#modalDetailStudent');

        modalHtml.find('.studentNim').html('');
        modalHtml.find('.studentName').html('');
        modalHtml.find('.studentInstitute').html('');
        modalHtml.find('.studentStudyProgram').html('');
        modalHtml.find('.studentPeriod').html('');
        modalHtml.find('.studentCurriculum').html('');
        modalHtml.find('.studentIdentityNumber').html('');
        modalHtml.find('.studentDateOfBirth').html('');
        modalHtml.find('.studentStatus').html('');
        modalHtml.find('.studentClass').html('');
        modalHtml.find('.studentIpk').html('');
        modalHtml.find('.studentGraduationYear').html('');
        modalHtml.find('.studentPhoto').attr('src','');
    })
</script>
@endsection
