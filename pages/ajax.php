<?php
include("functions.php");
$db=dbConnect();
if($db->connect_errno==0){
    $response = array();
    if(!isset($_POST)){
        $response['status'] = "ERROR";
    }else if(isset($_POST['id_petugas'])){
        $id_petugas=$db->escape_string($_POST['id_petugas']);
        $sql="SELECT * from petugas where id_petugas='$id_petugas'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data=$res->fetch_assoc();
                $response['status']="OK";
                $response['data']= $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['ubah_id_petugas'])){
        $id_petugas=$db->escape_string($_POST['ubah_id_petugas']);
        $nama_petugas=$db->escape_string($_POST['ubah_nama_petugas']);
        $jk=$db->escape_string($_POST['jk']);
        $hak_akses=$db->escape_string($_POST['hak-akses']);
        $username=$db->escape_string($_POST['username']);
        $reset_question=$db->escape_string($_POST['pertanyaan-reset']);
        $answer_question=strtoupper($db->escape_string($_POST['answer_question']));
        $no_handphone=$db->escape_string($_POST['no-handphone']);
        $alamat=$db->escape_string($_POST['alamat']);
        $sql="UPDATE petugas set nm_petugas='$nama_petugas', username='$username', hak_akses='$hak_akses', reset_question='$reset_question', answer_question='$answer_question', alamat='$alamat', no_hp='$no_handphone', jk='$jk' where id_petugas='$id_petugas'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $response['status']="OK";
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['hapus_petugas'])){
        $id_petugas=$_POST['hapus_petugas'];            
        $sql="DELETE from petugas where id_petugas='$id_petugas'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $response['status']="OK";
            }
        }                                                                             
        else $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
    }else if(isset($_POST['id_anggota'])){
        $id_anggota = $db->escape_string($_POST['id_anggota']);
        $sql = "SELECT * from anggota where id_anggota='$id_anggota'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data=$res->fetch_assoc();
                $response['status']="OK";
                $response['data']= $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        } 
    }else if(isset($_POST['hapus_anggota'])){
        $id_anggota=$_POST['hapus_anggota'];            
        $sql="DELETE from anggota where id_anggota='$id_anggota'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $response['status']="OK";
            }
        }                                                                             
        else $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
    }else if(isset($_POST['ubah_anggota'])){
        $id_anggota = $db->escape_string($_POST['ubah_anggota']);
        $nama = $db->escape_string($_POST['nama']);
        $jk = $db->escape_string($_POST['jk']);
        if($id_anggota!=""){
             $res=$db->query("UPDATE anggota set nm_anggota='$nama', jk='$jk' where id_anggota='$id_anggota'");
             if($res){
                  if($db->affected_rows>0){
                    $response['status']="OK";
                  }else{
                    $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
                  }
             }else{
                $response['status']='ERROR'.(DEVELOPMENT?" : ".$db->error:"");
             }
        }
   }else if(isset($_POST['id_supplier'])){
        $id_supplier = $db->escape_string($_POST['id_supplier']);
        $sql = "SELECT * from supplier where id_supplier = '$id_supplier'";
        $res = $db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data = $res->fetch_assoc();
                $response['status']="OK";
                $response['data']= $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }  
    } else if(isset($_POST['cek_id_supplier']))  {
        $id_supplier = $db->escape_string($_POST['cek_id_supplier']);
        $sql = "SELECT * from supplier where id_supplier = '$id_supplier'";
        $res = $db->query($sql);
        if($res){
            if($res->num_rows==0){
                $response['status'] = "OK";
            }else if($res->num_rows>0){
                $response['status'] = "ERROR";
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['hapus_supplier'])){
        $id_supplier=$_POST['hapus_supplier'];            
        $sql="DELETE from supplier where id_supplier='$id_supplier'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $response['status']="OK";
            }
        }                                                                             
        else $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
    }else if(isset($_POST['ubah_supplier'])){
        $id_supplier = $db->escape_string($_POST['ubah_supplier']);
        $nama_supplier = $db->escape_string($_POST['nama_supplier']);
        if($id_supplier!=""){
             $res=$db->query("UPDATE supplier set nm_supplier='$nama_supplier' where id_supplier='$id_supplier'");
             if($res){
                  if($db->affected_rows>0){
                    $response['status']="OK";
                  }else{
                    $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
                  }
             }else{
                $response['status']='ERROR'.(DEVELOPMENT?" : ".$db->error:"");
             }
        }
   }else if(isset($_POST['id_kat'])){
        $id_kat = $db->escape_string($_POST['id_kat']);
        $sql = "SELECT * from kategori_barang where id_kat = '$id_kat'";
        $res = $db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data = $res->fetch_assoc();
                $response['status']="OK";
                $response['data']= $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['ubah_id_kat_barang'])){
        $id_kat = $db->escape_string($_POST['ubah_id_kat_barang']);
        $nm_kat = $db->escape_string($_POST['nama_kat_barang']);
        $sql = "UPDATE kategori_barang set nm_kat='$nm_kat' where id_kat='$id_kat'";
        $res = $db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $response['status']="OK";
              }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['cek_id_kat'])){
        $id_kat = $db->escape_string($_POST['cek_id_kat']);
        $sql = "SELECT * from kategori_barang where id_kat = '$id_kat'";
        $res = $db->query($sql);
        if($res){
            if($res->num_rows==0){
                $response['status'] = "OK";
            }else if($res->num_rows>0){
                $response['status'] = "ERROR";
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['hapus_kat'])){
        $id_kat=$_POST['hapus_kat'];            
        $sql="DELETE from kategori_barang where id_kat='$id_kat'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $response['status']="OK";
            }
        }                                                                             
        else $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
    }else if(isset($_POST['id_barang'])){
        $id_barang = $db->escape_string($_POST['id_barang']);
        $sql= "SELECT * FROM barang WHERE id_barang = '$id_barang'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data = $res->fetch_assoc();
                $response['status'] = "OK";
                $response['data'] = $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['ubah_barang'])){
        $id_barang = $db->escape_string($_POST['ubah_barang']);
        $id_kat = $db->escape_string($_POST['kategori-barang']);
        $nm_barang = $db->escape_string($_POST['nama-barang']);
        $baik = (int)$_POST['jml-baik'];
        $rusak = (int)$_POST['jml-rusak'];
        $rusak_berat = (int)$_POST['jml-rusak-berat'];
        $supplier = $db->escape_string($_POST['supplier']);
        $sumber = $db->escape_string($_POST['sumber']);
        $satuan = $db->escape_string($_POST['satuan']);
        $tanggal = $db->escape_string($_POST['tanggal']);
        if($id_barang!=""){
            $res=$db->query("UPDATE barang SET id_kat='$id_kat', id_supplier='$supplier', nm_barang='$nm_barang', baik='$baik', rusak='$rusak', rusak_berat='$rusak_berat',tanggal='$tanggal', sumber='$sumber', satuan='$satuan' WHERE id_barang='$id_barang'");
            if($res){
                if($db->affected_rows>0){
                  $response['status']="OK";
                }else{
                  $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
                }
           }else{
              $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
           }
        }else $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
    }else if(isset($_POST['id_satuan'])){
        $id_satuan = $db->escape_string($_POST['id_satuan']);
        $sql= "SELECT * from satuan where id_satuan = '$id_satuan'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data = $res->fetch_assoc();
                $response['status'] = "OK";
                $response['data'] = $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        }
    }else if(isset($_POST['username'])){
        $username = $db->escape_string($_POST['username']);
        // $id_petugas = $db->escape_string($_POST['id']);
        $sql = "SELECT username from petugas where username='$username'";
        $res=$db->query($sql); 
            if($res){
                if($res->num_rows==0){
                    $data = $res->fetch_assoc();
                    $response['status'] = "OK";
                    $response['data'] = $data;
                }else if($res->num_rows>0){
                    $response['status'] = "ERROR";
                }
            }
    }else if(isset($_POST['id'])){
        $id_petugas = $db->escape_string($_POST['id']);
        $sql = "SELECT id_petugas from petugas where id_petugas='$id_petugas'";
        $res=$db->query($sql);
            if($res){
                if($res->num_rows>0){
                    $response['status'] = "ERROR";
                }else if($res->num_rows==0){
                    $response['status'] = "OK";
                }
            }
    } else if(isset($_POST['id_pinjam'])) {
        $id_pinjam = $db->escape_string($_POST['id_pinjam']);
        $sql= "SELECT b.nm_barang ,rp.jml_barang
		from rincian_peminjaman rp join barang b using(id_barang) where rp.id_pinjam = '$id_pinjam'";
        $res=$db->query($sql);
        if($res){
            if($db->affected_rows>0){
                $data=$res->fetch_assoc();
                $response['status']="OK";
                $response['data']= $data;
            }else{
                $response['status']="ERROR".(DEVELOPMENT?" : ".$db->error:"");
            }
        }else{
            $response['status']= "ERROR".(DEVELOPMENT?" : ".$db->error:"");
        } 
    }else if(isset($_POST['detail_id_pinjam'])){
        $output = '';
        $k = getRincianPeminjaman($_POST['detail_id_pinjam']);
        $output .= "
        <table class='table table-hover table-striped table-responsive' style='color:black;'>";
        foreach($k as $row){
            $output .= '
            <tr>
                <td>'.$row["nm_barang"].'</td>
                <td>'.$row["qty"].'</td>
            </tr>';
        };
    $output .= "</table>";
    echo $output;
    }else if(isset($_POST['pengembalian'])){
        $id_pinjam = $db->escape_string($_POST['pengembalian']);
        $tgl = $db->escape_string($_POST['tgl']);
        $k = getPeminjaman($id_pinjam);
        ?>
<input type="hidden" name="id_pinjam" id="id_pinjam" value="<?=$id_pinjam;?>">
<table class="table table-bordered" style="color: black;">
    <tr>
        <td>Nama Barang</td>
        <td>Jumlah</td>
    </tr>
    <?php foreach($k as $row):?>
    <tr>
        <td><?=$row['nm_barang'];?></td>
        <td><?=$row['jml_barang']." ".$row['satuan'];?></td>
    </tr>
    <?php endforeach;?>
</table>
<?php 
    } else if (isset($_POST['barang'])) {
        $periode = $db->escape_string($_POST['barang']);
        $tableBarang = getBarangPeriode($periode);
        foreach ($tableBarang as $data) : ?>
<tr>
    <td><?= $data['id_barang'] ?></td>
    <td><?= $data['nm_barang']; ?></td>
    <td><?= $data['baik']; ?></td>
    <td><?= $data['rusak']; ?></td>
    <td><?= $data['rusak_berat']; ?></td>
    <td><?= sum($data['baik'], $data['rusak'], $data['rusak_berat']) ?></td>
    <td><?= $data['sumber'] ?></td>
    <td><?= date("d F Y", strtotime($data['tanggal']));?></td>
</tr>
<?php endforeach;
    } else if (isset($_POST['peminjam'])) {
        $periode = $db->escape_string($_POST['peminjam']);
        $tablePeminjam = getDataPeminjamanPeriode($periode);
        foreach ($tablePeminjam as $data) : ?>
<tr>
    <td><?= $data['id_pinjam'] ?></td>
    <td><?= $data['nama'] ?></td>
    <td><?= 
                        date("d F Y", strtotime($data['tanggal']));
                        ?></td>
</tr>
<?php endforeach;
    } else if (isset($_POST['laporanpengembalian'])) {
        $periode = $db->escape_string($_POST['laporanpengembalian']);
        $tablePengembalian = getDataPengembalianPeriode($periode);
        foreach ($tablePengembalian as $data) : ?>
<tr>
    <td><?= $data['id_pinjam'] ?></td>
    <td><?= $data['nama'] ?></td>
    <td><?= 
                        date("d F Y", strtotime($data['tanggal']));
                        ?></td>
</tr>
<?php endforeach;
    }
}
if($response!=[]){
    echo json_encode($response);
}
?>