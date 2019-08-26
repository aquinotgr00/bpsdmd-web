@extends('layout.main')

@section('content')
<section class="content-header">
    <h1>Data User</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url(route('user.create',['type' => \App\Entities\User::ROLE_ADMIN])) }}">
                <i class="fa fa-plus-circle"></i> Tambah User Administrator
            </a>
        </li>
        <li>
            <a href="{{ url(route('user.create',['type' => \App\Entities\User::ROLE_SUPPLY])) }}">
                <i class="fa fa-plus-circle"></i> Tambah User Supply
            </a>
        </li>
        <li>
            <a href="{{ url(route('user.create',['type' => \App\Entities\User::ROLE_DEMAND])) }}">
                <i class="fa fa-plus-circle"></i> Tambah User Demand
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
                                <th>Name</th>
                                <th>Username</th>
                                <th>Hak Akses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                            /** @var \App\Entities\Organization $item */
                            foreach ($data as $item) {
                                ?>
                                <tr class="even pointer">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->getName() }}</td>
                                    <td>{{ $item->getUserName() }}</td>
                                    <td>{{ $item->getAuthority() }}</td>
                                    <td>
                                        <a href="{{ url(route('user.update', [$item->getId()])) }}"><i class="fa fa-pencil"></i> Ubah</a> |
                                        <a onclick="return confirm('Apakah anda yakin ?')" href="{{ url(route('user.delete', [$item->getId()])) }}" ><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            @if(!count($data))
                            <tr class="even pointer">
                                <td colspan="4">Tidak ada data.</td>
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
</section><!-- /.content -->
@endsection
