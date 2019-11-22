@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>{{ ucwords(trans('common.short_course_data')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ $urlUpdate($data->getId()) }}">
                    <i class="fa fa-edit"></i> {{ ucfirst(trans('common.edit')) }} {{ ucwords(trans('common.short_course_data')) }}
                </a>
            </li>
            <li>
                <a href="{{ route('administrator.shortCourseParticipant.create', Request::segment(2)) }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.short_course_participant')) }}
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('layout.partial.alert')
            <!-- left column -->
            <div class="col-lg-12">
                <div class="panel panel-default">
                <!-- Default panel contents -->
                    <div class="panel-heading">
                        <span class="label label-primary" style="margin-right:10px;">
                            {{ ucfirst(trans('common.open_sk')) }}
                            : {{ $data->getOpenSk() ? $data->getOpenSk() : '-' }}
                        </span>
                        <span class="label label-primary">
                            {{ ucfirst(trans('common.close_sk')) }}
                            : {{ $data->getOpenSk() ? $data->getCloseSk() : '-' }}
                        </span>
                    </div>
                    <div class="panel-body">
                        <h3>HUMAN FACTOR RECURRENT FOR AIRCRAFT MAINTENANCE 2 {{ $data->getYear() }}</h3>
                        <p>
                            {{ $data->getPlace() }}
                        </p>
                    </div>

                <!-- List group -->
                    <ul class="list-group">
                        <li class="list-group-item">{{ $data->getStartDate() instanceof DateTime ? $data->getStartDate()->format('d F Y') : '-' }} - {{ $data->getEndDate() instanceof DateTime ? $data->getEndDate()->format('d F Y') : '-'}} ({{ $data->getShortCourseTime() ? $data->getShortCourseTime() : '-' }} Hari)</li>
                        <li class="list-group-item">
                            <span class="label label-info" style="margin-right:10px;">
                            {{ ucfirst(trans('common.total_target_student')) }}
                            : {{ $data->getTotalTarget() ? $data->getTotalTarget() : '-' }}
                            </span>
                            <span class="label label-success">
                            {{ ucfirst(trans('common.total_realization_student')) }}
                            : {{ $data->getTotalRealization() ? $data->getTotalRealization() : '-' }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="box">
            <div class="box-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>{{ ucfirst(trans('common.employee_code')) }}</th>
                      <th>{{ ucfirst(trans('common.photo')) }}</th>
                      <th>{{ ucfirst(trans('common.name')) }}</th>
                      <th>{{ ucfirst(trans('common.email')) }}</th>
                      <th>{{ ucfirst(trans('common.gender')) }}</th>
                      <th>{{ ucfirst(trans('common.graduate')) }}</th>
                      <!-- <th>{{ ucfirst(trans('common.action')) }}</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($shortCourseParticipants as $participant)
                      <tr>
                        <td>{{ $participant->getEmployee()->getCode() }}</td>
                        <td>{{ $participant->getEmployee()->getPhoto() }}</td>
                        <td>{{ $participant->getEmployee()->getName() }}</td>
                        <td>{{ $participant->getEmployee()->getEmail() }}</td>
                        <td>{{ $participant->getEmployee()->getGender() }}</td>
                        <td>{{ $participant->getGraduate() == 1 ? trans('common.graduate'):trans('common.not_yet') }}</td>
                        <!-- <td></td> -->
                      </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
    </section><!-- /.content -->
@endsection
