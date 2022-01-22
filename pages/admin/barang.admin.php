<?php
include("sidebar.admin.php");
include("../functions.php");
$db=dbConnect();
$getBarang = getBarang();
$getKategori = getKategori();
$getSupplier = getSupplier();
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
                                    data-bs-target="#modalTambah">Tambah</button>
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
                                    <th rowspan="2">Aksi</th>
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
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm me-3 view-edit"
                                            id="<?= $data['id_barang'] ?>">Edit</button>
                                        <!-- MODAL EDIT DATA -->
                                        <div class="modal fade" id="modals-edit" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="">
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
                                                                <input type="text" class="form-control"
                                                                    id="txt-nama-barang" />
                                                            </div>
                                                            <label for="jumlah-barang" class="mb-2">Jumlah Barang</p>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="Baik" class="mb-2">Baik</label>
                                                                        <input type="number" name="qty"
                                                                            onChange="total()" min="0"
                                                                            class="form-control" value="0"
                                                                            id="number-kondisi-baik" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="Rusak" class="mb-2">Rusak</label>
                                                                        <input type="number" name="qty"
                                                                            onChange="total()" min="0"
                                                                            class="form-control" value="0"
                                                                            id="number-kondisi-rusak" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="Rusak-Beratt" class="mb-2">Rusak
                                                                            Berat</label>
                                                                        <input type="number" name="qty"
                                                                            onChange="total()" min="0"
                                                                            class="form-control" value="0"
                                                                            id="number-kondisi-rusak-berat" />
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
                                                                                    id="kategori-barang">
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
                                                                                    name="supplier" id="supplier">
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
                                                                                    name="sumber" id="sumber">
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
                                                                                    name="satuan" id="satuan">
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
                                                        </div>
                                                        <div class="modal-footer justify-content-start">
                                                            <input type="submit" class="btn btn-primary"
                                                                value="Simpan"></input>
                                                            <input type="reset" class="btn btn-outline-danger"
                                                                data-bs-dismiss="modal"></input>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- END MODAL EDIT DATA -->
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- MODAL TAMBAH DATA -->
                    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="#">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="form-tambah">Form Edit Data Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mt-2">
                                        <div class="form-group mt-2">
                                            <label for="nama-barang" class="mb-2">Nama Barang</label>
                                            <input type="text" class="form-control" id="txt-nama-barang" />
                                        </div>
                                        <label for="jumlah-barang" class="mb-2">Jumlah Barang</p>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="Baik" class="mb-2">Baik</label>
                                                    <input type="number" name="qty1" onChange="total2()" min="0"
                                                        class="form-control" value="0" id="number-kondisi-baik" />
                                                </div>
                                                <div class="col">
                                                    <label for="Rusak" class="mb-2">Rusak</label>
                                                    <input type="number" name="qty1" onChange="total2()" min="0"
                                                        class="form-control" value="0" id="number-kondisi-rusak" />
                                                </div>
                                                <div class="col">
                                                    <label for="Rusak-Beratt" class="mb-2">Rusak Berat</label>
                                                    <input type="number" name="qty1" onChange="total2()" min="0"
                                                        class="form-control" value="0"
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
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <input type="submit" class="btn btn-primary" value="Simpan"></input>
                                        <input type="reset" class="btn btn-outline-danger"
                                            data-bs-dismiss="modal"></input>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    var arr = document.getElementsByName('qty1');
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
                console.log(resp)
                if (resp.status === "OK") {
                    $("#txt-nama-barang").val(resp.data.nm_barang);
                    var qtyBaik = resp.data.baik;
                    var qtyRusak = resp.data.rusak;
                    var qtyRusakBerat = resp.data.rusak_berat;
                    var total = parseInt(qtyBaik) + parseInt(qtyRusak) + parseInt(
                        qtyRusakBerat);
                    $("#number-kondisi-baik").val(resp.data.baik);
                    $("#number-kondisi-rusak").val(resp.data.rusak);
                    $("#number-kondisi-rusak-berat").val(resp.data.rusak_berat);
                    $("#total-number-kondisi").val(total);
                    $("#kategori-barang").val(resp.data.id_kat);
                    $("#supplier").val(resp.data.id_supplier);
                    $("#sumber").val(resp.data.sumber);
                    $("#satuan").val(resp.data.satuan);
                    $("#modals-edit").modal("show");
                }
            }
        })
    });
});

function total() {
    var arr = document.getElementsByName('qty');
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total-number-kondisi').value = tot;
}
</script>