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
                    <section class="content" id="subcontent-element">
                        <section class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <form action="" method="post">
                                            <div class="box-body">
                                                <div class="form-group">
                                                   <label>Nama Sekolah</label>
                                                   <select name="sekolah" id="sekolah" class="form-control">
                                                		<option value="">-- PILIH --</option>
                                                		<option value="424007">Akademi Perkeretaapian Indonesia Madiun</option>
                                                		<option value="424005">ATKP Makassar</option>
                                                		<option value="424004">ATKP Medan</option>
                                                		<option value="424006">ATKP Surabaya</option>
                                                		<option value="400005">BP2IP Barombong</option>
                                                		<option value="400008">BP2IP Malahayati Aceh</option>
                                                		<option value="400006">BP2IP Mauk Tanggerang</option>
                                                		<option value="400007">BP2IP Sorong</option>
                                                		<option value="123456">BP3 Minahasa Selatan</option>
                                                		<option value="123457">BP3 Padang Pariaman</option>
                                                		<option value="400002">BPPTD Bali</option>
                                                		<option value="400001">BPPTD Palembang</option>
                                                		<option value="400009">LP3 Banyuwangi</option>
                                                		<option value="425007">PIP Makassar</option>
                                                		<option value="425008">PIP Semarang</option>
                                                		<option value="425006">PKTJ Tegal</option>
                                                		<option value="425009">Politeknik Pelayaran Surabaya</option>
                                                		<option value="425010">Politeknik Penerbangan Surabaya</option>
                                                		<option value="400004">Poltek Surabaya</option>
                                                		<option value="423001">STIP Marunda</option>
                                                		<option value="423002">STPI Curug</option>
                                                		<option value="423003">STTD Bekasi</option>
                                                	</select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                        <div class="box">
                                            <div class="box-header" style="cursor: move;">
                                                <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Program Studi</h3>
                                            </div>
                                            <div class="box-body" id="list-prodi">
                                               <div class="list-prodi-item" data-id="423002-39304" style="background-color: rgb(102, 102, 102); color: rgb(255, 255, 255);">D4 Lalu Lintas Udara</div>
                                               <div class="list-prodi-item" data-id="423002-61507" >D2 Operasi Bandar Udara</div>
                                               <div class="list-prodi-item" data-id="423002-61405" >D3 Operasi Bandar Udara</div>
                                               <div class="list-prodi-item" data-id="423002-40301" >D4 Pemanduan Lalu Lintas Udara</div>
                                               <div class="list-prodi-item" data-id="423002-40402" >D3 Penerangan Aeronautika</div>
                                               <div class="list-prodi-item" data-id="423002-40502" >D2 Penerangan Aeronautika</div>
                                               <div class="list-prodi-item" data-id="423002-40309" >D4 Penerbang</div>
                                               <div class="list-prodi-item" data-id="423002-32404" >D3 Pertolongan Kecelakaan Pesawat</div>
                                               <div class="list-prodi-item" data-id="423002-13541" >D2 Pertolongan Kecelakaan Pesawat</div>
                                               <div class="list-prodi-item" data-id="423002-36403" >D3 Teknik Bangunan dan Landasan</div>
                                               <div class="list-prodi-item" data-id="423002-20305" >D4 Teknik Listrik Bandara</div>
                                               <div class="list-prodi-item" data-id="423002-21411" >D3 Teknik Mekanikal Bandar Udara</div>
                                               <div class="list-prodi-item" data-id="423002-40308" >D4 Teknik Navigasi Udara</div>
                                               <div class="list-prodi-item" data-id="423002-40307" >D4 Teknik Pesawat Udara</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                    <div class="box">
                                        <div class="box-header" style="cursor: move;">
                                            <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Kompetensi Supply</h3>
                                        </div>
                                        <div class="box-body" id="kompetensi-prodi"><ul class="kompetensi-prodi"><li>Pemandu lalu lintas penerbangan</li><li>Aerodrome control</li><li>Approach control procedural</li><li>Approach control surveillance</li><li>Area control surveillance</li><li>Personel perancang prosedur penerbangan</li><li>Conventional</li></ul></div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-4" style="padding: 0px;">
                                    <div style="padding: 10px;padding-top: 0px;">
                                        <div class="box">
                                            <div class="box-header" style="cursor: move;">
                                                <h3 class="box-title" style="padding-bottom: 6px;background-color: #666666;width:100%;color: #FFFFFF;" id="box-title-one">Kompetensi Demand</h3>
                                            </div>
                                            <div class="box-body" id="demand-list">
                                                <div class="row">
                                                    <div class="col-xs-2 col-md-2" style="margin-left: 10px;">
                                                        <img src="{{ asset('img/airnav.png') }}" alt="" class="img-responsive">
                                                    </div>
                                                    <div class="col-xs-9 col-md-9" style="padding: 10px;">
                                                        <span style="font-weight: bold">AIRNAV</span>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12">
                                                        <div class="lowongan-item">
                                                            <span>AIR TRAFFIC CONTROLLER</span>
                                                            <ul class="list-kompetensi">
                                                                <li>Pemandu lalu lintas penerbangan</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                </section>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection
