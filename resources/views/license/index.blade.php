@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucwords(trans('common.license')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ $urlCreate }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.license')) }}
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
                                    <th>{{ ucfirst(trans('common.chapter')) }}</th>
                                    <th>{{ ucfirst(trans('common.name')) }}</th>
                                    <th>{{ ucfirst(trans('common.moda')) }}</th>
                                    <th>{{ ucfirst(trans('common.head')) }}</th>
                                    <th>{{ ucfirst(trans('common.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                                /** @var \App\Entities\License $item */
                                foreach ($data as $item) {
                                ?>
                                <tr class="even pointer">
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ $item->getCode() ? $item->getCode() : '-' }}</td>
                                    <td>{{ ucfirst($item->getChapter()) }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ ucfirst($item->getModa()) }}</td>
                                    <td>{{ $item->getHead() ? $item->getHead() : '-' }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewLicense" data-license="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ $urlUpdate($item->getId()) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ $urlDelete($item->getId()) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
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

        <div id="modalDetailLicense" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">{{ ucfirst(trans('common.license')) }}</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <th width="30%">{{ ucfirst(trans('common.moda')) }}</th>
                                <td width="5%">:</td>
                                <td class="moda"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.name')) }}</th>
                                <td>:</td>
                                <td class="name"></td>
                            </tr>
                            <tr>
                                <th>{{ ucfirst(trans('common.head')) }}</th>
                                <td>:</td>
                                <td class="head"></td>
                            </tr>
                            <tr>
                                <th>{{ ucwords(trans('common.competency')) }}</th>
                                <td>:</td>
                                <td class="licenseCompetency"></td>
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
        $('a.viewLicense').on('click', function () {
            let license = $(this).data('license'),
                modalHtml = $('#modalDetailLicense');

            modalHtml.modal('hide');

            $.get('/license/'+license, function(license, status){
                if (status === 'success') {
                    modalHtml.find('.moda').html(license.moda);
                    modalHtml.find('.name').html(license.name);
                    modalHtml.find('.head').html(license.head);
                    modalHtml.find('.licenseCompetency').html(license.competency);

                    modalHtml.modal('show');
                }
            });
        });

        $('#modalDetailUser').on('hidden.bs.modal', function (e) {
            let modalHtml = $('#modalDetailLicense');
            modalHtml.find('.moda').html('');
            modalHtml.find('.name').html('');
            modalHtml.find('.head').html('');
            modalHtml.find('.licenseLicense').html('');
        })
    </script>
@endsection
