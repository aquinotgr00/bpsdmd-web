@extends('layout.main')
@section('content')
<section class="content-header">
    <h1>Edit Link and Match <small>Pilih Instansi Sekolah</small></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="even pointer">
                                <td>1.</td>
                                <td>123457</td>
                                <td>BP3 Padang Pariaman</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>2.</td>
                                <td>400001</td>
                                <td>BPPTD Palembang</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>3.</td>
                                <td>400005</td>
                                <td>BP2IP Barombong</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>4.</td>
                                <td>400006</td>
                                <td>BP2IP Mauk Tanggerang</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>5.</td>
                                <td>400007</td>
                                <td>BP2IP Sorong</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>6.</td>
                                <td>400008</td>
                                <td>BP2IP Malahayati Aceh</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>7.</td>
                                <td>400009</td>
                                <td>LP3 Banyuwangi</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>8.</td>
                                <td>400002</td>
                                <td>BPPTD Bali</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>9.</td>
                                <td>425012</td>
                                <td>Politeknik Transportasi Sungai Danau dan Penyeberangan</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>
                                                            <tr class="even pointer">
                                <td>10.</td>
                                <td>425014</td>
                                <td>Politeknik Transportasi Darat Bali</td>
                                <td>Supply</td>
                                <td>
                                    <a href="http://127.0.0.1:8000/org/2/program"><i class="fa fa-sliders"></i> Pilih Program Studi</a>
                                                                                                                </td>
                            </tr>

                                                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination" role="navigation">

                <li class="page-item disabled" aria-disabled="true" aria-label="« Sebelumnya">
            <span class="page-link" aria-hidden="true">‹</span>
        </li>





                                                                    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                                                            <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/org/supply?page=2">2</a></li>
                                                                            <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/org/supply?page=3">3</a></li>
                                                                            <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/org/supply?page=4">4</a></li>


                <li class="page-item">
            <a class="page-link" href="http://127.0.0.1:8000/org/supply?page=2" rel="next" aria-label="Berikutnya »">›</a>
        </li>
        </ul>

                    </nav>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
@endsection
