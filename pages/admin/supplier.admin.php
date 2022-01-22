<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getSupplier = getSupplier();
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
							<li class="breadcrumb-item active" aria-current="page">Data Supplier</li>
						</ol>
					</nav>
					<div class="me-md-3 me-xl-5 py-2">
						<h2>Data Supplier</h2>
					</div>
					<div class="container-fluid mt-3 mb-3">
						<div class="row">
							<div class="d-flex flex-row-reverse">
								<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
							</div>
						</div>
					</div>
					

					<div class="table-responsive">
						<table id="data-anggota" class="table table-hover" style="text-align: center">
							<thead>
								<tr>
									<th>Id Supplier</th>
									<th>Nama Supplier</th>
									<th>Aksi</th>
								</tr>
								
							</thead>
							<tbody>
								<?php foreach ($getSupplier as $data) :?>
								<tr>
									<td><?= $data['id_supplier'] ?></td>
									<td><?= $data['nm_supplier'] ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm me-3 view-edit" id="<?= $data['id_supplier'] ?>">Edit</button>
										<!-- Modal Edit -->
										<div class="modal fade" id="modals-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<form action="#">
												<div class="modal-content text-start">
													<div class="modal-header">
														<h5 class="modal-title" id="form-tambah">Form Tambah Data Supplier</h5>
														<!-- Search -->
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body mt-2">
														<div class="form-group mt-2">
															<label for="nip-anggota" style="font-size: 12pt">Id Supplier</label>
															<input type="text" class="form-control" id="id_supplier" />
														</div>
														<div class="form-group">
															<label for="nama-anggota" style="font-size: 12pt">Nama Supplier</label>
															<input type="text" class="form-control" id="nama_supplier" />
														</div>
													</div>
													<div class="modal-footer justify-content-start">
														<input type="submit" value="Simpan" class="btn btn-primary" />								
														<input type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" />
													</div>
												</div>
												</form>
											</div>
										</div>
										<button type="button" class="btn btn-danger btn-sm me-3">Hapus</button>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					
					<!-- Modal Tambah -->
					<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<form action="#">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="form-tambah">Form Tambah Data Supplier</h5>
									<!-- Search -->
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body mt-2">
									<div class="form-group mt-2">
										<label for="nip-anggota" style="font-size: 12pt">Id Supplier</label>
										<input type="text" class="form-control" id="id_supplier" />
									</div>
									<div class="form-group">
										<label for="nama-anggota" style="font-size: 12pt">Nama Supplier</label>
										<input type="text" class="form-control" id="nama_supplier" />
									</div>
								</div>
								<div class="modal-footer justify-content-start">
									<input type="submit" value="Simpan" class="btn btn-primary" />								
									<input type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" />
								</div>
							</div>
							</form>
						</div>
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
<script>
$(document).ready(function() {
    $(".view-edit").on("click", function() {
        var id_supplier = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post", 
            dataType: "json",
            data: {
                id_supplier: id_supplier
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    $("#id_supplier").val(resp.data.id_supplier);
                    $("#nama_supplier").val(resp.data.nm_supplier);
                    $("#modals-edit").modal("show");
                }
            }
        })
    });
});
</script>