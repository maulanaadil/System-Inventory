<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getDataPengembalian = getDataPengembalian();
$getIdPinjam = getIdPinjam();
if($db->connect_errno==0){
	if(isset($_POST['tblSimpan'])){
        $id_pinjam = $db->escape_string($_POST['id-pinjam']);
        $tgl = $db->escape_string(($_POST['tambah_tanggal_pengembalian']));
		//PDO
    	$db1=dbConnectPDO();
        try{
			$d = getPeminjaman($id_pinjam);
			for($i=0;$i<count($d);$i++){
				$array[] = array("id_barang"=>$d[$i]['id_barang'],
								 "jml_barang"=>$d[$i]['jml_barang']);
				}
            $db1->beginTransaction();
            $sh = $db1->exec("UPDATE peminjaman set tgl_kembali='$tgl' where id_pinjam ='$id_pinjam'");
            for($i=0;$i<count($array);$i++){
                $id_barang = $array[$i]['id_barang'];
                $jml_barang = $array[$i]['jml_barang'];
                $sh = $db1->exec("UPDATE barang set baik=baik+$jml_barang where id_barang='$id_barang'");
            }
            $db1->commit();
            echo "
                    <script>
                    Swal.fire({
                        title: 'Data berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        document.location.href =
                            'pengembalian.admin.php'
                    })
                    </script>";
        }catch ( PDOException $e ) {
            $db1->rollBack();
            echo (DEVELOPMENT?'ERROR : '.$e->getMessage():'');
            echo "
                <script>
                Swal.fire({
                title: 'Data gagal ditambahkan',
                icon: 'error',
                showCloseButton: true,
                })
                </script>
                ";
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
                                        <button type="button" class="btn btn-primary btn-sm me-3 view-detail"
                                            id="<?= $data['id_pinjam'] ?>">Detail</button>
                                        <!-- Modal Detail Pengembalian -->
                                        <div class="modal fade" id="modals-detail" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content text-start">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">List Barang yang Dipinjam</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body detail mt-2">
                                                    </div>
                                                    <div class="modal-footer justify-content-start">
                                                        <input type="button" class="btn btn-outline-danger"
                                                            value="Tutup" data-bs-dismiss="modal" />
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
                    <form action="" method="post">
                        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Tambah Pengembalian</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mt-2">
                                        <div class="form-group">
                                            <label for="id-pinjam-label">ID Pinjam</label>
                                            <div>
                                                <select class="form-select" aria-label="Default select example"
                                                    name="id-pinjam" id="id_pinjam">
                                                    <option value="" selected>Pilih ID Pinjam</option>
                                                    <?php foreach ($getIdPinjam as $ip) : ?>
                                                    <option value="<?= $ip['id_pinjam'] ?>">
                                                        <?= $ip['id_pinjam'] ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_tanggal_pengembalian" style="font-size: 12pt">Tanggal
                                                Pengembalian</label>
                                            <input type="date" class="form-control mt-2"
                                                id="tambah_tanggal_pengembalian" required
                                                name="tambah_tanggal_pengembalian" />
                                            <label id="info-id"></label>
                                        </div>
                                        <div id="detail">
                                            Pilih ID Peminjaman terlebih dahulu
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <input type="submit" name="tblSimpan" class="btn btn-success" id="btn-simpan" value="Simpan" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
});


$(document).ready(function() {
    $(".table-paginate").on("click", ".view-detail", function() {
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

    $("#id_pinjam").on("change", function() {
        var id_pinjam = $("#id_pinjam").val();
        var tgl = $("#tambah_tanggal_pengembalian").val();
        if (id_pinjam.length) {
            $.ajax({
                url: "../ajax.php",
                method: "post",
                data: {
                    pengembalian: id_pinjam,
                    tgl: tgl
                },
                success: function(resp) {
                    $("#detail").html(resp);
					$("#btn-simpan").prop("disabled", false);
                }
            })
        } else {
            $("#detail").html("Pilih ID Peminjaman terlebih dahulu");
			$("#btn-simpan").prop("disabled", true);
        }
    })
    $(".table-paginate").on("click", ".view-detail", function() {
        var id_pinjam = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            data: {
                detail_id_pinjam: id_pinjam
            },
            success: function(resp) {
                $("#modals-detail").modal("show");
                $(".detail").html(resp);
            }
        })
    });
});
</script>