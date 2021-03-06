<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<?php
session_start();
if(isset($_SESSION["hak_akses"])){
    $hak_akses = $_SESSION["hak_akses"];
    if($hak_akses=="admin"){
        header("Location: pages/admin/");
    }
    else if($hak_akses=="kepala"){
        header("Location: pages/kepala/");
    }
    else if($hak_akses=="laboran"){
        header("Location: pages/petugas/");
    }
};
include("pages/functions.php");

if (isset($_GET["error"])) {
$error = $_GET["error"];
if ($error == 1)
showError("Username dan password tidak sesuai.");
else if ($error == 2)
showError("Error database. Silahkan hubungi administrator");
else if ($error == 3)
showError("Koneksi ke Database gagal. Autentikasi gagal.");
else if ($error == 4)
showError("Anda tidak boleh mengakses halaman sebelumnya karena belum login.
Silahkan login terlebih dahulu.");
else
showError("Unknown Error.");
};
?>

<body>
    <div class="container-scroller h-100">
        <div class="row justify-content-center align-middle" style="margin-top: 40px; padding-bottom: 50px">
            <h1 class="h2 text-center lh-base">
                Sistem Inventori Laboratorium<br />SMPN 1 Tasikmalaya
            </h1>
            <div class="col offset-2">
                <div class="card rounded mb-3 px-5 py-5" style="max-width: 1016px">
                    <div class="row g-0">
                        <div class="col-md-4 px-5 py-5">
                            <img src="./images/logo.png" class="img-fluid rounded-start" alt="..." />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2 class="text-center mb-4">Login</h2>
                                <form action="pages/konfirmlogin.php" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Username" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword4">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password" />
                                    </div>

                                    <p class="text-danger text-decoration-none float-start" hidden>
                                        Password salah!
                                    </p>
                                    <a href="./pages/lupa-password/lupa-password.html"
                                        class="auth-link text-black text-decoration-none float-end">Lupa Password?</a>
                                    <div class="col-12 pt-5">
                                        <button type="submit" name="TblLogin" class="btn btn-primary btn-block w-100">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <script src="js/data-table.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <!-- End custom js for this page-->

    <script src="js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>