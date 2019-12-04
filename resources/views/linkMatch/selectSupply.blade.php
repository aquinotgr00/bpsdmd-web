@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Edit Link and Match <small>{{ ucwords(trans('common.please_choose', ['object' => trans('common.supply')])) }}</small></h1>
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
                                    <a href="{{ url(route('administrator.link-match.select-program', [$item->getId()])) }}"><i class="fa fa-arrow-circle-right"></i> {{ ucfirst(trans('common.choose')) }}</a>
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
    </section><!-- /.content -->
@endsection
