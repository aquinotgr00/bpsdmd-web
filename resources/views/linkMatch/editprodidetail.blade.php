@extends('layout.main')
@section('content')
<section class="content-header">
    <h1>Edit Relasi Link and Match <br /><small>STPI CURUG D-III Teknik Listrik Bandara</small></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="2afeDsRvN951yVEvOWxSdVLtgVZcJFxvH24ruefM">

                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="license">Pilih Lisensi :</label>
                                        <select id="license" class="form-control">
                                            <option value="">Silakan pilih Lisensi</option>
                                            <option value="1" data-id="1" data-label="1 A - Pilot">1 A - Pilot</option>
                                            <option value="19" data-id="19" data-label="1 B - Pemandu lalu lintas penerbangan">1 B - Pemandu lalu lintas penerbangan</option>
                                            <option value="84" data-id="84" data-label="1 C - Personel Bidang Teknik Bandar Udara">1 C - Personel Bidang Teknik Bandar Udara</option>
                                            <option value="123" data-id="123" data-label="1 D - Personel Keamanan Penerbangan">1 D - Personel Keamanan Penerbangan</option>
                                            <option value="130" data-id="130" data-label="1 G - Medical Check Up">1 G - Medical Check Up</option>
                                            <option value="2" data-id="2" data-label="1.1 A - Private Pilot">1.1 A - Private Pilot</option>
                                            <option value="20" data-id="20" data-label="1.1 B - Aerodrome control">1.1 B - Aerodrome control</option>
                                        </select>

                                        <div style="text-align: right;margin: 10px 0 30px 0;">
                                            <a href="javascript:void(0)" class="btn btn-default btnChooser">Pilih</a>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="128">
                                                    <span class="name">3 D - Personel Pelayanan PKP-PK</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="92">
                                                    <span class="name">3.1 C - Airfield Lighting System</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="93">
                                                    <span class="name">3.2 C - Constant Current Regulator</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="95">
                                                    <span class="name">3.4 C - Generator Set dan Automatic Change Over Switch (ACOS)</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="96">
                                                    <span class="name">3.5 C - Transmisi &amp; Distribusi</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="hidden" name="license[]" value="97">
                                                    <span class="name">3.6 C - Uninterruptible Power Supply (UPS) danSolar Cell</span>
                                                    <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="instansi-demand">Pilih Instansi Demand :</label>
                                        <select id="instansi-demand" class="form-control">
                                            <option value="">Silakan pilih Instansi Demand</option>
                                            <option>AirNav</option>
                                            <option>KAI</option>
                                            <option>Pelni</option>
                                        </select>
                                        <br /><br />
                                        <!-- sesuai matra, jika matra instansi udara, maka tampilkan semua jabatan yang terhubung dengan matra udara -->
                                        <label for="license">Pilih Jabatan :</label>
                                        <select id="license" class="form-control">
                                            <option value="">Silakan pilih Jabatan</option>
                                            <option>AERONAUTICAL COMMUNICATION OFFICER</option>
                                            <option>AERONAUTICAL INFORMATION SERVICE OFFICER</option>
                                            <option>AIR TRAFFIC CONTROLLER</option>
                                        </select>

                                        <div style="text-align: right;margin: 10px 0 30px 0;">
                                            <a href="javascript:void(0)" class="btn btn-default btnChooser">Pilih</a>
                                        </div>

                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="hidden" name="license[]" value="128">
                                                <span class="name">AIS DATABASE OFFICER</span>
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="hidden" name="license[]" value="128">
                                                <span class="name">AIS PUBLICATION OFFICER</span>
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs pull-right btnRemove">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <span class="help-block"></span>
                            </div>

                            <div class="box-footer" style="text-align: right;min-height: 50px;">
                                <button class="btn btn-primary pull-right">Ubah Relasi Link and Match</button>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </div>
</section>
@endsection
