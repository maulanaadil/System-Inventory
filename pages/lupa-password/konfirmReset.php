<?php
include("../functions.php");
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['simpanPassword'])){
        $username = $_POST['username'];
        $id_petugas = $_POST['id_petugas'];
        $password = $_POST['passwordBaru'];
        $newpass = substr(password_hash($password,PASSWORD_DEFAULT),0,50);
        $sql = "UPDATE petugas SET pass='$newpass' where username = '$username'and id_petugas = '$id_petugas'";
        $res = $db->query($sql);
        if($res){
            if($db->affected_rows>0){
                echo "
                    <script>
                    alert('Password berhasil diubah Silakan login kembali!');
                    document.location.href = '../../index.html';
                    </script>
                    ";
            }else{
                echo "
                    <script>
                    alert('Password gagal diubah!');
                    document.location.href = '../../index.html';
                    </script>
                    ";
            }
        }
    }
}
?>