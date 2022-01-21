<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getDataPeminjaman = getDataPeminjaman();
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
													<a href="./index.php"><i class="mdi mdi-home menu-icon"></i></a>
												</li>
												<li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
												<li class="breadcrumb-item active" aria-current="page">Data Peminjaman</li>
											</ol>
										</nav>
										<div class="me-md-3 me-xl-5 py-2">
											<h2>Data Peminjaman</h2>
										</div>
										<div class="container-fluid mt-3 mb-3">
											<div class="row">
												<div class="col-lg-6 d-flex">
													<p>Cari Data Peminjaman</p>
													<div class="form-outline ms-2">
														<input type="search" id="cari-peminjaman" class="form-search" aria-label="Search" />
													</div>
												</div>
												<div class="col-lg-6 d-flex flex-row-reverse">
													<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
												</div>
											</div>
										</div>

										<div class="table-responsive">
											<table id="data-anggota" class="table table-hover" style="text-align: center">
												<thead>
													<tr>
														<th>ID Pinjam</th>
														<th>Nama Peminjam</th>
														<th>Tgl Pinjam</th>
														<th>Aksi</th>
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
														<td>
															<button type="button" class="btn btn-primary btn-sm me-3">Detail</button>
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