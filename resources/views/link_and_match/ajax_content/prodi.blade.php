@if(!empty($units))
@foreach($units as $unit)
<li class="">
    <a href="javascript:void(0)" class="prodi" data-unit-id="{{ $unit['idunit'] }}">
        <h3>{{ $unit['namaunit'] }}</h3>
        <small>{{ $instansi }}</small>
    </a>
</li>
@endforeach
@endif