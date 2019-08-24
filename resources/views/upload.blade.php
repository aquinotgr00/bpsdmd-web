@extends('layout.main')
@section('style')
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-body">
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
			<button class="btn btn-primary pull-right">Submit</button>
		</form>
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