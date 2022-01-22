<?php
include("sidebar.admin.php");
include("../functions.php");

$db=dbConnect();
$getBarang = getBarang();
$getDataPeminjaman = getDataPeminjaman();
$getDataPengembalian = getDataPengembalian();
if($db->connect_errno==0){
?>

<div class="content-wrapper">
<div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="barang-tab" data-bs-toggle="tab" href="#barang" role="tab"
                                aria-controls="barang" aria-selected="true">Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="peminjaman-tab" data-bs-toggle="tab" href="#peminjaman" role="tab"
                                aria-controls="peminjaman" aria-selected="false">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pengembalian-tab" data-bs-toggle="tab" href="#pengembalian" role="tab"
                                aria-controls="pengembalian" aria-selected="false">Pengembalian</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="barang" role="tabpanel"
                            aria-labelledby="barang-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                    <div class="table-responsive">
                                    <table id="data-anggota" class="table table-hover table-paginate" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">ID Barang</th>
                                                <th rowspan="2">Nama Barang</th>
                                                <th colspan="3">Kondisi</th>
                                                <th rowspan="2">Jumlah</th>
                                                <th rowspan="2">Sumber</th>
                                                <th rowspan="2">Tanggal</th>
                                            </tr>
                                            <td>Baik</td>
                                            <td>Rusak</td>
                                            <td>Rusak Berat</td>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($getBarang as $data) :?>
                                            <tr>
                                                <td><?= $data['id_barang'] ?></td>
                                                <td><?= $data['nm_barang'] ?></td>
                                                <td><?= $data['baik'] ?></td>
                                                <td><?= $data['rusak'] ?></td>
                                                <td><?= $data['rusak_berat'] ?></td>
                                                <td><?= sum($data['baik'], $data['rusak'], $data['rusak_berat']) ?></td>
                                                <td><?= $data['sumber'] ?></td>
                                                <td><?= date("d F Y", strtotime($data['tanggal']));?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="tab-pane fade" id="peminjaman" role="tabpanel"
                            aria-labelledby="peminjaman-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">
                            <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <div class="d-flex flex-column justify-content-around">
                                        <div class="table-responsive">
											<table id="data-anggota" class="table table-hover" style="text-align: center">
												<thead>
													<tr>
														<th>ID Pinjam</th>
														<th>Nama Peminjam</th>
														<th>Tgl Pinjam</th>
													</tr>
												</thead>
												<tbody>
                                                    <?php foreach ($getDataPeminjaman as $data) :?>
													<tr>
														<td><?= $data['id_pinjam'] ?></td>
														<td><?= $data['nama'] ?></td>
														<td><?= 
															date("d F Y", strtotime($data['tanggal']));
														 ?></td>
													</tr>
                                                    <?php endforeach; ?>
												</tbody>
											</table>
										</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pengembalian" role="tabpanel"
                            aria-labelledby="pengembalian-tab">
                        <div class="d-flex flex-wrap justify-content-xl-between">
                            <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                <div class="d-flex flex-column justify-content-around">
                                        <div class="table-responsive">
											<table id="data-anggota" class="table table-hover" style="text-align: center">
												<thead>
													<tr>
														<th>ID Pinjam</th>
														<th>Nama Peminjam</th>
														<th>Tgl Kembali</th>
													</tr>
												</thead>
												<tbody>
                                                    <?php foreach ($getDataPengembalian as $data) :?>
													<tr>
														<td><?= $data['id_pinjam'] ?></td>
														<td><?= $data['nama'] ?></td>
														<td><?= 
															date("d F Y", strtotime($data['tanggal']));
														 ?></td>
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
                    
                    


<?php 
include("footer.admin.php");
}else{
    echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
}
?>                                