<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['tambahAnggota'])){
        $nip = $db->escape_string($_POST['nip']);
        $nama = $db->escape_string($_POST['nama']);
        $jk = $db->escape_string($_POST['jk']);
        $sql = "INSERT into anggota values('$nip','$nama','$jk')";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                echo "<script>
                Swal.fire({
                    title: 'Data anggota berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    document.location.href = 'anggota.admin.php'
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
                                <a href="index.php"><i class="mdi mdi-home menu-icon"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
                        </ol>
                    </nav>
                    <div class="me-md-3 me-xl-5 py-2">
                        <h2>Data Anggota</h2>
                    </div>
                    <div class="d-flex justify-content-end ml-auto">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
                    </div>
                    <div class="table-responsive">
                        <table id="data-anggota" class="table table-hover" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>ID Anggota</th>
                                    <th>Nama Anggota</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $k = getAnggota();
                                foreach($k as $data):
                                ?>
                                <tr>
                                    <td><?=$data["id_anggota"]?></td>
                                    <td><?=$data["nm_anggota"]?></td>
                                    <td><?=$data["jk"]=="L" ? 'Laki-Laki':'Perempuan';?></td>
                                    <td>
                                        <!--Button Edit-->
                                        <button type="button" class="btn btn-warning btn-sm me-3 view-edit" id="<?=$data["id_anggota"]?>">Edit</button>
                                        <!-- Modal Edit Anggota -->
                                        <div class="modal fade" id="modals-edit" tabindex="-1" aria-labelledby="modals-edit" aria-hidden="true" style="text-align: left">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="form-tambah">Form Edit Data Anggota</h5>
                                                        <!-- Search -->
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" id="insert_form">
                                                    <div class="modal-body mt-2">
                                                        <div class="form-group mt-2">
                                                            <label for="nip-anggota" style="font-size: 12pt">NIP</label>
                                                            <input type="text" class="form-control" id="nip" name="ubah_anggota" required readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama-anggota" style="font-size: 12pt">Nama</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" required />
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
                                                    </div>
                                                    <div class="modal-footer justify-content-start">
                                                        <button type="submit" class="btn btn-primary" name="insert" id="insert" value="Insert" >Simpan</button>
                                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" >Cancel</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--Button Hapus-->
                                        <button type="button" class="btn btn-danger btn-sm hapus" id="<?=$data["id_anggota"]?>">Hapus</button>
                                        <!--Modals Hapus Data Anggota-->
                                        <div class="modal fade" id="modals-hapus" tabindex="-1" aria-labelledby="modals-hapus" aria-hidden="true" style="text-align: left">
                                            <div class="modal-dialog" style="text-align: center;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="form-tambah"></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body mt-2" style="font-size: 20pt;">
                                                        <p1>Hapus Data Anggota</p>
                                                            <p2>Saepul</p2>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-danger">Hapus</button>
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <!-- Modal Tambah-->
                        <form method="post" action="">
                            <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="form-tambah">Form Tambah Data Anggota</h5>
														<!-- Search -->
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body mt-2">
														<div class="form-group mt-2">
															<label for="nip-anggota" style="font-size: 12pt">NIP</label>
															<input type="text" class="form-control" id="nip" name="nip" required/>
														</div>
														<div class="form-group">
															<label for="nama-anggota" style="font-size: 12pt">Nama</label>
															<input type="text" class="form-control" id="nama" name="nama" required />
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
                                                    </div>
                                                    <div class="modal-footer justify-content-start">
                                                        <inputt type="submit" class="btn btn-primary" name="tambahAnggota" >Simpan</inputt>
                                                        <input type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" ></input>
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
        var id_anggota = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_anggota: id_anggota
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    $("#nama").val(resp.data.nm_anggota);
                    let jk = resp.data.jk;
                    if (jk === "L") {
                        $("input[name=jk][value=" + jk + "]").prop('checked', true);
                    } 
                    else if (jk === "P") {
                        $("input[name=jk][value=" + jk + "]").prop('checked', true);
                    }
                    $("#nip").val(resp.data.id_anggota);
                    $("#modals-edit").modal("show");
                }

            }
        })
    });

    $(".hapus").on("click", function() {
        var id_anggota = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_anggota: id_anggota
            },
            success: function(resp){
                if (resp.status === "OK") {
                    Swal.fire({
                        title: 'Apakah anda yakin menghapus data<br>'+resp.data.nm_anggota+' ?',
                        icon: 'warning',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "../ajax.php",
                                method: "post",
                                dataType: "json",
                                data: {
                                    hapus_anggota: id_anggota
                                },
                                success: function(resp) {
                                    if (resp.status == "OK") {
                                        Swal.fire({
                                            title: 'Deleted',
                                            text: 'Data berhasil dihapus',
                                            icon: 'success',
                                            confirmButtonText: `Ok`
                                        }).then((result) => {
                                            document.location.href =
                                                'anggota.admin.php'
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
    if ($('#nama').val() == "") {
        alert("Nama tidak boleh kosong");
    } else if ($('#jk').val() == '') {
        alert("Jenis Kelamin tidak boleh kosong");
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
                            document.location.href = "anggota.admin.php";
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
});
    
</script>