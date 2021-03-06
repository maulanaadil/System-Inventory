<?php
include("sidebar.admin.php");
// include("../functions.php");
// $db=dbConnect();
$getSupplier = getSupplier();
if($db->connect_errno==0){
	if(isset($_POST['tambahSupplier'])) {
		$id_supplier = $db->escape_string($_POST['tambah_id_supplier']);
		$nm_supplier = $db->escape_string($_POST['tambah_nama_supplier']);
		$sql = "INSERT into supplier values ('$id_supplier', '$nm_supplier')";
		$res= $db->query($sql);
		if ($res) {
			if ($db->affected_rows>0) {
				 echo "<script>
                Swal.fire({
                    title: 'Data Supplier berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    document.location.href = 'supplier.admin.php'
                })
                </script>";
			}
		} else {
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
                            <li class="breadcrumb-item active" aria-current="page">Data Supplier</li>
                        </ol>
                    </nav>
                    <div class="me-md-3 me-xl-5 py-2">
                        <h2>Data Supplier</h2>
                    </div>
                    <div class="container-fluid mt-3 mb-3">
                        <div class="row">
                            <div class="d-flex flex-row-reverse">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah"
                                    <?=$_SESSION['hak_akses']=="kepala"?"hidden":""?>>Tambah</button>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="data-anggota" class="table table-hover" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>Id Supplier</th>
                                    <th>Nama Supplier</th>
                                    <th <?=$_SESSION['hak_akses']=="kepala"?"hidden":""?>>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($getSupplier as $data) :?>
                                <tr>
                                    <td><?= $data['id_supplier'] ?></td>
                                    <td><?= $data['nm_supplier'] ?></td>
                                    <td <?=$_SESSION['hak_akses']=="kepala"?"hidden":""?>>
                                        <button type="button" class="btn btn-warning btn-sm me-3 view-edit"
                                            id="<?= $data['id_supplier'] ?>">Edit</button>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="modals-edit" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method="post" id="insert_form">
                                                    <div class="modal-content text-start">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="form-tambah">Form Edit Data
                                                                Supplier</h5>
                                                            <!-- Search -->
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mt-2">
                                                            <div class="form-group mt-2">
                                                                <label for="nip-anggota" style="font-size: 12pt">Id
                                                                    Supplier</label>
                                                                <input type="text" class="form-control"
                                                                    id="edit_id_supplier" name="ubah_supplier" required
                                                                    readonly />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama-anggota" style="font-size: 12pt">Nama
                                                                    Supplier</label>
                                                                <input type="text" class="form-control"
                                                                    id="edit_nama_supplier" name="nama_supplier"
                                                                    required />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-start">
                                                            <button type="submit" class="btn btn-primary" name="insert"
                                                                id="insert" value="Insert">Simpan</button>
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm me-3 hapus"
                                            id="<?=$data["id_supplier"]?>">Hapus</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Tambah -->
                    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="form-tambah">Form Tambah Data Supplier</h5>
                                    <!-- Search -->
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <div class="modal-body mt-2">
                                        <div class="form-group mt-2">
                                            <label for="nip-anggota" style="font-size: 12pt">Id Supplier</label>
                                            <input type="text" class="form-control" id="tambah_id_supplier"
                                                name="tambah_id_supplier" />
                                            <label id="info-id"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama-anggota" style="font-size: 12pt">Nama Supplier</label>
                                            <input type="text" class="form-control" id="tambah_nama_supplier"
                                                name="tambah_nama_supplier" />
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <input type="submit" name="tambahSupplier" value="Simpan"
                                            class="btn btn-primary" />
                                        <input type="reset" class="btn btn-outline-danger" />
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
                    $("#edit_id_supplier").val(resp.data.id_supplier);
                    $("#edit_nama_supplier").val(resp.data.nm_supplier);
                    $("#modals-edit").modal("show");
                }
            }
        })
    })

    $("#tambah_id_supplier").on('keyup', function() {
        let id_supplier = $("#tambah_id_supplier").val();
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                cek_id_supplier: id_supplier
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    $("#info-id").html("ID Supplier dapat digunakan");
                    $("#info-id").css("color", "green");
                    $(".tblTambah").removeAttr("disabled");

                } else if (resp.status === "ERROR") {
                    $("#info-id").html("ID Supplier tidak dapat digunakan");
                    $("#info-id").css("color", "red");
                    $(".tblTambah").attr("disabled", "disabled");
                }
            }
        })
    })
    $(".hapus").on("click", function() {
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
                    Swal.fire({
                        title: 'Apakah anda yakin menghapus data<br>' + resp.data
                            .nm_supplier + ' ?',
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
                                    hapus_supplier: id_supplier
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
                                                'supplier.admin.php'
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
    })
    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#nama_supplier').val() == "") {
            alert("Nama Supplier tidak boleh kosong");
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
                                document.location.href = "supplier.admin.php";
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