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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ ucfirst(trans('common.name')) }}</th>
                                    <th>{{ ucwords(trans('common.study_program')) }}</th>
                                    <th>{{ ucwords(trans('common.position_offered')) }}</th>
                                    <th>{{ ucfirst(trans('common.school')) }}</th>
                                    <th>{{ strtoupper(trans('common.ipk')) }}</th>
                                    <th>{{ ucfirst(trans('common.action')) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1 + ($page > 1 ? ($page - 1) * 10 : 0);
                                /** @var \App\Entities\Recruitment $item */
                                foreach ($data as $item) {
                                    $student = $item->getStudent() instanceof \App\Entities\Student ? $item->getStudent() : '-';
                                ?>
                                    <tr class="even pointer">
                                        <td>{{ $no++ }}.</td>
                                        <td>{{ $student->getName() ? $student->getName() : '-' }}</td>
                                        <td>{{ $student->getStudyProgram() instanceof \App\Entities\StudyProgram ? $student->getStudyProgram()->getName() : '-' }}</td>
                                        <td>{{ $item->getJobTitle() instanceof \App\Entities\JobTitle ? $item->getJobTitle()->getName() : '-' }}</td>
                                        <td>{{ $student->getOrg() instanceof \App\Entities\Organization ? $student->getOrg()->getName() : '-' }}</td>
                                        <td>{{ $student->getIpk() ? $student->getIpk() : '-' }}</td>
                                        <td>
                                            <a href="{{ $urlUpdate($item->getId()) }}"><i class="fa fa-pencil"></i> {{ ucfirst(trans('common.edit')) }}</a> |
                                            <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ $urlDelete($item->getId()) }}" ><i class="fa fa-trash"></i> {{ ucfirst(trans('common.delete')) }}</a>
                                            <a onclick="return confirm('{{ trans('common.confirm_delete') }}')" href="{{ $urlEmail($item->getId()) }}" ><i class="fa fa-envelope"></i> {{ ucfirst(trans('common.send_email')) }}</a>
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
                    </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection
