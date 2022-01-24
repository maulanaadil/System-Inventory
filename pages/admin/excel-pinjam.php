<?php
include('../functions.php');
$db=dbConnect();
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
if(isset($_POST['tblExport'])){
	$periode = $_POST['tgl_periode'];
	if($periode==0){
		echo "
          <script>
          alert('Pilih Periode terlebih dahulu!');
          document.location.href = history.back();
          </script>
          ";
	}else if($periode!=0){
		if($periode==1) $bulan="Januari";
		else if($periode==2) $bulan= "Februari";
		else if($periode==3) $bulan= "Maret";
		else if($periode==4) $bulan= "April";
		else if($periode==5) $bulan= "Mei";
		else if($periode==6) $bulan= "Juni";
		else if($periode==7) $bulan= "Juli";
		else if($periode==8) $bulan= "Agustus";
		else if($periode==9) $bulan= "September";
		else if($periode==10) $bulan= "Oktober";
		else if($periode==11) $bulan= "November";
		else if($periode==12) $bulan= "Desember";
		$spreadsheet = new Spreadsheet();
		$alignment = new Alignment();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(14);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11);
		$spreadsheet->getActiveSheet()->getStyle('A1:I2')
			->getAlignment()->setHorizontal($alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A1:I2')
			->getAlignment()->setVertical($alignment::VERTICAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A1:I2')
			->getFont()->setSize(18);
		$spreadsheet->getActiveSheet()->getStyle('A5:I6')
			->getAlignment()->setHorizontal($alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A5:I6')
			->getAlignment()->setVertical($alignment::VERTICAL_CENTER);
	
		$sheet->setCellValue('A1','Laporan Data Barang Laboratorium IPA SMPN 1 Sukaresik');
		$sheet->mergeCells('A1:I2');
		$sheet->setCellValue('A3','Periode :');
		$sheet->setCellValue('B3', $bulan);
		$sheet->setCellValue('A4','Export Oleh :');
		$sheet->setCellValue('B4','session');
		$sheet->setCellValue('A5', 'ID Pinjam');
		$sheet->mergeCells('A5:A6');
		$sheet->setCellValue('B5', 'Nama Peminjam');
		$sheet->mergeCells('B5:B6');
		$sheet->setCellValue('C5', 'ID Barang');
		$sheet->mergeCells('C5:C6');
		$sheet->setCellValue('D5', 'Kategori');
		$sheet->mergeCells('D5:D6');
		$sheet->setCellValue('E5', 'Nama Barang');
		$sheet->mergeCells('E5:E6');
		$sheet->setCellValue('F5', 'Jumlah');
		$sheet->mergeCells('F5:F6');
		$sheet->setCellValue('G5','Tgl Pinjam');
		$sheet->mergeCells('G5:G6');
		$sheet->setCellValue('H5','Tgl Kembali');
		$sheet->mergeCells('H5:H6');
		$sheet->setCellValue('I5','Petugas');
		$sheet->mergeCells('I5:I6');
		$query = mysqli_query($db,"SELECT p.id_pinjam, p.tgl_pinjam, p.tgl_kembali, rp.id_barang, rp.jml_barang, b.nm_barang, k.nm_kat, a.nm_anggota, pt.nm_petugas, b.satuan
		FROM peminjaman p JOIN anggota a USING(id_anggota)
		JOIN rincian_peminjaman rp USING(id_pinjam) JOIN barang b USING(id_barang)
		JOIN kategori_barang k USING(id_kat) JOIN petugas pt USING(id_petugas) WHERE MONTH(p.tgl_pinjam)='$periode' ORDER BY p.tgl_pinjam ASC");
		$i = 7;
		while($row = mysqli_fetch_array($query))
		{
			if($row['tgl_kembali']=="0000-00-00"){
				$tgl_kembali = "Belum dikembalikan";
			} else{
				$tgl_kembali=$row['tgl_kembali'];
			}
			$sheet->setCellValue('A'.$i, $row['id_pinjam']);
			$sheet->setCellValue('B'.$i, $row['nm_anggota']);
			$sheet->setCellValue('C'.$i, $row['id_barang']);
			$sheet->setCellValue('D'.$i, $row['nm_kat']);
			$sheet->setCellValue('E'.$i, $row['nm_barang']);	
			$sheet->setCellValue('F'.$i, $row['jml_barang']." ".$row['satuan']);	
			$sheet->setCellValue('G'.$i, $row['tgl_pinjam']);	
			$sheet->setCellValue('H'.$i, $tgl_kembali);	
			$sheet->setCellValue('I'.$i, $row['nm_petugas']);	
			$i++;
		}
		 
		$styleArray = [
					'borders' => [
						'allBorders' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						],
					],
				];
		$i = $i - 1;
		$sheet->getStyle('A5:I'.$i)->applyFromArray($styleArray);
		
		$writer = new Xlsx($spreadsheet);
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment; filename="Data Transaksi - '.$bulan.'.xlsx"');
				ob_end_clean();
				$writer->save('php://output');
		// $writer = new Xlsx($spreadsheet);
		// $writer->save('Data barang.xlsx');
		// echo "<script>window.location = 'Data barang.xlsx'</script>";
	}
	
}
?>