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
                    $response['status']="ERROR2".(DEVELOPMENT?" : ".$db->error:"");
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
    } 
    else if(isset($_POST['id_kat'])){
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
        $id_petugas = $db->escape_string($_POST['id']);
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
    }
}
echo json_encode($response);
?>