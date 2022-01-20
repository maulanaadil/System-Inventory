<?php
include("sidebar.php");
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../dashboard.html"><i class="mdi mdi-home menu-icon"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="../dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
                        </ol>
                    </nav>
                    <div class="me-md-3 me-xl-5 py-2">
                        <h2>Data Anggota</h2>
                    </div>
                    <div class="d-flex justify-content-end ml-auto">
                        <button type="button" class="btn btn-success btn-sm">Tambah</button>
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
                                <tr>
                                    <td>001</td>
                                    <td>Saepul</td>
                                    <td>Laki-Laki</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm me-3">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>001</td>
                                    <td>Saepul</td>
                                    <td>Laki-Laki</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm me-3">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>001</td>
                                    <td>Saepul</td>
                                    <td>Laki-Laki</td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm me-3">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../footer.php");