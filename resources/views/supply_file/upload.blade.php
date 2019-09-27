@extends('layout.main')

@section('content')

@php
$loggedUser = currentUser();
$year = date('Y');
@endphp

<section class="content-header">
	<h1>Upload File</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ $message }}</strong>
					</div>
					@endif

					@if ($message = Session::get('error'))
					<div class="alert alert-danger alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>{{ $message }}</strong>
					</div>
					@endif
					<form method="post" enctype="multipart/form-data">
						@csrf

						<div class="page-header">
							<h2>{{$loggedUser->getOrg()->getName()}}.</h2>
							<div class="col-md-4 pull-right">
								<div class="col-xs-6 col-sm-6 pilih-ta">
									<h5>Pilih tahun ajaran:</h5>
								</div>
								<div class="col-xs-6 col-sm-6">
									<select class="form-control" name="year">
										@for($i=0; $i <= 5; $i++)
										<option value="{{ ($year-$i) }}" {{ ($year-$i) == Request::segment(3) ? 'selected' : '' }}>{{ ($year-$i) }}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<span class="help-block">Ketentuan nama file : ddmmyyyy_nama_file.xls</span>
						<span class="help-block">Ketentuan maksimal ukuran file : 1MB</span>
						<table class="table">
							<thead>
								<tr>
									<th width="10%">#</th>
									<th width="20%">Judul Upload</th>
									<th style="text-align: center;width: 30%">Nama File</th>
									<th style="text-align: center;width: 40%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($files))
									@foreach($files as $key => $file)
									<tr>
										<td>{{ $key+1 }}</td>
										<td>
											<input type="hidden" name="months[]" value="{{ sprintf('%02s', $key+1) }}">
											Suplai data bulan {{ date('F',mktime(0, 0, 0, ($key+1), 10)) }}
										</td>
										<td style="text-align: center;width: 30%">
											<input type="hidden" name="file_id[]" value="{{ !empty($file->id) ? $file->id : '' }}">
											{!! !empty($file->file_name) ? $file->file_name :'<span class="text-red">- File belum tersedia -</span>' !!}
										</td>
										<td style="text-align: center;width: 40%">
											@if(!empty($file))
											<label class="btn btn-success" for="my-file-selector{{ $key+1 }}">
												<input id="my-file-selector{{ $key+1 }}" type="file" style="display:none" name="files[]"
												onchange="$(this).parents('label').next('.file-name').html(this.files[0].name)" accept=".xls,.xlsx">
												Update File
											</label>
											<span class='file-name' ></span>
											@else
											<label class="btn btn-info" for="my-file-selector{{ $key+1 }}">
												<input id="my-file-selector{{ $key+1 }}" type="file" style="display:none" name="files[]"
												onchange="$(this).parents('label').next('.file-name').html(this.files[0].name)" accept=".xls,.xlsx">
												Upload File
											</label>
											<span class='file-name' ></span>
											@endif
										</td>
										{{-- <td><button type="button" class="btn btn-success btn-sm">Update file</button></td> --}}
									</tr>
									@endforeach
								@endif

							</tbody>
						</table>
						<div class="box-footer">
							<button class="btn btn-primary pull-right">Simpan</button>
						</div>
					</form>
					<div class="box-body"></div>
				</div>
			</div>
		</div>
	</div>

	@endsection

	@section('script')
	<script type="text/javascript" name>
		$(function() {
			$(document).on('change', 'select[name=year]', function(event) {
				event.preventDefault();
				window.location.replace("/feeder/upload/"+$(this).val())
			});
		});
	</script>
	@endsection
