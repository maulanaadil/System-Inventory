<?php
include("sidebar.admin.php");
include("functions.index.php");

// VARIABEL SUM ANGGOTA
$jumlahAnggota = getSumAnggota()->fetch_array();
$jumlahAnggotaLaki = getSumAnggotaLaki()->fetch_array();
$jumlahAnggotaPerempuan = getSumAnggotaPerempuan()->fetch_array();

// VARIABEL SUM BARANG
$jumlahBarang = getSumBarang()->fetch_array();
$jumlahBarangBaik = getSumBarangBaik()->fetch_array();
$jumlahBarangRusak = getSumBarangRusak()->fetch_array();
$jumlahBarangRusakBerat = getSumBarangRusakBerat()->fetch_array();

// VARIABEL SUM SUPPLIER
$jumlahSupplier = getSumSupplier()->fetch_array();

// VARIABEL TABLE RIWAYAT PEMINJAMAN BARANG
$getRiwayatPeminjamanBarang = getRiwayatPeminjamanBarang();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Selamat Datang Kembali</h2>
                        <p class="mb-md-0">berikut adalah data yang dikelola saat ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="anggota-tab" data-bs-toggle="tab" href="#anggota" role="tab"
                                aria-controls="anggota" aria-selected="true">Anggota</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="barang-tab" data-bs-toggle="tab" href="#barang" role="tab"
                                aria-controls="barang" aria-selected="false">Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="supplier-tab" data-bs-toggle="tab" href="#supplier" role="tab"
                                aria-controls="supplier" aria-selected="false">Supplier</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="anggota" role="tabpanel"
                            aria-labelledby="barang-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account-multiple-outline icon-lg me-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Anggota</small>
                                        <h5 class="mb-0 d-inline-block"><?= $jumlahAnggota[0]  ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-gender-male me-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Laki Laki</small>
                                        <h5 class="me-2 mb-0"><?= $jumlahAnggotaLaki[0]  ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-gender-female icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Perempuan</small>
                                        <h5 class="me-2 mb-0"><?= $jumlahAnggotaPerempuan[0]  ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="barang" role="tabpanel" aria-labelledby="barang-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-archive icon-lg me-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Barang</small>
                                        <h5 class="mb-0 d-inline-block"><?= $jumlahBarang[0] ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-check-all me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Kondisi Baik</small>
                                        <h5 class="me-2 mb-0"><?= $jumlahBarangBaik[0] ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-minus icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Kondisi Rusak</small>
                                        <h5 class="me-2 mb-0"><?= $jumlahBarangRusak[0] ?></h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-minus-circle icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Kondisi Rusak Berat</small>
                                        <h5 class="me-2 mb-0"><?= $jumlahBarangRusakBerat[0] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="supplier" role="tabpanel" aria-labelledby="supplier-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-start p-3 item">
                                    <i class="mdi mdi-account-network icon-lg me-3 text-primary px-5"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Supplier</small>
                                        <h5 class="mb-0 d-inline-block"><?= $jumlahSupplier[0] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Riwayat Peminjaman Barang</p>
                    <div class="table-responsive">
                        <table id="riwayat-peminjaman-barang" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Peminjaman</th>
                                    <th>Nama Peminjaman</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Kembali</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php foreach ($getRiwayatPeminjamanBarang as $data) : ?>
                                <tr>
                                    <td><?= $data['id']; ?></td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['pinjam']; ?></td>
                                    <td><?= $data['kembali']=="0000-00-00"?"Belum dikembalikan":$data['kembali']; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<?php 
include("footer.admin.php"); 
?>