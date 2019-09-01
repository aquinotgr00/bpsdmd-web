@extends('layout.main')

@section('style')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />

@endsection

@section('content')
<section class="content-header">
    <h1>Link And Match</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 demand-page--demand-column">
                            <div class="white-box">
                                <h3 class="box-title">Supply</h3>
                                <div class="form-group">
                                    <select class="form-control select2" name="unit">
                                        <option></option>
                                        @if(!empty($unit))
                                        @foreach($unit as $parent)
                                        
                                        <optgroup label="{{ $parent['namaunit'] }}">

                                            @if(!empty($parent['children']))

                                            @foreach($parent['children'] as $child)
                                            <option value="{{ $child['idunit'] }}">{{ $child['namaunit'] }}</option>
                                            @endforeach

                                            @endif
                                            
                                        </optgroup>

                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                              {{--   <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle select2" data-toggle="dropdown">
                                        Sekolah Tinggi Penerbangan Indonesia (STPI) Curug
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Matra Darat</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Sekolah Tinggi Transportasi Darat (STTD) Bekasi</a></li>
                                        <li><a href="#">Politeknik Keselamatan Transportasi Jalan (PKTJ) Tegal</a></li>
                                        <li><a href="#">Akademi Perkertapian Indonesia (APKAI) Madiun</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Matra Laut</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Sekolah Tinggi Ilmu Pelayaran (STIP) Marunda, Jakarta</a></li>
                                        <li><a href="#">Politeknik Ilmu Pelayaran (PIP) Semarang</a></li>
                                        <li><a href="#">Politeknik Pelayaran Surabaya (PPS) Surabaya</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Matra Udara</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Sekolah Tinggi Penerbangan Indonesia (STPI) Curug</a></li>
                                        <li><a href="#">Politeknik Penerbangan Surabaya</a></li>
                                        <li><a href="#">Akademi Teknik dan Keselamatan Penerbangan (ATKP) Medan</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                            <div class="white-box">
                                <div class="panel-body">
                                    <ul class="chatonline">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="white-box">
                                <h3 class="box-title">Kompetensi</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-kompetensi">

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 demand-page--supply-column">
                            <div class="white-box">
                                <h3 class="box-title">Demand</h3>
                                <div class="demand-content"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name=unit]').select2({
            placeholder: "Pilih Instansi",
        }).on('select2:select', function(event) {
            event.preventDefault();
            $('.demand-content').html('')
            $('.table-kompetensi').html('');  

            let iam = $(this).select2('data');

            $.ajax({
                url: "{{ route('linknmatch.getProdiByInstansi') }}",
                type: 'GET',
                dataType: 'JSON',
                data: {unit: iam[0].id, namaunit : iam[0].text},
            })
            .done(function(res) {
                if (res.status == 200) {
                    $('.chatonline').html(res.prodi);  
                }
                else{
                    Swal.fire({
                        title: 'Info',
                        type: 'info',
                        html:res.message,
                        showCloseButton: true,
                        showCancelButton: false,
                    })
                }
            })
            .fail(function() {
                Swal.fire({
                    title: 'Oopss',
                    type: 'error',
                    html: 'Terjadi kesalahan, silakan hubungi web administrator',
                    showCloseButton: true,
                    showCancelButton: false,
                })
            })
            .always(function() {
            });

        });
        $(document).on('click', '.prodi', function(event) {
            event.preventDefault();
            let iam = $(this);
            $('.table-kompetensi').html('');  
            $('.demand-content').html('')

            iam.parents('li').siblings().removeClass('active');
            iam.parents('li').addClass('active');
            $.ajax({
                url: "{{ route('linknmatch.getKompetensiByProdi') }}",
                type: 'GET',
                dataType: 'JSON',
                data: {prodi: iam.data('unit-id')},
            })
            .done(function(res) {
                if (res.status == 200) {
                    $('.table-kompetensi').html(res.kompetensi);  
                }
                else{
                    Swal.fire({
                        title: 'Info',
                        type: 'info',
                        html:res.message,
                        showCloseButton: true,
                        showCancelButton: false,
                    })
                }
            })
            .fail(function() {
            })
            .always(function() {
            });
        });
        $(document).on('click', '.kompetensi', function(event) {
            event.preventDefault();
            $('.demand-content').html('')
            let iam = $(this);
            $.ajax({
                url: "{{ route('linknmatch.getDemandByKompetensi') }}",
                type: 'GET',
                dataType: 'JSON',
                data: {id: iam.data('kompetensi-id'), bab: iam.data('kompetensi-bab')},
            })
            .done(function(res) {
                if (res.status == 200) {
                    $('.demand-content').html(res.demand)
                }
                else{
                    Swal.fire({
                        title: 'Info',
                        type: 'info',
                        html:res.message,
                        showCloseButton: true,
                        showCancelButton: false,
                    })
                }
            })
            .fail(function() {
            })
            .always(function() {
            });
            
            /* Act on the event */
        });
    });
</script>
@endsection