<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getBarang = getBarang();
if($db->connect_errno==0){
?>
<div class="content-wrapper">
						<div class="row">
							<div class="col-md-12 stretch-card">
								<div class="card">
									<div class="card-body">
										<nav aria-label="breadcrumb">
											<ol class="breadcrumb">
												<li class="breadcrumb-item">
													<a href="../dashboard.html"><i class="mdi mdi-home menu-icon"></i></a>
												</li>
												<li class="breadcrumb-item"><a href="../dashboard.html">Dashboard</a></li>
												<li class="breadcrumb-item active" aria-current="page">Data Barang</li>
											</ol>
										</nav>
										<div class="me-md-3 me-xl-5 py-2">
											<h2>Data Barang</h2>
										</div>
										<div class="container-fluid mt-3 mb-3">
											<div class="row">
												<div class="col-lg-6 d-flex">
													<p>Cari Data Barang</p>
													<div class="form-outline ms-2">
														<input type="search" id="form1" class="form-search" aria-label="Search" />
													</div>
												</div>
												<div class="col-lg-6 d-flex flex-row-reverse">
													<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
												</div>
											</div>
										</div>
										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="form-tambah">Form Tambah Data Anggota</h5>
														<!-- Search -->
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body mt-2">
														<div class="form-group mt-2">
															<label for="nip-anggota" style="font-size: 12pt">NIP</label>
															<input type="text" class="form-control" id="nip" />
														</div>
														<div class="form-group">
															<label for="nama-anggota" style="font-size: 12pt">Nama</label>
															<input type="text" class="form-control" id="nama" />
														</div>
														<p>Jenis Kelamin</p>

														<div class="container-fluid ms-4">
															<div class="form-check">
																<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
																<label class="form-check-label" for="flexRadioDefault1"> Laki-Laki </label>
															</div>

															<div class="form-check">
																<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
																<label class="form-check-label" for="flexRadioDefault1"> Perempuan </label>
															</div>
														</div>
													</div>
													<div class="modal-footer justify-content-start">
														<button type="button" class="btn btn-primary">Simpan</button>
														<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Reset</button>
													</div>
												</div>
											</div>
										</div>

										<div class="table-responsive">
											<table id="data-anggota" class="table table-hover" style="text-align: center">
												<thead>
													<tr>
														<th rowspan="2">ID Barang</th>
														<th rowspan="2">Nama Barang</th>
														<th colspan="3">Kondisi</th>
														<th rowspan="2">Jumlah</th>
														<th rowspan="2">Sumber</th>
														<th rowspan="2">Tanggal</th>
														<th rowspan="2">Aksi</th>
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
														<td><?php echo "JUMLAH CENAH"; ?></td>
														<td><?= $data['sumber'] ?></td>
														<td><?= $data['tanggal'] ?></td>
														<td>
															<button type="button" class="btn btn-warning btn-sm me-3">Edit</button>
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
<?php 
include("footer.admin.php");
}else{
    echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
}
?>;