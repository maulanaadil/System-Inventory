<?php 
include("../functions.php");
$db=dbConnect();
if($db->connect_errno==0){
  if(isset($_POST['submitJawaban'])){
    $jawaban = strtoupper($_POST['answerQuestion']);
    $username = $_POST['username'];
    $id_petugas = $_POST['id_petugas'];
    $sql = "SELECT answer_question from petugas where username='$username'";
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows>0){
        $data=$res->fetch_assoc();
		    $res->free();
        if($jawaban!==$data['answer_question']){
          echo "
          <script>
          alert('Jawaban SALAH!');
          document.location.href = history.back();
          </script>
          ";
        }
      }
    }
  } else {
    echo "
    <script>
    alert('Anda tidak bisa mengakses halaman ini!');
    document.location.href = '../../index.html';
    </script>
    ";
  }
}else{
  echo "Koneksi ERROR, ".$db->connect_error;
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
    <div class="container">
        <div class="row" style="margin-top: 100px; max-width: 500px">
            <div class="col">
                <form action="konfirmReset.php" method="post">
                    <h3 class="h2 mt-3">Reset Password</h3>
                    <p class="text-start text-gray">Masukan password baru anda</p>
                    <input type="text" class="form-control my-4" id="passwordBaru" name="passwordBaru"
                        placeholder="Masukan password baru" required />
                    <p class="text-start text-gray">Ulangi Password</p>
                    <input type="text" class="form-control my-4" id="repeatPasswordBaru" name="repeatPasswordBaru"
                        placeholder="Ulangi Password" required />
                    <p class="isi text-start text-gray"></p>
                    <input type="hidden" name="username" value=<?=$username?>>
                    <input type="hidden" name="id_petugas" value=<?=$id_petugas?>>
                    <div class="d-inline">
                        <button class="btn btn-primary" type="submit" id="simpan" name="simpanPassword">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
$(document).ready(function() {
    $("#repeatPasswordBaru").on('keyup', function() {
        var inp = $("#passwordBaru").val().trim();
        var rep = $("#repeatPasswordBaru").val().trim();
        if (inp.length > 0) {
            if (inp != rep) {
                $(".isi").html("Password tidak sama!");
                $(".isi").css("color", "red");
                $("#simpan").attr("disabled", "disabled");

            } else if (inp === rep) {
                $(".isi").html("Password sama!");
                $(".isi").css("color", "green");
                $("#simpan").removeAttr("disabled");
            }
        }

    })
})
</script>