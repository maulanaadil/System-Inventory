<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getKategori = getKategori();
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
							<li class="breadcrumb-item active" aria-current="page">Data Kategori Barang</li>
						</ol>
					</nav>
					<div class="me-md-3 me-xl-5 py-2">
						<h2>Data Kategori Barang</h2>
					</div>
					<div class="container-fluid mt-3 mb-3">
						<div class="row">
							<div class="d-flex flex-row-reverse">
								<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
							</div>
						</div>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<form action="#">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="form-tambah">Form Tambah Data Kategori Barang</h5>
									<!-- Search -->
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body mt-2">
									<div class="form-group mt-2">
										<label for="nip-anggota" style="font-size: 12pt">Id Kategori Barang</label>
										<input type="text" class="form-control" id="id_kat_barang" />
									</div>
									<div class="form-group">
										<label for="nama-anggota" style="font-size: 12pt">Nama Kategori Barang</label>
										<input type="text" class="form-control" id="nama_kat_barang" />
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

					<div class="table-responsive">
						<table id="data-anggota" class="table table-hover" style="text-align: center">
							<thead>
								<tr>
									<th>Id Kategori Barang</th>
									<th>Nama Kategori Barang</th>
									<th>Aksi</th>
								</tr>
								
							</thead>
							<tbody>
								<?php foreach ($getKategori as $data) :?>
								<tr>
									<td><?= $data['id_kat'] ?></td>
									<td><?= $data['nm_kat'] ?></td>
									<td>
										<button type="button" class="btn btn-warning btn-sm me-3">Edit</button>
										<button type="button" class="btn btn-danger btn-sm me-3">Hapus</button>
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