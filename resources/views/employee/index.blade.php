@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.employee')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ $urlCertificate }}" class="btn btn-primary" style="padding:4px 6px;font-size:12px;color:#fff">
                    <i class="fa fa-envelope"></i> {{ ucwords(trans('common.certificate')) }}
                </a>
                <a href="{{ $urlCreate }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.employee')) }}
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
                                    <th>{{ ucwords(trans('common.identity_number')) }}</th>
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
                                    <td>{{ $item->getIdentityNumber() ? $item->getIdentityNumber() : '-' }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewEmployee" data-employee="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
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

        <div id="modalDetailEmployee" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">{{ ucwords(trans('common.employee_information')) }}</h4>
                    </div>
                    <div class="modal-body">
                        <div style="text-align: center; margin-bottom: 22px">
                            <img class="employeePhoto" src="" width="100px" height="100px">
                        </div>
                        <table class="table">
                            <tr>
                                <th width="30%">{{ ucfirst(trans('common.code')) }}</th>
                                <td width="5%">:</td>
                                <td class="employeeCode"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.name')) }}</th>
                                <td>:</td>
                                <td class="employeeName"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.email')) }}</th>
                                <td>:</td>
                                <td class="employeeEmail"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.institute')) }}</th>
                                <td>:</td>
                                <td class="employeeInstitute"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.identity_number')) }}</th>
                                <td>:</td>
                                <td class="employeeIdentityNumber"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.gender')) }}</th>
                                <td>:</td>
                                <td class="employeeGender"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.place_of_birth')) }}</th>
                                <td>:</td>
                                <td class="employeePlaceOfBirth"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.date_of_birth')) }}</th>
                                <td>:</td>
                                <td class="employeeDateOfBirth"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.language')) }}</th>
                                <td>:</td>
                                <td class="employeeLanguage"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.nationality')) }}</th>
                                <td>:</td>
                                <td class="employeeNationality"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.degree')) }}</th>
                                <td>:</td>
                                <td class="employeeDegree"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.education_level')) }}</th>
                                <td>:</td>
                                <td class="employeeEducationLevel"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.location')) }}</th>
                                <td>:</td>
                                <td class="employeeLocation"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.duration')) }}</th>
                                <td>:</td>
                                <td class="employeeDuration"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.major')) }}</th>
                                <td>:</td>
                                <td class="employeeMajor"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.phone_number')) }}</th>
                                <td>:</td>
                                <td class="employeePhoneNumber"></td>
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
    $('a.viewEmployee').on('click', function () {
        let employee = $(this).data('employee'),
            modalHtml = $('#modalDetailEmployee'),
            url = '{{ $urlDetail }}';

        modalHtml.modal('hide');

        $.get(url+'/'+employee, function(employee, status){
            if (status === 'success') {
                modalHtml.find('.employeeCode').html(employee.code);
                modalHtml.find('.employeeName').html(employee.name);
                modalHtml.find('.employeeEmail').html(employee.email);
                modalHtml.find('.employeeSchool').html(employee.school);
                modalHtml.find('.employeeInstitute').html(employee.org);
                modalHtml.find('.employeeIdentityNumber').html(employee.identity_number);
                modalHtml.find('.employeeGender').html(employee.gender);
                modalHtml.find('.employeePlaceOfBirth').html(employee.place_of_birth);
                modalHtml.find('.employeeDateOfBirth').html(employee.date_of_birth);
                modalHtml.find('.employeeLanguage').html(employee.language);
                modalHtml.find('.employeeNationality').html(employee.nationality);
                modalHtml.find('.employeeDegree').html(employee.degree);
                modalHtml.find('.employeeEducationLevel').html(employee.education_level);
                modalHtml.find('.employeeLocation').html(employee.location);
                modalHtml.find('.employeeDuration').html(employee.duration);
                modalHtml.find('.employeeMajor').html(employee.major);
                modalHtml.find('.employeePhoneNumber').html(employee.phone_number);
                modalHtml.find('.employeePhoto').attr("src",employee.photo);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailEmployee').on('hidden.bs.modal', function (e) {
        let modalHtml = $('#modalDetailEmployee');

        modalHtml.find('.employeeCode').html('');
        modalHtml.find('.employeeName').html('');
        modalHtml.find('.employeeSchool').html('');
        modalHtml.find('.employeeInstitute').html('');
        modalHtml.find('.employeeIdentityNumber').html('');
        modalHtml.find('.employeeGender').html('');
        modalHtml.find('.employeePlaceOfBirth').html('');
        modalHtml.find('.employeeDateOfBirth').html('');
        modalHtml.find('.employeeLanguage').html('');
        modalHtml.find('.employeeNationality').html('');
        modalHtml.find('.employeeDegree').html('');
        modalHtml.find('.employeeEducationLevel').html('');
        modalHtml.find('.employeeLocation').html('');
        modalHtml.find('.employeeDuration').html('');
        modalHtml.find('.employeeMajor').html('');
        modalHtml.find('.employeePhoneNumber').html('');
        modalHtml.find('.employeePhoto').attr('src','');
    })
</script>
@endsection
