@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.institute')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(route('administrator.org.create')) }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.institute')) }}
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
                                    <th>{{ ucfirst(trans('common.type')) }}</th>
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
                                    <td>{{ $item->getCode() ? $item->getCode() : '-' }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ ucfirst($item->getType()) }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewOrg" data-org="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ url(route('administrator.org.update', [$item->getId()])) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ url(route('administrator.org.delete', [$item->getId()])) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                        @if($item->getType() == \App\Entities\Organization::TYPE_SUPPLY)
                                            | <a href="{{ url(route('administrator.program.index', [$item->getId()])) }}"><i class="fa fa-sliders"></i> {{ ucwords(trans('common.study_program')) }}</a>
                                            | <a href="{{ url(route('administrator.teacher.index', [$item->getId()])) }}"><i class="fa fa-male"></i> {{ ucwords(trans('common.teacher')) }}</a>
                                            | <a href="{{ url(route('administrator.student.index', [$item->getId()])) }}"><i class="fa fa-child"></i> {{ ucwords(trans('common.student')) }}</a>
                                        @endif
                                        @if($item->getType() == \App\Entities\Organization::TYPE_DEMAND)
                                            | <a href="{{ url(route('administrator.employee.index', [$item->getId()])) }}"><i class="fa fa-user"></i> {{ ucwords(trans('common.employee')) }}</a>
                                            | <a href="{{ url(route('administrator.jobTitle.index', [$item->getId()])) }}"><i class="fa fa-shield"></i> {{ ucwords(trans('common.job_title')) }}</a>
                                            | <a href="{{ url(route('administrator.jobFunction.index', [$item->getId()])) }}"><i class="fa fa-list"></i> {{ ucwords(trans('common.job_function')) }}</a>
                                        @endif
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

    <div id="modalDetailOrg" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">{{ ucwords(trans('common.institute_information')) }}</h4>
                </div>
                <div class="modal-body">
                    <div style="text-align: center; margin-bottom: 22px">
                        <img class="orgPhoto" src="" width="100px" height="100px">
                    </div>
                    <table class="table">
                        <tr>
                            <th width="30%">{{ ucfirst(trans('common.code')) }}</th>
                            <td width="5%">:</td>
                            <td class="orgCode"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.name')) }}</th>
                            <td>:</td>
                            <td class="orgName"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.short_name')) }}</th>
                            <td>:</td>
                            <td class="orgShortName"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.type')) }}</th>
                            <td>:</td>
                            <td class="orgType"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.moda')) }}</th>
                            <td>:</td>
                            <td class="orgModa"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.address')) }}</th>
                            <td>:</td>
                            <td class="orgAddress"></td>
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
    $('a.viewOrg').on('click', function () {
        let org = $(this).data('org'),
            modalHtml = $('#modalDetailOrg');

        modalHtml.modal('hide');

        $.get('/org/'+org, function(org, status){
            if (status === 'success') {
                modalHtml.find('.orgPhoto').attr("src",org.photo);
                modalHtml.find('.orgCode').html(org.code);
                modalHtml.find('.orgName').html(org.name);
                modalHtml.find('.orgShortName').html(org.short_name);
                modalHtml.find('.orgType').html(org.type);
                modalHtml.find('.orgModa').html(org.moda);
                modalHtml.find('.orgAddress').html(org.address);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailOrg').on('hidden.bs.modal', function (e) {
        let modalHtml = $('#modalDetailOrg');

        modalHtml.find('.orgPhoto').attr('src','');
        modalHtml.find('.orgCode').html('');
        modalHtml.find('.orgName').html('');
        modalHtml.find('.orgShortName').html('');
        modalHtml.find('.orgType').html('');
        modalHtml.find('.orgModa').html('');
        modalHtml.find('.orgAddress').html('');
    })
</script>
@endsection
