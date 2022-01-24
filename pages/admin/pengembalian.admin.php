<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getDataPengembalian = getDataPengembalian();
$getIdPinjam = getIdPinjam();
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
							<li class="breadcrumb-item active" aria-current="page">Data Pengembalian</li>
						</ol>
					</nav>
					<div class="me-md-3 me-xl-5 py-2">
						<h2>Data Pengembalian</h2>
					</div>
					<div class="container-fluid mt-3 mb-3">
						<div class="row">
							<div class="col-lg-12 d-flex flex-row-reverse">
								<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah">Tambah</button>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table id="data-anggota" class="table table-hover table-paginate" style="text-align: center">
							<thead>
								<tr>
									<th>ID Pinjam</th>
									<th>Nama Peminjam</th>
									<th>Tgl Kembali</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($getDataPengembalian as $data) :?>
								<tr>
									<td><?= $data['id_pinjam'] ?></td>
									<td><?= $data['nama'] ?></td>
									<td><?= date("d F Y", strtotime($data['tanggal'])); ?></td>
									<td>
										<button type="button" class="btn btn-primary btn-sm me-3 view-detail" id="<?= $data['id_pinjam'] ?>">Detail</button>

										<!-- Modal Detail Pengembalian -->
										<div class="modal fade" id="modals-detail" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                    <div class="modal-content text-start">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">List Barang yang Dipinjam</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mt-2">
															<div class="table-responsive">
																<table class="table" >
																   <thead>
																	   <tr style="background-color: white;">
																		   <th>Nama Barang</th>
																		   <th>Qty</th>
																	   </tr>
																   </thead>
																   <tbody>
																	   <tr>
																		   <td><p id="detail_nama_barang"></p></td>
																		   <td><p id="detail_qty_barang"></p></td>
																	   </tr>
																   </tbody>
														   </table>
														   </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-start">
                                                            <input type="reset" class="btn btn-outline-danger" value="Tutup"
                                                                data-bs-dismiss="modal" />
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
										<!-- End Modal Detail Pengembalian -->
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>


					<!-- Modal Tambah Pengembalian -->
					<div class="modal fade" id="modalTambah" tabindex="-1"
						aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
								<div class="modal-content text-start">
									<div class="modal-header">
										<h5 class="modal-title">Form Tambah Pengembalian</h5>
										<button type="button" class="btn-close"
											data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body mt-2">
										<div class="form-group">
											<label for="id-pinjam-label">ID Pinjam</label>
											<div>
												<form action="" method="post">
												<select class="form-select"
													aria-label="Default select example" name="idpinjam" id="idpinjam">
													<option selected >Pilih ID Pinjam</option>
													<?php foreach ($getIdPinjam as $ip) : ?>
													<option value="<?= $ip['id_pinjam'] ?>"><?= $ip['id_pinjam'] ?></option>
													<?php endforeach; ?>
												</select>
												</form>
											</div>
										</div>
										<div class="form-group">
											<label for="id_tanggal_pengembalian" style="font-size: 12pt">Tanggal Pengembalian</label>
												<input type="date" class="form-control mt-2" id="tambah_tanggal_pengembalian"
													name="tambah_tanggal_pengembalian" />
											<label id="info-id"></label>
										</div>

										<div class="table-responsive">
											<table class="table" id="table-barang">
												<thead>
													<tr style="background-color: white;">
														<th>Nama Barang</th>
														<th>Jumlah</th>
													</tr>
												</thead>
												<tbody>	
													<?php $idpinjam = "<script>document.write(idPinjam)</script>"?>
													<?php $getRincianPeminjaman = getRincianPeminjaman($idpinjam); ?>
													<?php foreach($getRincianPeminjaman as $data) : ?>
														<tr>
															<td><?= $data['nm_barang']?> </td>
															<td><?= $data['qty']?> </td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal-footer justify-content-start">
										<input type="reset" class="btn btn-success" value="Simpan"
											data-bs-dismiss="modal" />
									</div>
								</div>
						</div>
					</div>

					<!-- End Modal Tambah Pengembalian -->

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

<script type="text/javascript">

	$(document).ready(function() {
    	$('.table-paginate').dataTable();


		$('select[name=idpinjam]').on('change', function() {
			var idPinjam = this.value;
			console.log(idPinjam);

			if (!!idPinjam) {
				$('#table-barang').find('tbody')
									.append('<?php $idpinjam = "<script>document.write(idPinjam)</script>"?>')
										.append('<?php $getRincianPeminjaman = getRincianPeminjaman($idpinjam); ?>')
											.append('<?php foreach($getRincianPeminjaman as $data) : ?>')
												.append('<tr>')
													.append('<td><?= $data['nm_barang']?> </td>')
													.append('<td><?= $data['qty']?> </td>')
												.append('</tr>')
											.append('<?php endforeach; ?>')
			}
		});
	});

	$(document).ready(function() {
    $(".table-paginate").on("click",".view-detail", function() {
        var id_pinjam = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_pinjam: id_pinjam
            },
            success: function(resp) {
                if (resp.status === "OK") {
					console.log(resp.data);
                    $("#detail_nama_barang").text(resp.data.nm_barang);
                    $("#detail_qty_barang").text(resp.data.jml_barang);
                    $("#modals-detail").modal("show");
                }
            }
        })
    });

});


</script>