<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getDataPetugas = getDataPetugas();
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
												<li class="breadcrumb-item active" aria-current="page">Data Petugas</li>
											</ol>
										</nav>
										<div class="me-md-3 me-xl-5 py-2">
											<h2>Data Petugas</h2>
										</div>
                                        <div class="d-flex justify-content-end ml-auto">
											<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
										</div>

                                        <!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="form-tambah">Form Tambah Data Petugas</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body mt-2">
														<div class="form-group mt-2">
															<label for="nip-anggota" style="font-size: 12pt">Nama</label>
															<input type="text" class="form-control" id="nama"/>
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
                                                    <div class="modal-body mt-2">
                                                        <div class="form-group mt-2">
                                                            <label for="nip-anggota" style="font-size: 12pt">Hak Akses</label>
															<input type="text" class="form-control" id="hak-akses"/>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body mt-2">
                                                        <div class="form-group mt-2">
                                                            <label for="nip-anggota" style="font-size: 12pt">Username</label>
															<input type="text" class="form-control" id="username"/>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body mt-2">
                                                        <div class="form-group mt-2">
                                                            <label for="nip-anggota" style="font-size: 12pt">Password</label>
															<input type="text" class="form-control" id="password"/>
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
											<table id="data-petugas" class="table table-hover" style="text-align: center">
												<thead>
													<tr>
														<th>ID Petugas</th>
														<th>Nama Petugas</th>
														<th>Hak Akses</th>
                                                        <th>Username</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
                                                    <?php foreach ($getDataPetugas as $data) :?>
													<tr>
														<td><?= $data['id_petugas'] ?></td>
														<td><?= $data['nm_petugas'] ?></td>
														<td><?= $data['hak_akses'] ?></td>
                                                        <td><?= $data['username'] ?></td>
														<td>
															<button type="button" class="btn btn-warning btn-sm me-3">Edit</button>
															<button type="button" class="btn btn-danger btn-sm">Hapus</button>
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

?>