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
                    <div class="col-xs-6 col-sm-3">
                        <div class="white-box">
                            <form method="GET" action="">
                                <h3 class="box-title m-b-0">Pencarian Detail</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Jabatan</label>
                                            <select class="form-control" id="license"><option value="" selected="">--pilih--</option><option value="1">AERONAUTICAL COMMUNICATION OFFICER</option><option value="2">AERONAUTICAL INFORMATION SERVICE OFFICER</option><option value="3">AIR TRAFFIC CONTROLLER</option><option value="4">AIS DATABASE OFFICER</option><option value="5">AIS PUBLICATION OFFICER</option><option value="6">NOTAM OFFICE OFFICER</option><option value="7">FLIGHT DATA OFFICER</option><option value="8">CENTRALIZED FLIGHT PLAN OFFICER</option><option value="9">STAF ADMINISTRASI</option><option value="10">STAF KESELAMATAN</option><option value="11">TEKNISI TELEKOMUNIKASI</option><option value="12">TEKNISI CENTRALIZED FLIGHT PLAN</option><option value="13">TEKNISI PENUNJANG</option><option value="14">STAF ATFM</option><option value="15">STAF PELAPORAN DATA</option><option value="16">SUPERVISOR TEKNIK TELEKOMUNIKASI</option><option value="17">SUPERVISOR TEKNIK PENUNJANG</option><option value="18">TEKNISI NOTAM OFFICE</option><option value="19">PERANCANG PROSEDUR PENERBANGAN</option><option value="20">KARTOGRAFER</option></select>
                                            <input type="hidden" name="id_job_title" value="" id="hidden-license-job-title">
                                            <span class="help-block" id="span-helper"> Filter program studi dengan kompetensi yang dicari </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group lisensi">
                                            <label class="control-label" id="label-license" style="display: none;">Lisensi</label>
                                            <div class="progress" style="display:none;">
                                                <div class="progress-bar progress-bar-info active progress-bar-striped" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 100%" role="progressbar"> <span class="sr-only">Processing</span> </div>
                                            </div>
                                            <div class="" id="list-license" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group rentang-usia">
                                            <label class="control-label">Rentang Usia</label><br>
                                            <input type="number" id="usia" class="form-control" value="" placeholder="min." name="usia" step="1" min="21">
                                            <input type="number" id="usia-max" class="form-control" value="" placeholder="max" name="usiamax" step="1" min="21">
                                            <span class="help-block">Usia minimal 21 tahun </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Indeks Prestasi Kumulatif</label>
                                            <input type="number" id="ipk" class="form-control" value="" placeholder="" name="ipk" step="0.01" min="0" max="4"> <span class="help-block"> IPK Minimal pelamar adalah 2.5 </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Jenis Kelamin</label>
                                            <select class="form-control" id="license" name="jenis_kelamin">
                                                <option value="" selected="">Semua</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <span class="help-block">Jenis Kelamin</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Akreditasi</label>
                                            <select class="form-control" id="akreditasi" name="akreditasi">
                                                <option value="" selected="">Semua</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="N/A">N/A</option>
                                            </select>
                                            <span class="help-block">Akreditasi sekolah</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn-block btn-info m-t-10"><i class=" ti-search"></i> Cari Taruna</button>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8 search-result-students">
                        <div class="row overview-results">
                            <div class="white-box m-b-15">
                                <div class="row row-in">
                                    <!-- <div class="col-lg-3 col-sm-6 row-in-br demand-logo b-r-none">
                                        <ul class="col-in">
                                            <li class="col-middle">
                                                <img src="/bo/demand/home/static/plugins/images/logo-airnav.jpeg" alt="" />
                                            </li>
                                        </ul>
                                    </div> -->
                                    <div class="col-lg-3 col-sm-6 row-in-br hasil-pencarian b-r-none">
                                        <ul class="col-in">
                                            <li class="col-last">
                                                <h3 class="counter text-right m-t-15">0</h3>
                                            </li>
                                            <li class="col-middle">
                                                <h4>Hasil Pencarian</h4>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                        <span class="sr-only">40% Complete (success)</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 daftar-penawaran b-0">
                                        <ul class="col-in">
                                            <li>
                                                <a href=""><span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span></a>
                                            </li>
                                            <li class="col-last">
                                                <h3 class="counter text-right m-t-15">0</h3>
                                            </li>
                                            <li class="col-middle">
                                                <h4 style="font-size:14px;">Daftar Penawaran Kandidat</h4>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                        <span class="sr-only">40% Complete (success)</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="white-box">
                                <div class="table-responsive">
                                    <table id="daftar_taruna" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Asal Sekolah</th>
                                                <th>Jenjang</th>
                                                <th>Tahun Kelulusan</th>
                                                <th>IPK</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td><button class="btn btn-block btn-info" data-toggle="modal" data-target="detail-siswa-offer-modal">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Cedric Kelly</td>
                                                <td>Senior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2012/03/29</td>
                                                <td>$433,060</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Airi Satou</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>33</td>
                                                <td>2008/11/28</td>
                                                <td>$162,700</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Brielle Williamson</td>
                                                <td>Integration Specialist</td>
                                                <td>New York</td>
                                                <td>61</td>
                                                <td>2012/12/02</td>
                                                <td>$372,000</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Herrod Chandler</td>
                                                <td>Sales Assistant</td>
                                                <td>San Francisco</td>
                                                <td>59</td>
                                                <td>2012/08/06</td>
                                                <td>$137,500</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Rhona Davidson</td>
                                                <td>Integration Specialist</td>
                                                <td>Tokyo</td>
                                                <td>55</td>
                                                <td>2010/10/14</td>
                                                <td>$327,900</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Colleen Hurst</td>
                                                <td>Javascript Developer</td>
                                                <td>San Francisco</td>
                                                <td>39</td>
                                                <td>2009/09/15</td>
                                                <td>$205,500</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Sonya Frost</td>
                                                <td>Software Engineer</td>
                                                <td>Edinburgh</td>
                                                <td>23</td>
                                                <td>2008/12/13</td>
                                                <td>$103,600</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Jena Gaines</td>
                                                <td>Office Manager</td>
                                                <td>London</td>
                                                <td>30</td>
                                                <td>2008/12/19</td>
                                                <td>$90,560</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Quinn Flynn</td>
                                                <td>Support Lead</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2013/03/03</td>
                                                <td>$342,000</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Charde Marshall</td>
                                                <td>Regional Director</td>
                                                <td>San Francisco</td>
                                                <td>36</td>
                                                <td>2008/10/16</td>
                                                <td>$470,600</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Haley Kennedy</td>
                                                <td>Senior Marketing Designer</td>
                                                <td>London</td>
                                                <td>43</td>
                                                <td>2012/12/18</td>
                                                <td>$313,500</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Tatyana Fitzpatrick</td>
                                                <td>Regional Director</td>
                                                <td>London</td>
                                                <td>19</td>
                                                <td>2010/03/17</td>
                                                <td>$385,750</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Michael Silva</td>
                                                <td>Marketing Designer</td>
                                                <td>London</td>
                                                <td>66</td>
                                                <td>2012/11/27</td>
                                                <td>$198,500</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Paul Byrd</td>
                                                <td>Chief Financial Officer (CFO)</td>
                                                <td>New York</td>
                                                <td>64</td>
                                                <td>2010/06/09</td>
                                                <td>$725,000</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Gloria Little</td>
                                                <td>Systems Administrator</td>
                                                <td>New York</td>
                                                <td>59</td>
                                                <td>2009/04/10</td>
                                                <td>$237,500</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Bradley Greer</td>
                                                <td>Software Engineer</td>
                                                <td>London</td>
                                                <td>41</td>
                                                <td>2012/10/13</td>
                                                <td>$132,000</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                            <tr>
                                                <td>Dai Rios</td>
                                                <td>Personnel Lead</td>
                                                <td>Edinburgh</td>
                                                <td>35</td>
                                                <td>2012/09/26</td>
                                                <td>$217,500</td>
                                                <td><button class="btn btn-block btn-info">Detail</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <!-- Modal -->
                <div id="detail-siswa-offer-modal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection
