<?php
include("sidebar.admin.php");
$getBarang = getBarang();
$profil = getProfilPetugas($_SESSION['id_petugas']);
if($db->connect_errno==0){
    if (isset($_POST["tblSimpan"])) {
        $db = dbConnect();
    
        if (updateProfil($_POST) > 0) {
            echo "<script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Update Profil berhasil',
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                document.location.href = 'profil.admin.php';
            });
                    </script>";
                    //echo header("Location: home-koki.php"); 
        }
        else{
        echo mysqli_error($db);
        echo "<script>
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Update gagal',
            showConfirmButton: false,
            timer: 1500
          })
        </script>";
        }
        // else {
        //     echo "<script>
        //     alert('Pengajuan Menu Gagal.');
        //     </script>";
        // }
    }
?>
<style>
.hover {
    cursor: pointer;
}
</style>
<form action="" method="post" id="insert_form" enctype="multipart/form-data">
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
                                <li class="breadcrumb-item active" aria-current="page">Profil</li>
                            </ol>
                        </nav>
                        <div class="container-fluid">
                            <div class="row">
                                <a href="./index.php"
                                    class="auth-link text-black text-decoration-none float-end mdi mdi-keyboard-backspace menu-icon mb-3"
                                    style="text-align: left; font-size: 18pt">
                                    Profil
                                </a>
                                <div class="form-group mt-2 d-flex">
                                    <img src="../../images/<?=$profil['profil'] ?>" class="img-fluid me-3"
                                        id="gambar-profil" alt="..." style="width:140pt; height: 140pt;">
                                    <div id="preview"></div>
                                    <input type="file" id="ubah-gambar" name="ubah-gambar" style="display: none;"
                                        accept="image/*" />
                                    <label for="ubah-gambar" class="ms-3 text-primary hover"
                                        style="margin: auto 5px; font-size: 16px; font-weight: 500;">Ubah Gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="form-group">
                                    <input type="hidden" name="id-petugas" value="<?=$_SESSION['id_petugas']?>">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama-petugas"
                                        value="<?=$profil['nm_petugas']?>" id="nama">
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="no">Nomor Telepon</label>
                                        <input class="form-control form-control-sm" onkeypress="validate(event)"
                                            name="no-hp-petugas" type="text" value="<?=$profil['no_hp']?>" id="no">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p>Jenis Kelamin</p>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="jk" id="jk" value="L"
                                                    <?=$profil['jk']=="L"?"checked":"" ?>>
                                                Laki - Laki
                                                <i class="input-helper"></i></label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="jk" id="jk" value="P"
                                                    <?=$profil['jk']=="P"?"checked":"" ?>>
                                                Perempuan
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat-petugas" id="alamat"
                                        rows="4"><?=$profil['alamat']?></textarea>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control form-control-sm" name="username-petugas"
                                            value="<?=$profil['username']?>" type="text" id="username">
                                        <label id="info-username"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="no">Password</label>
                                        <input class="form-control form-control-sm" type="password"
                                            value="<?=$_SESSION['password']?>" id="password" disabled input>
                                        <!-- <input type="checkbox" class="mt-2" onclick="myFunction()"><label
                                            for=""></label> Show
                                        Password -->
                                        <div class="form-switch mt-2">
                                            <input class="form-check-input mt-2" type="checkbox" role="switch"
                                                id="checkbox-pass" onclick="myFunction()">
                                            <label class="form-check-label mt-1" for="checkbox-pass">Show
                                                Password</label>
                                            <a href="../lupa-password/reset-password.php"
                                                class="auth-link text-black text-decoration-none float-end mt-1"
                                                style="text-align: right;">Ubah Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="form-group">
                                        <label for="reset-question">Pertanyaan Reset
                                            Password</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="pertanyaan-reset" id="reset-question">
                                            <option selected>Pilih Pertanyaan Reset
                                            </option>
                                            <option value="Siapa nama hewan peliharaan anda?"
                                                <?=$profil['reset_question']=="Siapa nama hewan peliharaan anda?"?"selected":"" ?>>
                                                Siapa nama
                                                hewan
                                                peliharaan anda?</option>
                                            <option value="Siapa nama guru favorit anda saat sekolah?"
                                                <?=$profil['reset_question']=="Siapa nama guru favorit anda saat sekolah?"?"selected":"" ?>>
                                                Siapa
                                                nama guru favorit anda saat sekolah?
                                            </option>
                                            <option value="Dimanakah tempat lahir anda?"
                                                <?=$profil['reset_question']=="Dimanakah tempat lahir anda?"?"selected":"" ?>>
                                                Dimanakah tempat
                                                lahir
                                                anda?</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pertanyaan">Jawab Pertanyaan</label>
                                    <input class="form-control form-control-sm" value="<?=$profil['answer_question']?>"
                                        type="text" name="jawaban-pertanyaan" id="pertanyaan">
                                </div>
                            </div>
                            <button type="submit" id="tblSimpan" name="tblSimpan"
                                class="btn btn-primary tblSimpan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php 
include("footer.admin.php");
}else{
    echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
}
?>;
<script>
function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function(event) {
            $('#preview').html('<img src="' + event.target.result + '" width="140" height="140"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#ubah-gambar").change(function() {
    $("#gambar-profil").attr("hidden", "hidden");
    imagePreview(this);
});
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

$("#tblSimpan").on("click", function(event) {
    if ($('#nama').val() == "") {
        alert("Nama tidak boleh kosong!");
        event.preventDefault();
    } else if ($('#no').val() == "") {
        alert("No Handphone tidak boleh kosong!");
        event.preventDefault();
    } else if ($('#jk').val() == "") {
        alert("Jenis Kelamin tidak boleh kosong!");
        event.preventDefault();
    } else if ($('#alamat').val() == "") {
        alert("Alamat tidak boleh kosong!");
        event.preventDefault();
    } else if ($('#username').val() == "") {
        alert("Username tidak boleh kosong!");
        event.preventDefault();
    } else if ($('#reset-question').val() == "") {
        alert("Pertanyaan tidak boleh kosong!");
        event.preventDefault();
    } else if ($('##pertanyaan').val() == "") {
        alert("Jawaban Pertanyaan tidak boleh kosong!");
        event.preventDefault();
    } else {
        $("#insert_form").submit();
    }
})

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