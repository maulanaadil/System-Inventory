<?php include_once("functions.php");?>
<?php
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        if (isset($_POST["TblLogin"])) {
        $username = $db->escape_string($_POST["username"]);
        $password = $db->escape_string($_POST["password"]);
        
        $sql = "SELECT * FROM petugas
        WHERE username='$username'";
        $res = $db->query($sql);
            if ($res) {
                if ($res->num_rows > 0) {
                $data = $res->fetch_assoc();
                if (password_verify($password, $data['pass'])) {
                    session_start();
                    $_SESSION["username"] = $data["username"];
                    $_SESSION["id_petugas"] = $data["id_petugas"];
                    $_SESSION["nm_petugas"] = $data["nm_petugas"];
                    $_SESSION["hak_akses"] = $data["hak_akses"];
                    $_SESSION["reset_question"] = $data["reset_question"];
                    $_SESSION["answer_question"] = $data["answer_question"];
                    $_SESSION["alamat"] = $data["alamat"];
                    $_SESSION["no_hp"] = $data["no_hp"];
                    $_SESSION["profil"] = $data["profil"];
                    $_SESSION["jk"] = $data["jk"];
                    $_SESSION["password"] = $password;
                    $_SESSION['passphrase'] = openssl_random_pseudo_bytes(16);
                    $_SESSION['iv'] = openssl_random_pseudo_bytes(16);
                    header("Location: admin/index.php");
                } else
                header("Location: ../index.php?error=3");
        } else
        header("Location: ../index.php?error=1");
        }
    } else
        header("Location: ../index.php?error=2");
} else
        header("Location: ../index.php?error=3");
?>