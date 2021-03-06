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
</head>

<body>
    <?php
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    ?>
    <div class="container">
        <div class="row" style="margin-top: 100px; max-width: 500px">
            <div class="col">
                <form>
                    <h3 class="h2" style="color: #33c041">Password telah diubah!</h3>
                    <p class="text-start text-gray mt-3">
                        Password telah terganti, silahkan login kembali<br />
                        untuk mengakses akun anda.
                    </p>
                    <div class="d-inline">
                        <a class="btn btn-primary mt-2" href="../../index.php">
                            Kembali ke halaman Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>