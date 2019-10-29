@extends('layout.main')

@section('content')
<section class="content-header">
    <h1>Data {{ ucfirst(trans('common.user')) }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url(route('administrator.user.create',['type' => \App\Entities\User::ROLE_ADMIN])) }}">
                <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.user')) }} Administrator
            </a>
        </li>
        <li>
            <a href="{{ url(route('administrator.user.create',['type' => \App\Entities\User::ROLE_SUPPLY])) }}">
                <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.user')) }} Supply
            </a>
        </li>
        <li>
            <a href="{{ url(route('administrator.user.create',['type' => \App\Entities\User::ROLE_DEMAND])) }}">
                <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucfirst(trans('common.user')) }} Demand
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
                                <th>{{ ucwords(trans('common.email')) }}</th>
                                <th>{{ ucfirst(trans('common.institute')) }}</th>
                                <th>{{ ucfirst(trans('common.authority')) }}</th>
                                <th style="text-align: center;">{{ ucfirst(trans('common.status')) }}</th>
                                <th style="text-align: center;">{{ ucfirst(trans('common.action')) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                            /** @var \App\Entities\User $item */
                            foreach ($data as $item) {
                                ?>
                                <tr class="even pointer">
                                    <td>{{ $no++ }}.</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ $item->getEmail() }}</td>
                                    <td>{{ $item->getOrg() instanceof \App\Entities\Organization ? $item->getOrg()->getName() : '-' }}</td>
                                    <td>{{ ucfirst($item->getAuthority()) }}</td>
                                    <td style="text-align: center;">
                                        @if($item->getIsactive())
                                            <a href="{{ url(route('administrator.user.disable', [$item->getId()])) }}"><span class="label label-success">{{ ucfirst(trans('common.active')) }}</span></a>
                                        @else
                                            <a href="{{ url(route('administrator.user.enable', [$item->getId()])) }}"><span class="label label-danger">{{ ucwords(trans('common.inactive')) }}</span></a>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="javascript:void(0)" class="viewUser" data-user="{{ $item->getId() }}"><i class="fa fa-eye"></i> {{ ucfirst(trans('common.view')) }}</a> |
                                        <a href="{{ url(route('administrator.user.update', [$item->getId()])) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a>
                                        @if(currentUser()->getId() <> $item->getId())
                                        |
                                        <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ url(route('administrator.user.delete', [$item->getId()])) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                        @endif
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            @if(!count($data))
                            <tr class="even pointer">
                                <td colspan="4">{{ ucfirst(trans('common.no_data')) }}</td>
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

    <div id="modalDetailUser" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">{{ ucfirst(trans('common.user_information')) }}</h4>
                </div>
                <div class="modal-body">
                    <div style="text-align: center; margin-bottom: 22px">
                        <img class="userPhoto" src="" width="100px" height="100px">
                    </div>
                    <table class="table">
                        <tr>
                            <th width="30%">{{ ucfirst(trans('common.name')) }}</th>
                            <td width="5%">:</td>
                            <td class="userName"></td>
                        </tr>
                        <tr>
                            <th>{{ ucwords(trans('common.email')) }}</th>
                            <td>:</td>
                            <td class="userEmail"></td>
                        </tr>
                        <tr class="userOrgInfo">
                            <th>{{ ucfirst(trans('common.institute')) }}</th>
                            <td>:</td>
                            <td class="userOrg"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.authority')) }}</th>
                            <td>:</td>
                            <td class="userAuthority"></td>
                        </tr>
                        <tr>
                            <th>{{ ucfirst(trans('common.status')) }}</th>
                            <td>:</td>
                            <td class="userStatus"></td>
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
        let user = $(this).data('user'),
            modalHtml = $('#modalDetailUser');

        modalHtml.modal('hide');

        $.get('/user/'+user, function(user, status){
            if (status === 'success') {
                if (user.org === false) {
                    modalHtml.find('.userOrgInfo').hide();
                } else {
                    modalHtml.find('.userOrgInfo').show();
                    modalHtml.find('.userOrg').html(user.org);
                }

                modalHtml.find('.userPhoto').attr("src",user.photo);
                modalHtml.find('.userName').html(user.name);
                modalHtml.find('.userEmail').html(user.email);
                modalHtml.find('.userAuthority').html(user.authority);

                if (user.active === 1) {
                    modalHtml.find('.userStatus').html('<span class="label label-success">Aktif</span>');
                } else {
                    modalHtml.find('.userStatus').html('<span class="label label-danger">Tidak Aktif</span>');
                }

                modalHtml.modal('show');
            }
        });
    });

    $('#modalDetailUser').on('hidden.bs.modal', function (e) {
        let modalHtml = $('#modalDetailUser');

        modalHtml.find('.userPhoto').attr('src','');
        modalHtml.find('.userName').html('');
        modalHtml.find('.userEmail').html('');
        modalHtml.find('.userOrgInfo').show();
        modalHtml.find('.userOrg').html('');
        modalHtml.find('.userAuthority').html('');
        modalHtml.find('.userStatus').html('');
    })
</script>
@endsection
