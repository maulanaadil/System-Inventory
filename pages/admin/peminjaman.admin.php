<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getDataPeminjaman = getDataPeminjaman();
$getDataBarang = getBarang();
if($db->connect_errno==0){
	$Id = "PJM-";
    $sql = "SELECT MAX(CAST(SUBSTRING(id_pinjam,5) AS SIGNED)) as id_pinjam FROM peminjaman";
    $res=$db->query($sql);
    if($res){
        if($res->num_rows>0){
            $data = $res->fetch_assoc();
            $count = (int)$data['id_pinjam'];
            $Id .= $count+1;
        }else{
            $Id = "PJM-1";
        }
    }
	if(isset($_POST['simpan'])){
        $id = $_POST['id_barang'];
        $jml = $_POST['jml'];
		$nm_barang = $_POST['nm_barang'];
        $id_anggota = $db->escape_string($_POST['tambah_nama_peminjam']);
        $id_pinjam = $db->escape_string($_POST['tambah_id_pinjam']);
        $tanggal = $db->escape_string($_POST['tambah_tanggal_peminjaman']);
        $petugas = "P01";
        // echo "<pre>";
		// var_dump($id_anggota);
		// var_dump($id_pinjam);
		// var_dump($tanggal);
        // var_dump($id);
        // var_dump($jml);
		// var_dump($nm_barang);die;
		for($i=0; $i<count($id);$i++){
            $array[]=array("id_barang"=>$id[$i],
						   "nm_barang"=>$nm_barang[$i],
                           "id_anggota"=>$id_anggota,
                           "id_pinjam"=>$id_pinjam,
                           "tanggal"=>$tanggal,
                           "id_petugas"=>$petugas,
                           "jumlah"=>$jml[$i]);
        }
		$db1=dbConnectPDO();
        try{
            $query = "";
            $db1->beginTransaction();
            $sh = $db1->exec("INSERT INTO peminjaman VALUES('$id_pinjam','$petugas','$id_anggota','$tanggal','null')");
                for($i=0;$i<count($array);$i++){
                    $id_barang = $array[$i]['id_barang'];
                    $id_anggota = $array[$i]['id_anggota'];
                    $id_pinjam = $array[$i]['id_pinjam'];
                    $tanggal = $array[$i]['tanggal'];
                    $id_petugas = $array[$i]['id_petugas'];
                    $jumlah = $array[$i]['jumlah'];
                    $query .= "('$id_pinjam','$id_barang','$jumlah'), ";
                    $sh = $db1->exec("UPDATE barang SET baik=baik-'$jumlah' WHERE barang.id_barang='$id_barang'");
                }
            $sh = $db1->exec("INSERT INTO rincian_peminjaman VALUES ".rtrim($query,", "));
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
                            'peminjaman.admin.php'
                    })
                    </script>";
        }catch ( \PDOException $e ) {
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
                    <form action="" method="post">
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
                                <div class="col-lg-12 d-flex flex-row-reverse">
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalTambah">Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-peminjaman" class="table table-hover table-paginate"
                                style="text-align: center">
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
                                            <button type="button" class="btn btn-primary btn-sm me-3 view-detail"
                                                id="<?= $data['id_pinjam'] ?>">Detail</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal Detail Peminjaman -->
                        <div class="modal fade" id="modals-detail" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-start">
                                    <div class="modal-header">
                                        <h5 class="modal-title">List Barang yang Dipinjam</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body detail mt-2">
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <input type="reset" class="btn btn-outline-danger" value="Tutup"
                                            data-bs-dismiss="modal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Detail Peminjaman -->
                        <!-- Modal Tambah Peminjaman -->
                        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable"
                                style="width: 1100px; margin: 1.75rem 50px;">
                                <div class="modal-content text-start" style="width: 1100px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Tambah Peminjaman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mt-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="id_pinjam" style="font-size: 12pt">ID Pinjam</label>
                                                <input type="text" class="form-control mt-2" id="tambah_id_pinjam"
                                                    name="tambah_id_pinjam" value="<?=$Id?>" readonly />
                                                <label id="info-id"></label>
                                            </div>
                                            <div class="col-6">
                                                <label for="id_tanggal_peminjaman" style="font-size: 12pt">Tanggal
                                                    Peminjaman</label>
                                                <input type="date" class="form-control mt-2"
                                                    id="tambah_tanggal_peminjaman" name="tambah_tanggal_peminjaman"
                                                    required />
                                                <label id="info-id"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="id_nama_peminjam" style="font-size: 12pt">Nama
                                                    Peminjam</label>
                                                <select class="form-select mb-4 mt-2" name="tambah_nama_peminjam"
                                                    id="tambah_nama_peminjam" autocomplete="off" required>
                                                    <option value="" selected>Pilih</option>
                                                    <?php
													$k = getAnggota();
													foreach($k as $row):?>
                                                    <option value="<?=$row['id_anggota'];?>"><?=$row['nm_anggota'];?>
                                                    </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="table-responsive">
                                                    <table class="table table-paginate">
                                                        <thead>
                                                            <tr style="background-color: white;">
                                                                <th>ID Barang</th>
                                                                <th>Nama Barang</th>
                                                                <th>Jumlah</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
														foreach($getDataBarang as $dataBarang):
														$jml =  getJumlahBarang($dataBarang['id_barang']);
														?>
                                                            <tr>
                                                                <td><?=$dataBarang['id_barang'];?></td>
                                                                <td><?=$dataBarang['nm_barang'];?></td>
                                                                <td><?=(int)$jml['jumlah'];?>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary pinjam"
                                                                        id="<?=$dataBarang['id_barang']."-".$dataBarang['nm_barang']?>"
                                                                        name="pinjam-barang">Pinjam</button>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach;?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <table class="table" id="rincian">
                                                    <thead>
                                                        <tr style="background-color: white;">
                                                            <th>ID Barang</th>
                                                            <th>Jumlah</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td><button type="button" id="simpan"
                                                                    class="btn btn-success"
                                                                    data-bs-target="#staticBackdrop"
                                                                    data-bs-toggle="modal" hidden>Simpan</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <input type="reset" class="btn btn-outline-danger" value="Tutup"
                                            data-bs-dismiss="modal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Tambah Peminjaman -->
                        <!-- Modal Konfirmasi simpan -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" style="color: black;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
                                    </div>
                                    <div class="modal-body">
                                        Apakah data yang dimasukkan sudah benar?
                                        Jika benar maka klik simpan.
                                        <div id="isi"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-target="#modalTambah"
                                            data-bs-toggle="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

    $(".table-paginate").on("click", ".pinjam", function() {
        var id_barang = $(this).attr("Id");
        const myArray = id_barang.split("-");
        $("#rincian tbody").append("<tr><td><input type='text' name='nm_barang[]' id='nm_brg' value='" +
            myArray[1] +
            "' style='width:6rem;'></td><td><input type='number' name='jml[]' id='jml' style='width:4rem;'></td><td><button class='btn btn-danger btn-sm' id='hapus'><i class='mdi mdi mdi-delete text-white'></i></button></td>"
        );
        $("#rincian tbody").append("<input type='hidden' name='id_barang[]' id='id_brg' value='" +
            myArray[0] +
            "'>")
        $("#simpan").removeAttr("hidden");
    });
    $("#rincian tbody").on('click', '#hapus', function(event) {
        $(this).parent().parent().remove();
        if ($("#rincian tbody").children().length == 0) {
            $("#simpan").attr("hidden", "hidden");
        }
    });
    // $("#simpan").on("click", function() {
    //     // var jml = $(this).val();
    //     // var id = $("#rincian").find("#id_brg", this).val();
    //     $("#staticBackdrop").modal("show");
    // })
});


$(document).ready(function() {
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