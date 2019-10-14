@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucfirst(trans('common.diklat')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#" data-target="#import-modal" data-toggle="modal">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.import')) }} {{ ucfirst(trans('common.diklat')) }}
                </a>
            </li>
            <li>
                <a href="{{ url(route('administrator.diklat.create')) }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.diklat')) }}
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
                                    <th>{{ ucfirst(trans('common.name')) }}</th>
                                    <th>{{ ucfirst(trans('common.type')) }}</th>
                                    <th>{{ ucfirst(trans('common.institute')) }}</th>
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
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ ucfirst($item->getType()) }}</td>
                                    <td>{{ $item->getOrg() instanceof \App\Entities\Organization ? $item->getOrg()->getName() : '-' }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="viewDiklat" data-diklat="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ url(route('administrator.diklat.update', [$item->getId()])) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ url(route('administrator.diklat.delete', [$item->getId()])) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                        <a href="{{ url(route('administrator.data_diklat.index', [$item->getId()])) }}"><i class="fa fa-book"></i> {{ ucwords(trans('common.data_diklat')) }}</a>
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

    <div id="modalDetailDiklat" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">{{ ucfirst(trans('common.diklat_information')) }}</h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th width="30%">{{ ucfirst(trans('common.name')) }}</th>
                            <td width="5%">:</td>
                            <td class="diklatName"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.type')) }}</th>
                            <td>:</td>
                            <td class="diklatType"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.institute')) }}</th>
                            <td>:</td>
                            <td class="diklatInstitute"></td>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="import-modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{route('administrator.diklat.upload')}}" method="POST" enctype="multipart/form-data">@csrf
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ ucfirst(trans('common.upload')) }} {{ ucfirst(trans('common.diklat')) }}</h4>
              </div>
              <div class="modal-body">
                <label for="file">{{ ucfirst(trans('common.choose_file')) }}</label>
                <input type="file" name="file" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">{{ ucfirst(trans('common.upload')) }}</button>
              </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
<script>
    $('a.viewDiklat').on('click', function () {
        let diklat = $(this).data('diklat'),
            modalHtml = $('#modalDetailDiklat');

        modalHtml.modal('hide');

        $.get('/diklat/'+diklat, function(diklat, status){
            if (status === 'success') {
                modalHtml.find('.diklatName').html(diklat.name);
                modalHtml.find('.diklatType').html(diklat.type);
                modalHtml.find('.diklatInstitute').html(diklat.org);
                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailDiklat').on('hidden.bs.modal', function (e) {
        modalHtml.find('.diklatName').html('');
        modalHtml.find('.diklatType').html('');
        modalHtml.find('.diklatInstitute').html('');
    })
</script>
@endsection
