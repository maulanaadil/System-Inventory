<?php
include("functions.php");
$db=dbConnect();
if($db->connect_errno==0){
    $response = array();
    if(!isset($_POST)){
        $response['status'] = "ERROR";
    }
    else if(isset($_POST['id_petugas'])){
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
    }else if(isset($_POST['id_barang'])){
        $id_barang = $db->escape_string($_POST['id_barang']);
        $sql= "SELECT b.id_barang,b.nm_barang,b.tanggal, b.jumlah,k.id_kat,k.nm_kat,s.nm_supplier,s.id_supplier,st.id_satuan,st.nm_satuan,rb.baik,rb.rusak,rb.rusak_berat,rb.sumber from barang b join rincian_barang rb using(id_barang) join kategori_barang k using(id_kat) join satuan st using(id_satuan) join supplier s using(id_supplier) where b.id_barang='$id_barang'";
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
        $sql = "SELECT username from petugas where username='$username'";
        $res=$db->query($sql);
            if($res){
                if($res->num_rows>0){
                    $response['status'] = "OK";
                }else if($res->num_rows==0){
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
    }
}
echo json_encode($response);
?>