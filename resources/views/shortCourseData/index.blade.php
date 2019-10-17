@extends('layout.main')

@section('content')
    <section class="content-header">
        <h1>Data {{ ucwords(trans('common.short_course_data')) }}</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ $urlUpdate($data->getId()) }}">
                    <i class="fa fa-edit"></i> {{ ucfirst(trans('common.edit')) }} {{ ucwords(trans('common.short_course_data')) }}
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.short_course_participant')) }}
                </a>
            </li>
            <li>
                <a href="{{ $urlCreate }}">
                    <i class="fa fa-plus-circle"></i> {{ ucfirst(trans('common.add')) }} {{ ucwords(trans('common.short_course_data')) }}
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('layout.partial.alert')
            <!-- left column -->
            <div class="col-md-4">
                <div class="box">
                    <div class="box-body">
                        <table>
                          <tr>
                            <td>{{ ucfirst(trans('common.start_date')) }}</td>
                            <td>: {{ $data->getStartDate()->format('d F Y') }}</td>
                          </tr>
                          <tr>
                            <td>{{ ucfirst(trans('common.end_date')) }}</td>
                            <td>: {{ $data->getEndDate()->format('d F Y') }}</td>
                          </tr>
                          <tr>
                            <td>{{ ucfirst(trans('common.total_target_student')) }}</td>
                            <td>: {{ $data->getTotalTarget() ? $data->getTotalTarget() : '-' }}</td>
                          </tr>
                          <tr>
                            <td>{{ ucfirst(trans('common.total_realization_student')) }}</td>
                            <td>: {{ $data->getTotalRealization() ? $data->getTotalRealization() : '-' }}</td>
                          </tr>
                        </table>
                    </div>
                </div><!-- /.box -->
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-body">
                        <table>
                          <tr>
                            <td>{{ ucfirst(trans('common.open_sk')) }}</td>
                            <td>: {{ $data->getOpenSk() ? $data->getOpenSk() : '-' }}</td>
                          </tr>
                          <tr>
                            <td>{{ ucfirst(trans('common.close_sk')) }}</td>
                            <td>: {{ $data->getCloseSk() ? $data->getCloseSk() : '-' }}</td>
                          </tr>
                          <tr>
                            <td>{{ ucfirst(trans('common.generation')) }}</td>
                            <td>: {{ $data->getGeneration() ? $data->getGeneration() : '-' }}</td>
                          </tr>
                        </table>
                    </div>
                </div><!-- /.box -->
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-body">
                        <table>
                          <tr>
                            <td>{{ ucfirst(trans('common.year')) }}</td>
                            <td>: {{ $data->getYear() }}</td>
                          </tr>
                          <tr>
                            <td>{{ ucfirst(trans('common.short_course_time')) }}</td>
                            <td>: {{ $data->getShortCourseTime() ? $data->getShortCourseTime() : '-' }}</td>
                          </tr>
                          <tr>
                            <td>{{ ucfirst(trans('common.place')) }}</td>
                            <td>: {{ $data->getPlace() }}</td>
                          </tr>
                        </table>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>{{ ucfirst(trans('common.employee_code')) }}</th>
                  <th>{{ ucfirst(trans('common.photo')) }}</th>
                  <th>{{ ucfirst(trans('common.name')) }}</th>
                  <th>{{ ucfirst(trans('common.email')) }}</th>
                  <th>{{ ucfirst(trans('common.gender')) }}</th>
                  <th>{{ ucfirst(trans('common.graduate')) }}</th>
                  <th>{{ ucfirst(trans('common.action')) }}</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
    </section><!-- /.content -->
@endsection