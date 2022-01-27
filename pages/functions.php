<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
    global $db;
	$db=new mysqli("localhost","root","","sistem-inventory");
	return $db;
}
function dbConnectPDO(){
	$dbhost = 'localhost'; // set the hostname
	$dbname = 'sistem-inventory'; // set the database name
	$dbuser = 'root'; // set the mysql username
	$dbpass = '';  // set the mysql password

	try {
		$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		$dbConnection->exec("set names utf8");
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbConnection;
	}
		catch (PDOException $e) {
		return 'Connection failed: ' . $e->getMessage();
	}
}
    // FUNCTION BUAT TAB ANGGOTA
    function getSumAnggota() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM anggota";
            return $db->query($sql);
        }
        return FALSE;
    }
    function getSumAnggotaLaki() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM anggota WHERE jk='L'";
            return $db->query($sql);
        }
        return FALSE;
    }
    function getSumAnggotaPerempuan() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM anggota WHERE jk='P'";
            return $db->query($sql);
        }
        return FALSE;
    }
    
    // FUNCTION BUAT TAB BARANG
    function getSumBarang() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM barang";
            return $db->query($sql);
        }
        return FALSE;
    }
    function getSumBarangBaik() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM barang WHERE baik";
            return $db->query($sql);
        }
        return FALSE;
    }
    function getSumBarangRusak() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM barang WHERE rusak";
            return $db->query($sql);
        }
        return FALSE;
    }

    function getSumBarangRusakBerat() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM barang WHERE rusak_berat";
            return $db->query($sql);
        }
        return FALSE;
    }

    // FUNCTION BUAT TAB SUPPLIER
     function getSumSupplier() {
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) FROM supplier";
            return $db->query($sql);
        }
        return FALSE;
    }

    // FUNCTION TABLE RIWAYAT PEMINJAMAN BARANG
    function getRiwayatPeminjamanBarang() {
        $db = dbConnect();
	    $sql = "SELECT peminjaman.id_pinjam as 'id', anggota.nm_anggota as 'nama', peminjaman.tgl_pinjam as 'pinjam', peminjaman.tgl_kembali as 'kembali' FROM peminjaman INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota ";
		return $res=$db->query($sql);
    }

function sum($x, $y, $k) {
    $z = $x + $y + $k;
    return $z;
}
function generateIDBarang($id_kat){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql = "SELECT RIGHT(MAX(id_barang),3)+1 as id_barang FROM barang WHERE id_kat = '$id_kat'";
            $res=$db->query($sql);
            if($res){
                if($db->affected_rows>0){
                    $data = $res->fetch_assoc();
					$res->free();
                    if($data['id_barang']==null){
                        $id_barang = $id_kat."1";
                    }else{
                        $id_barang = $id_kat.$data['id_barang'];
                    }
					return $id_barang;
                }else{
                    return FALSE;
                }
            } return FALSE;
	}
}
function generateIDPetugas(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql = "SELECT RIGHT(MAX(id_petugas),2)+1 as id FROM petugas";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_assoc();
			$res->free();
			return $data;
		}else
		return FALSE; 
	}else
		return FALSE;
}
function getDataPetugas(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from petugas";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getAnggota(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from anggota";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getBarang(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from barang";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getDataBarang(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT b.id_barang,b.nm_barang,b.tanggal, b.jumlah,k.nm_kat,s.nm_supplier,st.nm_satuan,rb.baik,rb.rusak,rb.rusak_berat,rb.sumber from barang b join rincian_barang rb using(id_barang) join kategori_barang k using(id_kat) join satuan st using(id_satuan) join supplier s using(id_supplier)";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getSupplier(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from supplier";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getKategori(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT * from kategori_barang";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getIdPinjam(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT id_pinjam, nm_anggota FROM peminjaman join anggota using(id_anggota) where tgl_kembali = '0000-00-00'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getPeminjaman($id_pinjam){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam,pt.nm_petugas,a.nm_anggota,b.id_barang,b.nm_barang,r.jml_barang,b.satuan FROM peminjaman p JOIN anggota a USING(id_anggota) join petugas pt using(id_petugas) join rincian_peminjaman r using(id_pinjam) join barang b using(id_barang) where id_pinjam ='$id_pinjam'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataPeminjaman(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam as 'id_pinjam',a.nm_anggota as 'nama',p.tgl_pinjam as 'tanggal'
		FROM peminjaman p JOIN anggota a ON p.id_anggota = a.id_anggota";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getRincianPeminjaman($id_pinjam){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT b.nm_barang as 'nm_barang',rp.jml_barang as 'qty'
		from rincian_peminjaman rp join barang b using(id_barang) where rp.id_pinjam = '$id_pinjam'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataPengembalian(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam as 'id_pinjam',a.nm_anggota as 'nama',p.tgl_kembali as 'tanggal'
		FROM peminjaman p JOIN anggota a ON p.id_anggota = a.id_anggota where p.tgl_kembali NOT IN (SELECT tgl_kembali FROM peminjaman WHERE tgl_kembali = '0000-00-00')";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
	else
			return FALSE; 
	}
	else
		return FALSE;
}
function getJumlahBarang($id_barang){
	$db=dbConnect();
	$sql = "SELECT baik as jumlah from barang where id_barang='$id_barang'";
	$res=$db->query($sql);
	if($res){
		$data=$res->fetch_assoc();
		$res->free();
		return $data;
	}else
		return FALSE; 
}

function getBarangPeriode($periode) {
	$db=dbConnect();
	$sql = "SELECT * FROM barang WHERE MONTH(tanggal) = '$periode'";
	$res=$db->query($sql);
	if($res){
		$data=$res->fetch_all(MYSQLI_ASSOC);
		$res->free();
		return $data;
	}else
		return FALSE; 
}

function getDataPeminjamanPeriode($periode){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam as 'id_pinjam',a.nm_anggota as 'nama',p.tgl_pinjam as 'tanggal'
		FROM peminjaman p JOIN anggota a ON p.id_anggota = a.id_anggota WHERE MONTH(p.tgl_pinjam) = '$periode'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}

function getDataPengembalianPeriode($periode){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pinjam as 'id_pinjam',a.nm_anggota as 'nama',p.tgl_kembali as 'tanggal'
		FROM peminjaman p JOIN anggota a ON p.id_anggota = a.id_anggota where MONTH(p.tgl_kembali) = '$periode';";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
	else
			return FALSE; 
	}
	else
		return FALSE;
}
function updateProfil($data) {
	$db=dbConnect();

	$id_petugas = $db->escape_string($_POST['id-petugas']);
	$nama = $db->escape_string($_POST['nama-petugas']);
	$no_hp = $db->escape_string($_POST['no-hp-petugas']);
	$jk = $db->escape_string($_POST['jk']);
	$alamat = $db->escape_string($_POST['alamat-petugas']);
	$username = $db->escape_string($_POST['username-petugas']);
	$question = $db->escape_string($_POST['pertanyaan-reset']);
	$answer = $db->escape_string($_POST['jawaban-pertanyaan']);
	$namaFile = $_FILES['ubah-gambar']['name'];
	$data = getProfilPetugas($id_petugas);
	$foto = $data['profil'];
	if($namaFile!=""){
		if(file_exists($_SERVER["DOCUMENT_ROOT"]."/data/System-Inventory/images/$foto")){
			unlink($_SERVER["DOCUMENT_ROOT"]."/data/System-Inventory/images/$foto");
		}
		$x = explode('.', $namaFile);
		$ekstensi = strtolower(end($x));
		$ekstensiYangDibolehkan = [
			'image/png',
			'image/jpg',
			'image/jpeg',
			'image/webp'
		];
		$ukuranFile = $_FILES['ubah-gambar']['size'];
		$error = $_FILES['ubah-gambar']['error'];
		$tmpName = $_FILES['ubah-gambar']['tmp_name'];
			if (!in_array(mime_content_type($tmpName), $ekstensiYangDibolehkan)) {
				echo "
				<script>
				alert('File tidak sesuai!');
				document.location.href = 'index.php';
				</script>";
			}else if($ukuranFile > 1000 * 10000){
				echo "
				<script>
				alert('File terlalu besar!');
				document.location.href = 'index.php';
				</script>";
			}
			else {
			$file = $id_petugas.".".$ekstensi;
			move_uploaded_file($tmpName,$_SERVER["DOCUMENT_ROOT"]."/data/System-Inventory/images/".$file);
			}
	//Masukkan data menu ke database
	$db->query("UPDATE petugas set nm_petugas='$nama', username='$username', reset_question='$question', answer_question='$answer', alamat='$alamat', no_hp='$no_hp', jk='$jk', profil='$file' where id_petugas='$id_petugas'");
	} else{
		$db->query("UPDATE petugas set nm_petugas='$nama', username='$username', reset_question='$question', answer_question='$answer', alamat='$alamat', no_hp='$no_hp', jk='$jk' where id_petugas='$id_petugas'");
	}

	return mysqli_affected_rows($db);
}

function getProfilPetugas($id_petugas){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql = "SELECT * FROM petugas where id_petugas='$id_petugas'";
		$res=$db->query($sql);
		if($res){
			$data = $res->fetch_assoc();
			return $data;
		}else return FALSE;
	} else return FALSE;
}

function showError($message){
	?>
<div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </svg>
    <div>
        <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
        <?=$message;?>
    </div>
</div>
<!-- <div class="alert alert-warning alert-dismissible" role="alert">
        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></span>
    </div> -->
<?php
}