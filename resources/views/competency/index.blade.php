@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucwords(trans('common.competency')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(route('administrator.competency.create')) }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.competency')) }}
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
                                    <th>{{ ucfirst(trans('common.moda')) }}</th>
                                    <th>{{ ucfirst(trans('common.type')) }}</th>
<<<<<<< HEAD
                                    <th>{{ ucfirst(trans('common.action')) }}</th>
=======
                                    <th>Action</th>
>>>>>>> added competency
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                                /** @var \App\Entities\Competency $item */
                                foreach ($data as $item) {
                                ?>
                                <tr class="even pointer">
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ ucwords($item->getModa()) }}</td>
                                    <td>{{ $item->getType() }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewUser" data-competency="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ url(route('administrator.competency.update', [$item->getId()])) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ url(route('administrator.competency.delete', [$item->getId()])) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>

                                @if(!count($data))
                                    <tr class="even pointer">
                                        <td colspan="6">{{ ucfirst(trans('common.no_data')) }}</td>
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

        <div id="modalDetailCompetency" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">{{ ucfirst(trans('common.competency')) }}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th width="30%">{{ ucfirst(trans('common.moda')) }}</th>
                                <td width="5%">:</td>
                                <td class="moda"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.type')) }}</th>
                                <td>:</td>
                                <td class="type"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.competency_main_purpose')) }}</th>
                                <td>:</td>
                                <td class="cmp"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.competency_key_function')) }}</th>
                                <td>:</td>
                                <td class="ckf"></td>
                            </tr>
                            <tr class="userOrgInfo">
                                <th>{{ ucfirst(trans('common.competency_main_function')) }}</th>
                                <td>:</td>
                                <td class="cmf"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.competency_unit')) }}</th>
                                <td>:</td>
                                <td class="cu"></td>
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
        $('a.viewUser').on('click', function () {
            let competency = $(this).data('competency'),
                modalHtml = $('#modalDetailCompetency');

            modalHtml.modal('hide');

            $.get('/competency/'+competency, function(competency, status){
                if (status === 'success') {
                    modalHtml.find('.moda').html(competency.moda);
                    modalHtml.find('.type').html(competency.type);
                    modalHtml.find('.ckf').html(competency.ckf);
                    modalHtml.find('.cmf').html(competency.cmf);
                    modalHtml.find('.cmp').html(competency.cmp);
                    modalHtml.find('.cu').html(competency.cu);

                    modalHtml.modal('show');
                }
            });
        });

        $('#modalDetailUser').on('hidden.bs.modal', function (e) {
<<<<<<< HEAD
            let modalHtml = $('#modalDetailCompetency');

=======
>>>>>>> added competency
            modalHtml.find('.moda').html('');
            modalHtml.find('.type').html('');
            modalHtml.find('.ckf').html('');
            modalHtml.find('.cmf').html('');
            modalHtml.find('.cmp').show();
            modalHtml.find('.cu').html('');
        })
    </script>
@endsection
