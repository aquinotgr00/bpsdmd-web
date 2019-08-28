@extends('layout.main')
@section('style')
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
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
						<div class="form-group">
							<label for="usr">Tanggal :</label>
							<input type="text" class="form-control datepicker" id="usr" name="created_at">
						</div>
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
								<span class="help-block">Ketentuan nama file : ddmmyyyy_nama_file.xls</span>

							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="inputGroupFile01"
								aria-describedby="inputGroupFileAddon01" name="file">
								<span class="help-block ">{!! implode('', $errors->get('file')) !!}</span>

							</div>
						</div>
						<div class="box-footer">
							<button class="btn btn-primary pull-right">Simpan</button>
						</div>
					</form>
					<div class="page-header">
						<h2>Sekolah Tinggi Transportasi Darat (STTD) Bekasi.</h2>
						<div class="col-md-4 pull-right">
							<div class="col-xs-6 col-sm-6 pilih-ta">
								<h5>Pilih tahun ajaran:</h5>
							</div>
							<div class="col-xs-6 col-sm-6">
								<select class="form-control">
									<option>2019</option>
									<option>2018</option>
									<option>2017</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Judul Upload</th>
								<th>Nama File</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Suplai data bulan Januari</td>
								<td>16012019_STTD_Bekasi.xlsx</td>
								<td>
									<label class="btn btn-primary" for="my-file-selector">
										<input id="my-file-selector" type="file" style="display:none" 
										onchange="$(this).parents('label').next('.file-name').html(this.files[0].name)">
										Button Text Here
									</label>
									<span class='file-name' ></span>
								</td>
								{{-- <td><button type="button" class="btn btn-success btn-sm">Update file</button></td> --}}
							</tr>
							<tr>
								<td>2</td>
								<td>Suplai data bulan Februari</td>
								<td>16022019_STTD_Bekasi.xlsx</td>
								<td><button type="button" class="btn btn-success btn-sm">Update file</button></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Suplai data bulan Februari</td>
								<td><span class="text-red">- File belum tersedia -</span></td>
								<td><input type="file" class="" /></td>
							</tr>
						</tbody>
					</table>
					<div class="box-body"></div>
				</div>
			</div>
		</div>
	</div>

	@endsection

	@section('script')

	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {
			$('.datepicker').datepicker( {
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'yy-mm',
				onClose: function(dateText, inst) { 
					$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
				}
			});
		});
	</script>
	@endsection