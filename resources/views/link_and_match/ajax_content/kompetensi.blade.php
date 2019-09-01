@if(!empty($kompetensi))
<tbody>
	@foreach($kompetensi as $parent)
	<tr>
		<td>
			<ul> 
				<li>
					<a href="javascript:void(0)" data-kompetensi-id="{{ $parent['id'] }}" data-kompetensi-bab="{{ $parent['bab'] }}" class="kompetensi">{{ $parent['nama'] }}</a>
					@if(!empty($parent['children']))
					<ul>
						@foreach($parent['children'] as $child)
						<li> <a href="javascript:void(0)" data-kompetensi-id="{{ $child['id'] }}" data-kompetensi-bab="{{ $parent['bab'] }}" class="kompetensi">{{ $child['nama'] }}</a> 
							@if(!empty($child['children']))
							<ul>
								@foreach($child['children'] as $grandchild)

								<li> <a href="javascript:void(0)" data-kompetensi-id="{{ $grandchild['id'] }}" data-kompetensi-bab="{{ $parent['bab'] }}" class="kompetensi">{{ $grandchild['nama'] }}</a></li>

								@endforeach

							</ul>
							@endif

						</li>

						@endforeach
					</ul>
					@endif

				</li>
			</ul>​

		</td>
	</tr>
	@endforeach
</tbody>
@endif