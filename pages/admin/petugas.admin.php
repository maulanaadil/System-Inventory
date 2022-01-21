<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getDataPetugas = getDataPetugas();
if($db->connect_errno==0){
	if(isset($_POST['tambahPetugas'])){
        $id_petugas = $db->escape_string($_POST['id_petugas']);
        $nama = $db->escape_string($_POST['nama']);
        $jk = $db->escape_string($_POST['jk']);
		$username = $db->escape_string($_POST['username']);
		$password = $db->escape_string($_POST['password']);
		$hak_akses = $db->escape_string($_POST['hak_akses']);
		$reset_question = $db->escape_string($_POST['reset_question']);
		$answer_question = $db->escape_string($_POST['answer_question']);
		$alamat = $db->escape_string($_POST['alamat']);
		$no_hp = $db->escape_string($_POST['no_hp']);
        // $sql = "INSERT into anggota values('$nip','$nama','$jk')";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                echo "<script>
                Swal.fire({
                    title: 'Data petugas berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    document.location.href = 'petugas.admin.php'
                })
                </script>";
            }
        }else {
            echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'ERROR',
                text: 'Data gagal ditambahkan!'
                })
                </script>";
            echo 'Gagal Eksekusi SQL' . (DEVELOPMENT ? ' : ' . $db->error : '') . "<br>";
        }
    }
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

                                        <!-- Modal Tambah Petugas-->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-scrollable">
												<form action="#">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="form-tambah">Form Tambah Data Petugas</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
                                                    <div class="modal-body mt-2">
														<div class="form-group mt-2">
															<label for="nip-anggota">Nama</label>
															<input type="text" class="form-control" name="nama"/>
														</div>
														<p>Jenis Kelamin</p>
														<div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="jk" id="jk" value="L">
                                                            Laki - Laki
                                                            <i class="input-helper"></i></label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="jk" id="jk" value="P">
                                                            Perempuan
                                                            <i class="input-helper"></i></label>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
															<label for="hak-akses">Hak Akses</label>
															<div>
																<select class="form-select" aria-label="Default select example" name="hak-akses">
																	<option selected>Pilih Hak Akses</option>
																	<option value="admin">Admin</option>
																	<option value="kepala">Kepala</option>
																	<option value="laboran">Laboran</option>
																</select>
															</div>
														</div>
														<div class="form-group mt-2">
                                                            <label for="nip-anggota">Username</label>
															<input type="text" class="form-control" name="username"/>
                                                        </div>
														<div class="row">
															<div class="col-6">
																<div class="form-group mt-2">
																	<label for="nip-anggota">Password</label>
																	<input type="text" class="form-control" name="password"/>
																</div>
															</div>
															<div class="col-6">
																<div class="form-group mt-2">
																	<label for="nip-anggota">Repeat Password</label>
																	<input type="text" class="form-control" name="repeat-password"/>
																</div>
															</div>
														</div>
														<div class="form-group mt-2">
															<div class="form-group">
																<select class="form-select" aria-label="Default select example" name="pertanyaan-reset">
																	<option selected>Pilih Pertanyaan Reset</option>
																	<option value="Siapa nama hewan peliharaan anda?">Siapa nama hewan peliharaan anda?</option>
																	<option value="Siapa nama guru favorit anda saat sekolah?">Siapa nama guru favorit anda saat sekolah?</option>
																	<option value="Dimanakah tempat lahir anda?">Dimanakah tempat lahir anda?</option>
																</select>
															</div>
															<input type="text" class="form-control" name="jawaban" placeholder="Masukan jawabannya disini"/>
                                                        </div>
														<div class="row">
															<div class="col-6">
																<div class="form-group mt-2">
																	<label for="alamat">Alamat</label>
																	<input type="text" class="form-control" name="alamat"/>
																</div>
															</div>
															<div class="col-6">
																<div class="form-group mt-2">
																	<label for="nip-anggota">No Handphone</label>
																	<input type="text" onkeypress="validate(event)" class="form-control" name="no-handphone"/>
																</div>
															</div>
														</div>
                                                    </div>
													<div class="modal-footer justify-content-start">
														<input type="submit" value="Simpan" class="btn btn-primary"></input>
														<input type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal"></input>
													</div>
												</div>
												</form>
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
															<!--Button Edit-->
															<button type="button" class="btn btn-warning btn-sm me-3 view-edit" id="<?=$data["id_petugas"]?>">Edit</button>
															<!-- Modal Edit Petugas-->
															<div class="modal fade" id="modals-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content text-start">
																		<div class="modal-header">
																			<h5 class="modal-title" id="form-tambah">Form Edit Data Petugas</h5>
																			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>
																		<div class="modal-body mt-2">
																			<div class="form-group mt-2">
																				<label for="nip-anggota">Nama</label>
																				<input type="text" class="form-control" id="nama_anggota" name="nama_anggota"/>
																			</div>
																			<p>Jenis Kelamin</p>
																			<div class="form-group">
																				<div class="form-check">
																					<label class="form-check-label">
																					<input type="radio" class="form-check-input" name="jk" id="jk" value="L">
																					Laki - Laki
																					<i class="input-helper"></i></label>
																				</div>
																				<div class="form-check">
																					<label class="form-check-label">
																					<input type="radio" class="form-check-input" name="jk" id="jk" value="P">
																					Perempuan
																					<i class="input-helper"></i></label>
																				</div>
																			</div>
																			<div class="form-group">
																				<label for="hak-akses">Hak Akses</label>
																				<div>
																					<select class="form-select" aria-label="Default select example" name="hak-akses" id="hak-akses">
																						<option selected>Pilih Hak Akses</option>
																						<option value="admin">Admin</option>
																						<option value="kepala">Kepala</option>
																						<option value="laboran">Laboran</option>
																					</select>
																				</div>
																			</div>
																			<div class="form-group mt-2">
																				<label for="uname">Username</label>
																				<input type="text" class="form-control" name="uname" id="uname"/>
																			</div>
																			<div class="row">
																				<div class="col-6">
																					<div class="form-group mt-2">
																						<label for="password">Password</label>
																						<input type="text" class="form-control" name="password" id="password"/>
																					</div>
																				</div>
																				<div class="col-6">
																					<div class="form-group mt-2">
																						<label for="repeat-password">Repeat Password</label>
																						<input type="text" class="form-control" name="repeat-password" id="repeat-password"/>
																					</div>
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
<script>
$(document).ready(function() {
    $(".view-edit").on("click", function() {
        var id_petugas = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_petugas: id_petugas
            },
            success: function(resp) {
                if (resp.status === "OK") {
					console.log(resp.data);
                    $("#nama_anggota").val(resp.data.nm_petugas);
					$("#hak-akses").val(resp.data.hak_akses);
					$("#uname").val(resp.data.username);
                    let jk = resp.data.jk;
                    if (jk === "L") {
                        $("input[name=jk][value=" + jk + "]").prop('checked', true);
                    } 
                    else if (jk === "P") {
                        $("input[name=jk][value=" + jk + "]").prop('checked', true);
                    }
                    $("#modals-edit").modal("show");
                }

            }
        })
    });
});

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>