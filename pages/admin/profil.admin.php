<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getBarang = getBarang();
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
                    <div class="container-fluid">
                        <div class="row">
                            <a href="./index.php"
                                class="auth-link text-black text-decoration-none float-end mdi mdi-keyboard-backspace menu-icon mb-3"
                                style="text-align: left; font-size: 18pt">
                                Profil
                            </a>
                            <div class="form-group mt-2 d-flex">
                                <img src="../../images/logo.png" class="img-fluid me-3" alt="..."
                                    style="width:140pt; height: 140pt;">
                                <input type="file" id="ubah-gambar" name="ubah-gambar" style="display: none;"
                                    accept="image/*" />
                                <label for="ubah-gambar" class="ms-3 text-primary"
                                    style="margin: auto 5px; font-size: 16px; font-weight: 500;">Ubah Gambar</label>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" value="<?=$_SESSION['nm_petugas']?>" id="nama">
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="no">Nomor Telepon</label>
                                    <input class="form-control form-control-sm" type="text"
                                        value="<?=$_SESSION['no_hp']?>" id="no">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="exampleDataList" class="form-label">Jenis Kelamin</label>
                                <input class="form-control form-control-sm" list="datalistOptions" id="jenis_kelamin">
                                <datalist id="datalistOptions">
                                    <option value="Laki-laki">
                                    <option value="Perempuan">
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                    value="<?=$_SESSION['alamat']?>" rows="4"></textarea>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control form-control-sm" value="<?=$_SESSION['username']?>"
                                        type="text" id="username">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="no">Password</label>
                                    <input class="form-control form-control-sm" type="password"
                                        value="<?=$_SESSION['password']?>" id="password" disabled input>
                                </div>
                            </div>
                            <a href="../lupa-password/reset-password.php"
                                class="auth-link text-black text-decoration-none float-end"
                                style="text-align: right;">Ubah Password</a>
                            <div class="form-group">
                                <label for="exampleDataList" class="form-label">Reset Pertanyaan</label>
                                <input class="form-control form-control-sm" list="datalistOptions"
                                    id="reset_pertanyaan">
                                <datalist id="datalistOptions">
                                    <option value="1">
                                    <option value="2">
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="pertanyaan">Jawab Pertanyaan</label>
                                <input class="form-control form-control-sm" value="<?=$_SESSION['answer_question']?>"
                                    type="text" id="pertanyaan">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary">Simpan</button>
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