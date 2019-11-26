@extends('layout.main')
@section('content')
<section class="content-header">
    <h1>Edit Link and Match - STPI Curug <small>Pilih Program Studi</small></h1>
</section>

<!-- Main content -->
<section class="content">
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
                                        <th>Jenjang</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                                                    <tr class="even pointer">
                                        <td>1.</td>
                                        <td>423002-32404</td>
                                        <td>Pertolongan Kecelakaan Pesawat</td>
                                        <td>D3</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/19/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>2.</td>
                                        <td>423002-40308</td>
                                        <td>Teknik Navigasi Udara</td>
                                        <td>D4</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/35/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>3.</td>
                                        <td>423002-40301</td>
                                        <td>Pemanduan Lalu Lintas Udara</td>
                                        <td>D4</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/40/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>4.</td>
                                        <td>423002-40402</td>
                                        <td>Penerangan Aeronautika</td>
                                        <td>D3</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/41/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>5.</td>
                                        <td>423002-61507</td>
                                        <td>Operasi Bandar Udara</td>
                                        <td>D2</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/41/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>6.</td>
                                        <td>423002-21411</td>
                                        <td>Teknik Mekanikal Bandar Udara</td>
                                        <td>D3</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/41/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>7.</td>
                                        <td>423002-36403</td>
                                        <td>Teknik Bangunan dan Landasan</td>
                                        <td>D3</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/41/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>8.</td>
                                        <td>423002-40307</td>
                                        <td>Teknik Pesawat Udara</td>
                                        <td>D4</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/41/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>9.</td>
                                        <td>423002-13541</td>
                                        <td>Pertolongan Kecelakaan Pesawat</td>
                                        <td>D2</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/41/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
                                        </td>
                                    </tr>
                                                                    <tr class="even pointer">
                                        <td>10.</td>
                                        <td>423002-61405</td>
                                        <td>Operasi Bandar Udara</td>
                                        <td>D3</td>
                                        <td>
                                            <a href="http://127.0.0.1:8000/org/13/program/41/update"><i class="fa fa-pencil"></i> Edit Link and Match</a>
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
                                                                                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/org/13/program?page=2">2</a></li>


                        <li class="page-item">
                    <a class="page-link" href="http://127.0.0.1:8000/org/13/program?page=2" rel="next" aria-label="Berikutnya »">›</a>
                </li>
                </ul>

                            </nav>
                        </div>
                    </div><!-- /.box -->
                </div>
            </div>
        </section><!-- /.content -->
</section>
@endsection
