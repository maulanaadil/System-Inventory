<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getKategori = getKategori();
if($db->connect_errno==0){
	if(isset($_POST['tambahKategori'])){
		$id_kat = $db->escape_string($_POST['tambah_id_kat_barang']);
		$nm_kat = $db->escape_string($_POST['tambah_nama_kat_barang']);
		$sql = "INSERT into kategori_barang values('$id_kat','$nm_kat')";
		$res=$db->query($sql);
		if($res){
			if($db->affected_rows>0){
                echo "<script>
                Swal.fire({
                    title: 'Data kategori berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    document.location.href = 'kategori-barang.admin.php'
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
                            <li class="breadcrumb-item active" aria-current="page">Data Kategori Barang</li>
                        </ol>
                    </nav>
                    <div class="me-md-3 me-xl-5 py-2">
                        <h2>Data Kategori Barang</h2>
                    </div>
                    <div class="container-fluid mt-3 mb-3">
                        <div class="row">
                            <div class="d-flex flex-row-reverse">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-anggota" class="table table-hover table-paginate" style="text-align: center">
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
                                        <button type="button" class="btn btn-warning me-3 view-edit"
                                            id="<?=$data["id_kat"]?>">Edit</button>
                                        <!-- Modal Edit Kategori Barang -->
                                        <div class="modal fade" id="modals-edit" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method="post" id="insert_form">
                                                    <div class="modal-content text-start">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="form-tambah">Form Tambah Data
                                                                Kategori Barang</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mt-2">
                                                            <div class="form-group mt-2">
                                                                <label for="nip-anggota">Id Kategori Barang</label>
                                                                <input type="text" class="form-control"
                                                                    id="edit_id_kat_barang" name="ubah_id_kat_barang"
                                                                    required readonly />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama-anggota">Nama Kategori Barang</label>
                                                                <input type="text" class="form-control"
                                                                    id="edit_nama_kat_barang" name="nama_kat_barang"
                                                                    required />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-start">
                                                            <input type="submit" value="Simpan" class="btn btn-primary"
                                                                name="insert" id="insert" value="Insert" />
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger me-3 hapus"
                                            id="<?=$data["id_kat"]?>">Hapus</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal Tambah Data-->
                    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="form-tambah">Form Tambah Data Kategori Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body mt-2">
                                        <div class="form-group mt-2">
                                            <label for="id_kat_barang" style="font-size: 12pt">ID Kategori
                                                Barang</label>
                                            <input type="text" class="form-control" id="tambah_id_kat_barang"
                                                name="tambah_id_kat_barang" />
                                            <label id="info-id"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama-anggota" style="font-size: 12pt">Nama Kategori
                                                Barang</label>
                                            <input type="text" class="form-control" id="tambah_nama_kat_barang"
                                                name="tambah_nama_kat_barang" />
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <input type="submit" value="Simpan" name="tambahKategori"
                                            class="btn btn-primary tblTambah" />
                                        <input type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" />
                                    </div>
                                </form>
                            </div>
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
    $('.table-paginate').dataTable();
});
$(document).ready(function() {
    $(".table-paginate").on("click",".view-edit", function() {
        var id_kat = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_kat: id_kat
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    $("#edit_id_kat_barang").val(resp.data.id_kat);
                    $("#edit_nama_kat_barang").val(resp.data.nm_kat);
                    $("#modals-edit").modal("show");
                }
            }
        })
    });
});

$(document).ready(function() {
    $("#tambah_id_kat_barang").on('keyup', function() {
        let id_kat = $("#tambah_id_kat_barang").val();
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                cek_id_kat: id_kat
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    $("#info-id").html("ID Kategori dapat digunakan");
                    $("#info-id").css("color", "green");
                    $(".tblTambah").removeAttr("disabled");

                } else if (resp.status === "ERROR") {
                    $("#info-id").html("ID Kategori tidak dapat digunakan");
                    $("#info-id").css("color", "red");
                    $(".tblTambah").attr("disabled", "disabled");
                }
            }
        })
    })
    $(".table-paginate").on("click",".hapus", function() {
        var id_kat = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_kat: id_kat
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    Swal.fire({
                        title: 'Apakah anda yakin menghapus data<br>' + resp.data
                            .nm_kat + ' ?',
                        icon: 'warning',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "../ajax.php",
                                method: "post",
                                dataType: "json",
                                data: {
                                    hapus_kat: id_kat
                                },
                                success: function(resp) {
                                    if (resp.status == "OK") {
                                        Swal.fire({
                                            title: 'Deleted',
                                            text: 'Data berhasil dihapus',
                                            icon: 'success',
                                            confirmButtonText: `Ok`
                                        }).then((result) => {
                                            document.location
                                                .href =
                                                'kategori-barang.admin.php'
                                        })
                                    } else {
                                        Swal.fire({
                                            title: 'ERROR',
                                            text: 'Data gagal dihapus',
                                            icon: 'error',
                                            showCloseButton: true,
                                        })
                                    }
                                }
                            })
                        }
                    })
                }
            }
        })
    });
    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#edit_nama_kat_barang').val() == "") {
            alert("Nama kategori tidak boleh kosong");
        } else {
            $.ajax({
                url: "../ajax.php",
                method: "post",
                dataType: "json",
                data: $('#insert_form').serialize(),
                beforeSend: function() {
                    $('#insert').val("Inserting");
                },
                success: function(resp) {
                    if (resp.status == "OK") {
                        Swal.fire({
                            title: 'Data berhasil diubah',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href =
                                    "kategori-barang.admin.php";
                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'Data gagal diubah',
                            text: 'Data sama dengan sebelumnya',
                            icon: 'error',
                            showCloseButton: true,
                        })
                    }
                },
            });
        }
    })
})
</script>