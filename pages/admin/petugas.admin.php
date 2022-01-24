<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getDataPetugas = getDataPetugas();
if($db->connect_errno==0){
	if(isset($_POST['tambahPetugas'])){
        $generateID = generateIDPetugas();
            if(strlen($generateID["id"])<1){
                $id_petugas = "P01";
            }
            else if(strlen($generateID["id"])<2){
                $id_petugas = "P0". $generateID["id"];
            }else{
                $id_petugas = "P".$generateID["id"];
            }
        $nama = $db->escape_string($_POST['nama']);
        $jk = $db->escape_string($_POST['jk']);
		$username = $db->escape_string($_POST['username']);
		$password = $db->escape_string($_POST['password']);
        $repeatPassword = $db->escape_string($_POST['repeat-password']);
            if($password === $repeatPassword){
                $newpass = substr(password_hash($password,PASSWORD_DEFAULT),0,50);
            }
		$hak_akses = $db->escape_string($_POST['hak-akses']);
		$reset_question = $db->escape_string($_POST['pertanyaan-reset']);
		$answer_question = strtoupper($db->escape_string($_POST['jawaban']));
		$alamat = $db->escape_string($_POST['alamat']);
		$no_hp = $db->escape_string($_POST['no-handphone']);
        $sql = "INSERT into petugas values('$id_petugas','$nama','$username','$newpass','$hak_akses','$reset_question','$answer_question','$alamat','$no_hp','','$jk')";
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
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">Tambah</button>
                    </div>
                    <div class="table-responsive">
                        <table id="data-petugas" class="table table-hover" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>ID Petugas</th>
                                    <th>Nama Petugas</th>
                                    <th>Hak Akses</th>
                                    <th>Username</th>
                                    <th colspan=2>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getDataPetugas as $data) :?>
                                <tr>
                                    <td><?= $data['id_petugas'] ?></td>
                                    <td><?= $data['nm_petugas'] ?></td>
                                    <td><?= strtoupper($data['hak_akses']); ?></td>
                                    <td><?= $data['username'] ?></td>
                                    <td>
                                        <!--Button Edit-->
                                        <button type="button" class="btn btn-warning btn-sm me-3 view-edit"
                                            id="<?=$data["id_petugas"]?>">Edit</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm hapus"
                                            id="<?=$data["id_petugas"]?>">Hapus</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Modal Edit Petugas -->
                        <form method="post" id="insert_form">
                            <div class="modal fade" id="modals-edit" tabindex="-1" aria-labelledby="modals-edit"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content text-start">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="form-tambah">Form Edit Data
                                                Petugas
                                            </h5>
                                            <!-- Search -->
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body mt-2">
                                            <div class="form-group mt-2">
                                                <label for="nama_petugas">Nama</label>
                                                <input type="hidden" class="form-control" name="ubah_id_petugas"
                                                    id="edit_id_petugas" value="" />
                                                <input type="text" class="form-control" name="ubah_nama_petugas"
                                                    id="nama_petugas" />
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>Jenis Kelamin</p>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="jk"
                                                                    id="jk" value="L">
                                                                Laki - Laki
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="jk"
                                                                    id="jk" value="P">
                                                                Perempuan
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="hak-akses">Hak Akses</label>
                                                        <div>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="hak-akses"
                                                                id="hak-akses">
                                                                <option selected>Pilih Hak Akses
                                                                </option>
                                                                <option value="admin">Admin</option>
                                                                <option value="kepala">Kepala</option>
                                                                <option value="laboran">Laboran</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" name="username" id="username"
                                                    autocomplete="off" />
                                                <label id="info-username"></label>
                                            </div>
                                            <div class="form-group mt-2">
                                                <div class="form-group">
                                                    <label for="reset-question">Pertanyaan Reset
                                                        Password</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="pertanyaan-reset" id="reset-question">
                                                        <option selected>Pilih Pertanyaan Reset
                                                        </option>
                                                        <option value="Siapa nama hewan peliharaan anda?">
                                                            Siapa nama
                                                            hewan
                                                            peliharaan anda?</option>
                                                        <option value="Siapa nama guru favorit anda saat sekolah?">
                                                            Siapa
                                                            nama guru favorit anda saat sekolah?
                                                        </option>
                                                        <option value="Dimanakah tempat lahir anda?">
                                                            Dimanakah tempat
                                                            lahir
                                                            anda?</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="answer_question">Jawaban</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Masukan jawabannya disini" id="answer_question"
                                                            name="answer_question" />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nip-anggota">No
                                                            Handphone</label>
                                                        <input type="text" onkeypress="validate(event)"
                                                            class="form-control" name="no-handphone"
                                                            id="no_handphone" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" class="form-control" name="alamat" id="alamat" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-start">
                                            <button type="submit" class="btn btn-primary tblSimpan" name="insert"
                                                id="insert" value="Insert">Simpan</button>
                                            <button type="button" class="btn btn-outline-danger"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Modal Tambah Petugas -->
                        <form action="" method="post">
                            <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="form-tambah">Form Tambah Data Petugas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body mt-2">
                                            <div class="form-group mt-2">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" name="nama" />
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>Jenis Kelamin</p>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="jk"
                                                                    id="jk" value="L">
                                                                Laki - Laki
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="jk"
                                                                    id="jk" value="P">
                                                                Perempuan
                                                                <i class="input-helper"></i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="hak-akses">Hak Akses</label>
                                                        <div>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="hak-akses">
                                                                <option selected>Pilih Hak Akses</option>
                                                                <option value="admin">Admin</option>
                                                                <option value="kepala">Kepala</option>
                                                                <option value="laboran">Laboran</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control username" id="tambah-username"
                                                    name="username" autocomplete="off" />
                                                <label id="info-tambah-username"></label>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mt-2">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" />
                                                        <label id="info"></label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mt-2">
                                                        <label for="password">Repeat Password</label>
                                                        <input type="password" class="form-control"
                                                            name="repeat-password" id="repeat-password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <div class="form-group">
                                                    <label>Pertanyaan Reset Password</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="pertanyaan-reset">
                                                        <option selected>Pilih Pertanyaan Reset</option>
                                                        <option value="Siapa nama hewan peliharaan anda?">Siapa nama
                                                            hewan
                                                            peliharaan anda?</option>
                                                        <option value="Siapa nama guru favorit anda saat sekolah?">Siapa
                                                            nama guru favorit anda saat sekolah?</option>
                                                        <option value="Dimanakah tempat lahir anda?">Dimanakah tempat
                                                            lahir
                                                            anda?</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Jawaban</label>
                                                            <input type="text" class="form-control" name="jawaban"
                                                                placeholder="Masukan jawabannya disini" />
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nip-anggota">No Handphone</label>
                                                            <input type="text" onkeypress="validate(event)"
                                                                class="form-control" name="no-handphone" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" />
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-start">
                                            <input type="submit" value="Simpan" name="tambahPetugas"
                                                class="btn btn-primary tblSimpan"></input>
                                            <input type="reset" class="btn btn-outline-danger"></input>
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

?>
<script>
$(document).ready(function() {
    $(".view-edit").on("click", function() {
        var id_petugas = $(this).attr("id");
        $("#edit_id_petugas").val(id_petugas);
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_petugas: id_petugas
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    let jk = resp.data.jk;
                    if (jk === "L") {
                        $("input[name=jk][value=" + jk + "]").prop('checked', true);
                    } else if (jk === "P") {
                        $("input[name=jk][value=" + jk + "]").prop('checked', true);
                    }
                    $("#nama_petugas").val(resp.data.nm_petugas);
                    $("#hak-akses").val(resp.data.hak_akses);
                    $("#username").val(resp.data.username);
                    $("#reset-question").val(resp.data.reset_question);
                    $("#answer_question").val(resp.data.answer_question);
                    $("#alamat").val(resp.data.alamat);
                    $("#no_handphone").val(resp.data.no_hp);
                    $("#modals-edit").modal("show");
                }
            }
        })
    });
    $("#repeat-password").on('keyup', function() {
        var inp = $("#password").val().trim();
        var rep = $("#repeat-password").val().trim();
        if (inp.length > 0) {
            if (inp != rep) {
                $("#info").html("Password tidak sama!");
                $("#info").css("color", "red");
                $(".tblSimpan").attr("disabled", "disabled");
            } else if (inp == rep) {
                $("#info").html("Password sama!");
                $("#info").css("color", "green");
                $(".tblSimpan").removeAttr("disabled");
            }
        }
    })
    $("#username").on("keyup", function() {
        let username = $("#username").val();
        // let id_petugas = $("#id_petugas").val();
        console.log(username);
        if (username != "") {
            $.ajax({
                url: "../ajax.php",
                method: "post",
                dataType: "json",
                data: {
                    username: username,
                    // id: id_petugas
                },
                success: function(resp) {
                    console.log(resp);
                    if (resp.status === "OK") {
                        $("#info-username").html("Username dapat digunakan");
                        $("#info-username").css("color", "green");
                        $(".tblSimpan").removeAttr("disabled");
                    } else if (resp.status === "ERROR") {
                        $("#info-username").html("Username telah digunakan!");
                        $("#info-username").css("color", "red");
                        $(".tblSimpan").attr("disabled", "disabled");
                    }
                }
            })
        } else if (username.trim().length == 0) {
            $("#info-username").html("");
            $(".tblSimpan").attr("disabled", "disabled");
        }
    })
    $("#tambah-username").on("keyup", function() {
        let username = $("#tambah-username").val();
        // let id_petugas = $("#id_petugas").val();
        console.log(username);
        if (username != "") {
            $.ajax({
                url: "../ajax.php",
                method: "post",
                dataType: "json",
                data: {
                    username: username,
                    // id: id_petugas
                },
                success: function(resp) {
                    console.log(resp);
                    if (resp.status === "OK") {
                        $("#info-tambah-username").html("Username dapat digunakan");
                        $("#info-tambah-username").css("color", "green");
                        $(".tblSimpan").removeAttr("disabled");
                    } else if (resp.status === "ERROR") {
                        $("#info-tambah-username").html("Username telah digunakan!");
                        $("#info-tambah-username").css("color", "red");
                        $(".tblSimpan").attr("disabled", "disabled");
                    }
                }
            })
        } else if (username.trim().length == 0) {
            $("#info-username").html("");
            $(".tblSimpan").attr("disabled", "disabled");
        }
    })
    $(".hapus").on("click", function() {
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
                    Swal.fire({
                        title: 'Apakah anda yakin menghapus data<br>' + resp.data
                            .nm_petugas + ' ?',
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
                                    hapus_petugas: id_petugas
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
                                                'petugas.admin.php'
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
        if ($('#nama_petugas').val() == "") {
            alert("Nama petugas tidak boleh kosong");
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
                                document.location.href = "petugas.admin.php";
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
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        alert("Hanya dapat mengetik number")
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}
</script>