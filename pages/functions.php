<?php
define("DEVELOPMENT",TRUE);
function dbConnect(){
    global $db;
	$db=new mysqli("localhost","root","","sistem-inventory");
	return $db;
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
		$sql= "SELECT p.id_pinjam,a.nm_anggota FROM peminjaman p JOIN anggota a USING(id_anggota) WHERE p.id_pinjam NOT IN 
		(SELECT id_pinjam FROM pengembalian)";
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
		$sql= "SELECT p.id_pinjam,pt.nm_petugas,a.nm_anggota,b.id_barang,b.nm_barang,r.jml_barang,s.nm_satuan FROM peminjaman p JOIN anggota a USING(id_anggota) join petugas pt using(id_petugas) join rincian_peminjaman r using(id_pinjam) join barang b using(id_barang) join satuan s using(id_satuan) where id_pinjam ='$id_pinjam'";
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
		$sql= "SELECT b.nm_barang,rp.jml_barang,rp.id_pinjam
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

function showError($message){
	?>
<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </svg>
    <div>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?=$message;?>
    </div>
</div>
<?php
}