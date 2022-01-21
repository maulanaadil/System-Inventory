<?php
    include("../functions.php");

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
    ?>
    