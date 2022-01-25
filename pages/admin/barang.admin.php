<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getBarang = getBarang();
$getKategori = getKategori();
$getSupplier = getSupplier();
if($db->connect_errno==0){
    if(isset($_POST['tblTambah'])){
        $id_kat = $db->escape_string($_POST['kategori-barang']);
        $id_barang = generateIDBarang($id_kat);
        $nm_barang = $db->escape_string($_POST['nama-barang']);
        $baik = (int)$_POST['jml-baik'];
        $rusak = (int)$_POST['jml-rusak'];
        $rusak_berat = (int)$_POST['jml-rusak-berat'];
        $supplier = $db->escape_string($_POST['supplier']);
        $sumber = $db->escape_string($_POST['sumber']);
        $satuan = $db->escape_string($_POST['satuan']);
        $tanggal = $db->escape_string($_POST['tanggal']);
            $sql = "INSERT into barang values('$id_barang','$id_kat','$supplier','$nm_barang','$baik','$rusak','$rusak_berat','$tanggal','$sumber','$satuan')";
            $res=$db->query($sql);
            if($res){
                if($db->affected_rows>0){
                    echo "<script>
                    Swal.fire({
                        title: 'Data barang berhasil ditambahkan',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        document.location.href = 'barang.admin.php'
                    })
                    </script>";
                }else{
                    echo "<script>
                    Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Data gagal ditambahkan!'
                    })
                    </script>";
                }
            }else echo 'Gagal Eksekusi SQL' . (DEVELOPMENT ? ' : ' . $db->error : '') . "<br>";
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
                            <li class="breadcrumb-item active" aria-current="page">Data Barang</li>
                        </ol>
                    </nav>
                    <div class="me-md-3 me-xl-5 py-2">
                        <h2>Data Barang</h2>
                    </div>
                    <div class="container-fluid mt-3 mb-3">
                        <div class="row">
                            <div class="col-12 d-flex flex-row-reverse">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah"
                                    <?=$_SESSION['hak_akses']=="kepala"?"hidden":""?>>Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="data-anggota" class="table table-hover table-paginate" style="text-align: center">
                            <thead>
                                <tr>
                                    <th rowspan="2">ID Barang</th>
                                    <th rowspan="2">Nama Barang</th>
                                    <th colspan="3">Kondisi</th>
                                    <th rowspan="2">Jumlah</th>
                                    <th rowspan="2">Sumber</th>
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2" <?=$_SESSION['hak_akses']=="kepala"?"hidden":""?>>Aksi</th>
                                </tr>
                                <td>Baik</td>
                                <td>Rusak</td>
                                <td>Rusak Berat</td>
                            </thead>
                            <tbody>
                                <?php foreach ($getBarang as $data) :?>
                                <tr>
                                    <td><?= $data['id_barang'] ?></td>
                                    <td><?= $data['nm_barang'] ?></td>
                                    <td><?= $data['baik'] ?></td>
                                    <td><?= $data['rusak'] ?></td>
                                    <td><?= $data['rusak_berat'] ?></td>
                                    <td><?= sum($data['baik'], $data['rusak'], $data['rusak_berat']) ?></td>
                                    <td><?= $data['sumber'] ?></td>
                                    <td><?= 
										date("d F Y", strtotime($data['tanggal']));
										?></td>
                                    <td <?=$_SESSION['hak_akses']=="kepala"?"hidden":""?>>
                                        <button type="button" class="btn btn-warning btn-sm me-3 view-edit"
                                            id="<?= $data['id_barang'] ?>">Edit</button>
                                        <!-- MODAL EDIT DATA -->
                                        <form method="post" id="insert_form">
                                            <div class="modal fade" id="modals-edit" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content text-start">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="form-tambah">Form Edit Data
                                                                Barang</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body mt-2">
                                                            <div class="form-group mt-2">
                                                                <label for="nama-barang" class="mb-2">Nama
                                                                    Barang</label>
                                                                <input type="hidden" class="form-control"
                                                                    name="ubah_barang"
                                                                    value="<?=$data['id_barang']?>" />
                                                                <input type="text" class="form-control"
                                                                    id="edit-nama-barang" name="nama-barang" />
                                                            </div>
                                                            <label for="jumlah-barang" class="mb-2">Jumlah Barang</p>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="Baik" class="mb-2">Baik</label>
                                                                        <input type="number" min="0"
                                                                            class="form-control qty1-edit"
                                                                            onChange="total()" value="0" id="edit-baik"
                                                                            name="jml-baik" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="Rusak" class="mb-2">Rusak</label>
                                                                        <input type="number" name="jml-rusak" min="0"
                                                                            class="form-control qty1-edit"
                                                                            onChange="total()" value="0"
                                                                            id="edit-rusak" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="Rusak-Beratt" class="mb-2">Rusak
                                                                            Berat</label>
                                                                        <input type="number" name="jml-rusak-berat"
                                                                            min="0" class="form-control qty1-edit"
                                                                            onChange="total()" value="0"
                                                                            id="edit-rusak-berat" />
                                                                    </div>
                                                                    <div class="col offset-1">
                                                                        <label for="Total" class="mb-2">Total</label>
                                                                        <input type="number" class="form-control"
                                                                            value="0" id="total-number-kondisi"
                                                                            readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="kategori-barang">Kategori
                                                                                Barang</label>
                                                                            <div>
                                                                                <select class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    name="kategori-barang"
                                                                                    id="edit-kategori-barang">
                                                                                    <option selected>Pilih Kategori
                                                                                        Barang</option>
                                                                                    <?php foreach ($getKategori as $kb) :?>
                                                                                    <option
                                                                                        value="<?= $kb['id_kat'] ?>">
                                                                                        <?= $kb['nm_kat'] ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="supplier">Supplier</label>
                                                                            <div>
                                                                                <select class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    name="supplier" id="edit-supplier">
                                                                                    <option selected>Pilih Supplier
                                                                                    </option>
                                                                                    <?php foreach ($getSupplier as $supplier) :?>
                                                                                    <option
                                                                                        value="<?= $supplier['id_supplier'] ?>">
                                                                                        <?= $supplier['nm_supplier'] ?>
                                                                                    </option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="sumber">Sumber</label>
                                                                            <div>
                                                                                <select class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    name="sumber" id="edit-sumber">
                                                                                    <option selected>Pilih Sumber
                                                                                    </option>
                                                                                    <option value="APBD">APBD</option>
                                                                                    <option value="Mandiri">Mandiri
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="satuan">Satuan</label>
                                                                            <div>
                                                                                <select class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    name="satuan" id="edit-satuan">
                                                                                    <option selected>Pilih Satuan
                                                                                    </option>
                                                                                    <option value="Buah">Buah</option>
                                                                                    <option value="Pasang">Pasang
                                                                                    </option>
                                                                                    <option value="Pak">Pak</option>
                                                                                    <option value="Botol">Botol</option>
                                                                                    <option value="Roll">Roll</option>
                                                                                    <option value="500 mL">500 mL
                                                                                    </option>
                                                                                    <option value="2 kg">2 kg</option>
                                                                                    <option value="Set">Set</option>
                                                                                    <option value="Unit">Unit</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label for="tgl">Tanggal</label>
                                                                        <input type="date" class="form-control"
                                                                            id="edit-tgl" name="tanggal" />
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-start">
                                                            <button type="submit" class="btn btn-primary tblSimpan"
                                                                name="insert" id="insert" value="Insert">Simpan</button>
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END MODAL EDIT DATA -->
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- MODAL TAMBAH DATA -->
                    <form action="" method="post">
                        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="form-tambah">Form Edit Data Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mt-2">
                                        <div class="form-group mt-2">
                                            <label for="nama-barang" class="mb-2">Nama Barang</label>
                                            <input type="text" class="form-control" id="txt-nama-barang"
                                                name="nama-barang" />
                                        </div>
                                        <label for="jumlah-barang" class="mb-2">Jumlah Barang</p>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="Baik" class="mb-2">Baik</label>
                                                    <input type="number" name="jml-baik" min="0"
                                                        class="form-control qty1" onChange="total2()" value="0"
                                                        id="number-kondisi-baik" />
                                                </div>
                                                <div class="col">
                                                    <label for="Rusak" class="mb-2 ">Rusak</label>
                                                    <input type="number" name="jml-rusak" min="0"
                                                        class="form-control qty1" onChange="total2()" value="0"
                                                        id="number-kondisi-rusak" />
                                                </div>
                                                <div class="col">
                                                    <label for="Rusak-Beratt" class="mb-2 ">Rusak Berat</label>
                                                    <input type="number" name="jml-rusak-berat" min="0"
                                                        class="form-control qty1" onChange="total2()" value="0"
                                                        id="number-kondisi-rusak-berat" />
                                                </div>
                                                <div class="col offset-1">
                                                    <label for="Total" class="mb-2">Total</label>
                                                    <input type="number" class="form-control" value="0"
                                                        id="total-number-kondisi2" readonly />
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="kategori-barang">Kategori Barang</label>
                                                        <div>
                                                            <select class="form-select"
                                                                aria-label="Default select example"
                                                                name="kategori-barang">
                                                                <option selected>Pilih Kategori Barang</option>
                                                                <?php foreach ($getKategori as $kb) :?>
                                                                <option value="<?= $kb['id_kat'] ?>">
                                                                    <?= $kb['nm_kat']?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="supplier">Supplier</label>
                                                        <div>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="supplier">
                                                                <option selected>Pilih Supplier</option>
                                                                <?php foreach ($getSupplier as $supplier) :?>
                                                                <option value="<?= $supplier['id_supplier'] ?>">
                                                                    <?= $supplier['nm_supplier'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="sumber">Sumber</label>
                                                        <div>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="sumber">
                                                                <option selected>Pilih Sumber</option>
                                                                <option value="APBD">APBD</option>
                                                                <option value="Mandiri">Mandiri</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="satuan">Satuan</label>
                                                        <div>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="satuan">
                                                                <option selected>Pilih Satuan</option>
                                                                <option value="Buah">Buah</option>
                                                                <option value="Pasang">Pasang</option>
                                                                <option value="Pak">Pak</option>
                                                                <option value="Botol">Botol</option>
                                                                <option value="Roll">Roll</option>
                                                                <option value="500 mL">500 mL</option>
                                                                <option value="2 kg">2 kg</option>
                                                                <option value="Set">Set</option>
                                                                <option value="Unit">Unit</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="tgl">Tanggal</label>
                                                    <input type="date" class="form-control" id="tgl" name="tanggal" />
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <input type="submit" name="tblTambah" class="btn btn-primary"
                                            value="Simpan"></input>
                                        <input type="reset" class="btn btn-outline-danger"
                                            data-bs-dismiss="modal"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END MODAL TAMBAH -->
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

<script>
function total2() {
    var arr = document.getElementsByClassName('qty1');
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total-number-kondisi2').value = tot;
}
$(document).ready(function() {
    $('.table-paginate').dataTable();

    $(".table-paginate").on("click", ".view-edit", function() {
        var id_barang = $(this).attr("id");
        $.ajax({
            url: "../ajax.php",
            method: "post",
            dataType: "json",
            data: {
                id_barang: id_barang
            },
            success: function(resp) {
                if (resp.status === "OK") {
                    var qtyBaik = resp.data.baik;
                    var qtyRusak = resp.data.rusak;
                    var qtyRusakBerat = resp.data.rusak_berat;
                    var total = parseInt(qtyBaik) + parseInt(qtyRusak) + parseInt(
                        qtyRusakBerat);
                    $("#edit-nama-barang").val(resp.data.nm_barang);
                    $("#edit-baik").val(resp.data.baik);
                    $("#edit-rusak").val(resp.data.rusak);
                    $("#edit-rusak-berat").val(resp.data.rusak_berat);
                    $("#edit-kategori-barang").val(resp.data.id_kat);
                    $("#edit-supplier").val(resp.data.id_supplier);
                    $("#edit-sumber").val(resp.data.sumber);
                    $("#total-number-kondisi").val(total);
                    $("#edit-satuan").val(resp.data.satuan);
                    $("#edit-tgl").val(resp.data.tanggal);
                    $("#modals-edit").modal("show");
                }
            }
        })
    });
});

$(document).ready(function() {
    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#edit-nama-barang').val() == "") {
            alert("Nama tidak boleh kosong");
        } else if ($('#edit-kategori-barang').val() == 'Pilih Kategori Barang') {
            alert("Kategori Barang tidak boleh kosong");
        } else if ($('#edit-supplier').val() == 'Pilih Supplier') {
            alert("Supplier tidak boleh kosong");
        } else if ($('#edit-sumber').val() == 'Pilih Sumber') {
            alert("Sumber tidak boleh kosong");
        } else if ($('#edit-satuan').val() == 'Pilih Satuan') {
            alert("Satuan tidak boleh kosong");
        } else if ($('#edit-tgl').val() == '') {
            alert("Tanggal tidak boleh kosong");
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
                                document.location.href = "barang.admin.php";
                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'Data gagal diubah',
                            text: 'Kemungkinan data sama atau gagal eksekusi',
                            icon: 'error',
                            showCloseButton: true,
                        })
                    }
                },
            });
        }
    })
})

function total() {
    var arr = document.getElementsByClassName('qty1-edit');
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total-number-kondisi').value = tot;
}
</script>