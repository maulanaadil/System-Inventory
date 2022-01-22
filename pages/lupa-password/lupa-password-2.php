<?php
include("../functions.php");
$db=dbConnect();
if($db->connect_errno==0){
  if(isset($_POST['submitUsername'])){
    $username = $_POST['username'];
    $sql = "SELECT id_petugas, reset_question from petugas where username='$username'";
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows>0){
        $data=$res->fetch_all(MYSQLI_ASSOC);
			  $res->free();
      }
    } else echo "Gagal Eksekusi SQL" . (DEVELOPMENT ? " : " . $db->error : "") . "<br>";
  } else {
    echo "
    <script>
    alert('Anda tidak bisa mengakses halaman ini!');
    document.location.href = '../../index.html';
    </script>
    ";
  }
}else{
  echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Lupa Password</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.ico" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</head>

<body>
  <?php 
  
    if (!empty($data[0]["reset_question"])) {
  ?>
    <div class="container">
        <div class="row" style="margin-top: 100px; max-width: 500px">
            <div class="col">
                <form method="post" action="reset-password.php">
                    <h3 class="h2 my-3">Reset Password</h3>
                    <p class="text-start text-gray">Masukan jawaban pertanyaan dibawah ini untuk verifikasi penggantian
                        password</p>

                    <p class="text-start mt-3 text-gray" id="reset_question"><?=$data[0]["reset_question"] ?></p>
                    <input type="text" class="form-control mb-4 mt-3" required id="exampleInputName1"
                        placeholder="Masukan jawaban anda" name="answerQuestion" autocomplete="off" />
                    <input type="hidden" name="username" value=<?=$username?>>
                    <input type="hidden" name="id_petugas" value=<?=$data[0]['id_petugas'];?>>
                    <button class="btn btn-primary btn-lg" type="submit" name="submitJawaban">Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>

    <?php } else { ?>
        <div class="container">
        <div class="row" style="margin-top: 100px; max-width: 500px">
            <div class="col">
                <h3 class="h2 my-3 lh-base">Username <span class="text-primary"><?= $username ?></span> Tidak ditemukan!😓</h3>
                <p class="text-start text-gray mt-2">Silahkan tekan kembali untuk memasukan username lagi</p>
                <a href="./lupa-password.html" class="btn btn-link btn-lg mt-3 text-black">Kembali</a>
            </div>
        </div>
    </div>
    <?php } ?>
</body>

</html>