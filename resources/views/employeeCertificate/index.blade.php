@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucwords(trans('common.employee_certificate')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ $urlCreate }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.employee_certificate')) }}
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
                                    <th>{{ ucfirst(trans('common.certificate')) }}</th>
                                    <th>{{ ucwords(trans('common.validity_period')) }}</th>
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
                                    <td>{{ $item->getCertificate() instanceof \App\Entities\Certificate ? $item->getCertificate()->getName() : '-' }}</td>
                                    <td>{{ $item->getValidityPeriod() instanceof \DateTime ? $item->getValidityPeriod()->format('d F Y') : '' }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewEmployeeCertificate" data-employee="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
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

        <div id="modalDetailEmployeeCertificate" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">{{ ucwords(trans('common.employee_certificate_information')) }}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th width="30%">{{ ucfirst(trans('common.employee')) }}</th>
                                <td width="5%">:</td>
                                <td class="employeEemployee"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.certificate')) }}</th>
                                <td>:</td>
                                <td class="employeeCertificate"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.validity_period')) }}</th>
                                <td>:</td>
                                <td class="employeeValidityPeriod"></td>
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
    $('a.viewEmployeeCertificate').on('click', function () {
        let employee = $(this).data('employee'),
            modalHtml = $('#modalDetailEmployeeCertificate'),
            url = '{{ $urlDetail }}';

        modalHtml.modal('hide');

        $.get(url+'/'+employee, function(employee, status){
            if (status === 'success') {
                modalHtml.find('.employeEemployee').html(employee.employee);
                modalHtml.find('.employeeCertificate').html(employee.certificate);
                modalHtml.find('.employeeValidityPeriod').html(employee.validity_period);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailEmployeeCertificate').on('hidden.bs.modal', function (e) {
        modalHtml.find('.employeEemployee').html('');
        modalHtml.find('.employeeCertificate').html('');
        modalHtml.find('.employeeValidityPeriod').html('');
    })
</script>
@endsection
