<?php
include("sidebar.admin.php");
// include("../functions.php");

// $db=dbConnect();
if($db->connect_errno==0){
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="./index.php"><i class="mdi mdi-home menu-icon"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Laporan</li>
                        </ol>
                    </nav>
                    <div class="me-md-3 me-xl-5 py-2">
                        <h2>Data Laporan</h2>
                        <div class="d-flex my-4">
                            <h4 class="h5 mt-2 me-3">Periode: </h4>
                            <select class="form-select" aria-label="Default select example" name="periode"
                                style="width: 200px;" id="periode">
                                <option value="0" selected>Pilih Periode</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>

                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="barang-tab" data-bs-toggle="tab" href="#barang" role="tab"
                                aria-controls="barang" aria-selected="true">Laporan Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="peminjaman-tab" data-bs-toggle="tab" href="#peminjaman" role="tab"
                                aria-controls="peminjaman" aria-selected="false">Laporan Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pengembalian-tab" data-bs-toggle="tab" href="#pengembalian"
                                role="tab" aria-controls="pengembalian" aria-selected="false">Laporan Pengembalian</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="barang" role="tabpanel" aria-labelledby="barang-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                    </div>
                                </div>
                            </div>
                            <form action="excel-barang.php" method="post">
                                <input type="hidden" value="" name="tgl_periode" id="tgl_periode_barang">
                                <div class="table-responsive">
                                    <table id="data-barang" class="table table-hover table-paginate"
                                        style="text-align: center; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">ID Barang</th>
                                                <th rowspan="2">Nama Barang</th>
                                                <th colspan="3">Kondisi</th>
                                                <th rowspan="2">Jumlah</th>
                                                <th rowspan="2">Sumber</th>
                                                <th rowspan="2">Tanggal</th>
                                            </tr>
                                            <td>Baik</td>
                                            <td>Rusak</td>
                                            <td>Rusak Berat</td>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="container px-5">
                                    <div class="text-end">
                                        <input type="submit" value="Export" class="btn btn-success my-3 mx-5"
                                            name="tblExport">
                                        <!-- <button class="btn btn-success my-3 mx-5">Export</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="peminjaman" role="tabpanel" aria-labelledby="peminjaman-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                    </div>
                                </div>
                            </div>
                            <form action="excel-pinjam.php" method="post">
                                <input type="hidden" value="" name="tgl_periode" id="tgl_periode_pinjam">
                                <div class="table-responsive">
                                    <table id="data-peminjam" class="table table-hover table-paginate"
                                        style="text-align: center; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID Pinjam</th>
                                                <th>Nama Peminjam</th>
                                                <th>Tgl Pinjam</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="container">
                                    <div class="text-end">
                                        <input type="submit" value="Export" class="btn btn-success my-3 mx-5"
                                            name="tblExport">
                                        <!-- <button class="btn btn-success my-3">Export</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pengembalian" role="tabpanel" aria-labelledby="pengembalian-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <div class="d-flex flex-column justify-content-around">
                                    </div>
                                </div>
                            </div>
                            <form action="excel-pinjam.php" method="post">
                                <input type="hidden" value="" name="tgl_periode" id="tgl_periode_kembali">
                                <div class="table-responsive">

                                    <table id="data-pengembalian" class="table table-hover table-paginate"
                                        style="text-align: center; width: 100%;" ;>
                                        <thead>
                                            <tr>
                                                <th>ID Pinjam</th>
                                                <th>Nama Peminjam</th>
                                                <th>Tgl Kembali</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="container">
                                    <div class="text-end">
                                        <!-- <a href="excel-barang.php" target="_blank"
                                            class="btn btn-success my-3 mx-5">Export</a> -->
                                        <input type="submit" value="Export" class="btn btn-success my-3 mx-5"
                                            name="tblExport">
                                        <!-- <button class="btn btn-success my-3">Export</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php 
include("footer.admin.php");
}else{
    echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
}
?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// $(document).ready(function() {
//     $("table-paginate").dataTable({
//         "language": {
//             "zeroRecords": "Tidak ada data yang ditampilkan",
//         }, 
//     });
//     $(".table-paginate").find('tbody').empty();
// })

function sum(x, y, k) {
    let z = parseInt(x) + parseInt(y) + parseInt(k);
    return z;
}

$("#periode").on("change", function() {
    var periode = $("#periode").val();
    $("#tgl_periode_barang").val(periode);
    $("#tgl_periode_pinjam").val(periode);
    $("#tgl_periode_kembali").val(periode);
    $('#data-barang').DataTable().destroy();
    $("#data-barang").DataTable({
        language: {
            "zeroRecords": "Tidak ada data yang ditampilkan",
        },
        retrieve: true,
        ajax: ({
            url: '../ajax.php',
            method: "POST",
            dataType: "json",
            data: {
                barang: periode,
            },
        }),
        columns: [{
                "data": "id_barang"
            },
            {
                "data": "nm_barang"
            },
            {
                "data": "baik"
            },
            {
                "data": "rusak"
            },
            {
                "data": "rusak_berat"
            },
            {
                "data": `jumlah`
            },
            {
                "data": "sumber"
            },
            {
                "data": "tanggal"
            },
        ]
    });


    $('#data-peminjam').DataTable().destroy();
    $("#data-peminjam").DataTable({
        language: {
            "zeroRecords": "Tidak ada data yang ditampilkan",
        },
        retrieve: true,
        ajax: ({
            url: '../ajax.php',
            method: "POST",
            dataType: "json",
            data: {
                peminjam: periode,
            },
        }),
        columns: [{
                "data": "id_pinjam"
            },
            {
                "data": "nama"
            },
            {
                "data": "tanggal"
            },
        ]
    });

    $('#data-pengembalian').DataTable().destroy();
    $("#data-pengembalian").DataTable({
        language: {
            "zeroRecords": "Tidak ada data yang ditampilkan",
        },
        retrieve: true,
        ajax: ({
            url: '../ajax.php',
            method: "POST",
            dataType: "json",
            data: {
                laporanpengembalian: periode,
            },
        }),
        columns: [{
                "data": "id_pinjam"
            },
            {
                "data": "nama"
            },
            {
                "data": "tanggal"
            },
        ]
    });
})

// $("#periode").on("change", function() {
//     var periode = $("#periode").val();
//     $("#tgl_periode").val(periode);
//     $("#tgl_periode_kembali").val(periode);
//     $.ajax({
//         url: "../ajax.php",
//         method: "post",
//         dataType: "json",
//         data: {
//             barang: periode,
//         },
//         beforeSend: function () {
//              $("#table-paginate").find('tbody').empty();  
//         },
//         success: function(resp) {
//             // console.log(resp);
//             if (resp.status === "OK") {
//                 $("#data-barang").find('tbody').find('tr').detach();
//                 $.each(resp.data, function(key, val) {           
//                     let data = `<tr><td>${val.id_barang}</td><td>${val.nm_barang}</td><td>${val.baik}</td><td>${val.rusak}</td><td>${val.rusak_berat}</td><td>${sum(val.baik, val.rusak, val.rusak_berat)}</td><td>${val.sumber}</td><td>${val.tanggal}</td></tr>`
//                     $("#data-barang").find('tbody').append(data);
//                 })
//             } else {
//                 $("#data-barang").find('tbody').empty();
//             }
//         },
//     });
//     $.ajax({
//         url: "../ajax.php",
//         method: "post",
//         dataType: "json",
//         data: {
//             peminjam: periode,
//         },
//         success: function(resp) {
//             if (resp.status === "OK") {
//                  $("#data-peminjam").find('tbody').find('tr').detach();
//                 $.each(resp.data, function(key, val) {

//                     let data = `<tr><td>${val.id_pinjam}</td><td>${val.nama}</td><td>${val.tanggal}</td></tr>`;
//                     $("#data-peminjam").find('tbody').append(data);
//                 })
//             } else {
//                 $("#data-peminjam").find('tbody').empty();
//             }
//         },
//     });

//     $.ajax({
//         url: "../ajax.php",
//         method: "post",
//         dataType: "json",
//         data: {
//             laporanpengembalian: periode,
//         },
//         success: function(resp) {
//             if (resp.status === "OK") {
//                  $("#data-pengembalian").find('tbody').find('tr').detach();
//                 $.each(resp.data, function(key, val) {

//                     let data = `<tr><td>${val.id_pinjam}</td><td>${val.nama}</td><td>${val.tanggal}</td></tr>`;
//                     $("#data-pengembalian").find('tbody').append(data);
//                 })
//             } else {
//                 $("#data-pengembalian").find('tbody').empty();
//             }
//         },
//     });

// })
</script>