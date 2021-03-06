<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Beranda</title>
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
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <!-- SweetAlert2 -->
    <script src=" //cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
session_start();
if (!isset($_SESSION["username"])&&!isset($_SESSION["id_petugas"])){
header("Location: ../../index.php?error=4");
}
include("../functions.php");
$db=dbConnect();
$profil = getProfilPetugas($_SESSION['id_petugas']);
?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-center align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="./index.php"><img src="../../images/logo.png"
                            class="img-fluid w-100" alt="logo" /></a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="../../images/<?=$profil['profil'] ?>" alt="profile" class="img-fluid" />
                            <span class="nav-profile-name"><?=$profil['nm_petugas']?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="profil.admin.php">
                                <i class="mdi mdi-account-circle text-primary"></i>
                                Profile
                            </a>
                            <a class="dropdown-item text-danger" href="../logout.php">
                                <i class="mdi mdi-logout text-danger"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="anggota.admin.php">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title">Anggota</span>
                        </a>
                    </li>
                    <?php if($_SESSION['hak_akses']=="admin"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="petugas.admin.php">
                            <i class="mdi mdi-account menu-icon"></i>
                            <span class="menu-title">Petugas</span>
                        </a>
                    </li>
                    <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="mdi mdi-checkbox-blank-circle-outline menu-icon"></i>
                            <span class="menu-title">Barang</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="barang.admin.php"> Data Barang </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="kategori-barang.admin.php"> Kategori Barang
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="supplier.admin.php"> Supplier </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="peminjaman.admin.php">
                            <i class="mdi mdi-weight menu-icon"></i>
                            <span class="menu-title">Peminjaman</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pengembalian.admin.php">
                            <i class="mdi mdi-dialpad menu-icon"></i>
                            <span class="menu-title">Pengembalian</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.admin.php">
                            <i class="mdi mdi-file-document menu-icon"></i>
                            <span class="menu-title">Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <!-- konten -->