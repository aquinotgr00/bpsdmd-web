@if(!empty($demand))
@foreach($demand as $job)
<div class="supply-item">
	<div class="row sales-report">
		<div class="">
			<h3>{{ $job->job_title }}</h3>
			<p>{{$job->namaunit}}</p>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<tbody>
				@if(!empty($job->match))
				@foreach($job->match as $lisensi)
					<tr>
						<td class="txt-oflo">{{ $lisensi->nama }}</td>
					</tr>

				@endforeach
				@endif
				<tr>
					<td class="txt-oflo"><span class="label label-success label-rounded">{{ count($job->match) }}/{{ count($kompetensi) }} Kompetensi sesuai</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endforeach
@endif