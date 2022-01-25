<?php
session_start();
if (!isset($_SESSION["username"])&&!isset($_SESSION["id_petugas"])){
header("Location: ../../index.php?error=4");
}
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
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(21);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(35);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(5);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(8);
		$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11);
		$spreadsheet->getActiveSheet()->getStyle('A1:I2')
			->getAlignment()->setHorizontal($alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A1:I2')
			->getAlignment()->setVertical($alignment::VERTICAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A5:I6')
			->getAlignment()->setHorizontal($alignment::HORIZONTAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A5:I6')
			->getAlignment()->setVertical($alignment::VERTICAL_CENTER);
		$spreadsheet->getActiveSheet()->getStyle('A1:I2')
			->getFont()->setSize(18);
		$sheet->setCellValue('A1','Laporan Data Barang Laboratorium IPA SMPN 1 Sukaresik');
		$sheet->mergeCells('A1:I2');
		$sheet->setCellValue('A3','Periode :');
		$sheet->setCellValue('B3', $bulan);
		$sheet->setCellValue('A4','Export Oleh :');
		$sheet->setCellValue('B4',$_SESSION['nm_petugas']);
		$sheet->setCellValue('A5', 'ID Barang');
		$sheet->mergeCells('A5:A6');
		$sheet->setCellValue('B5', 'Kategori');
		$sheet->mergeCells('B5:B6');
		$sheet->setCellValue('C5', 'Supplier');
		$sheet->mergeCells('C5:C6');
		$sheet->setCellValue('D5', 'Nama Barang');
		$sheet->mergeCells('D5:D6');
		$sheet->setCellValue('E5', 'Jumlah');
		$sheet->mergeCells('E5:E6');
		$sheet->setCellValue('F5','Keterangan');
		$sheet->mergeCells('F5:H5');
		$sheet->setCellValue('F6','Baik');
		$sheet->setCellValue('G6','Ringan');
		$sheet->setCellValue('H6','Rusak Berat');
		$spreadsheet->getActiveSheet()->getStyle('H6')
			->getAlignment()->setWrapText(true);
		$sheet->setCellValue('I5','Tanggal Terima');
		$sheet->mergeCells('I5:I6');
		$query = mysqli_query($db,"SELECT CURDATE() as 'tgl_export', b.id_barang,b.nm_barang,b.tanggal,k.nm_kat,s.nm_supplier,b.satuan,b.baik,b.rusak,b.rusak_berat,b.sumber, (b.baik+b.rusak+b.rusak_berat) as 'jumlah' from barang b join kategori_barang k using(id_kat) join supplier s using(id_supplier) where MONTH(b.tanggal)='$periode'");
		$i = 7;
		while($row = mysqli_fetch_array($query))
		{
			$sheet->setCellValue('A'.$i, $row['id_barang']);
			$sheet->setCellValue('B'.$i, $row['nm_kat']);
			$sheet->setCellValue('C'.$i, $row['nm_supplier']);
			$sheet->setCellValue('D'.$i, $row['nm_barang']);	
			$sheet->setCellValue('E'.$i, $row['jumlah']." ".$row['satuan']);	
			$sheet->setCellValue('F'.$i, $row['baik']);	
			$sheet->setCellValue('G'.$i, $row['rusak']);	
			$sheet->setCellValue('H'.$i, $row['rusak_berat']);	
			$sheet->setCellValue('I'.$i, $row['tanggal']);	
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
				header('Content-Disposition: attachment; filename="Data Barang - '.$bulan.'.xlsx"');
				ob_end_clean();
				$writer->save('php://output');
// $writer = new Xlsx($spreadsheet);
// $writer->save('Data barang.xlsx');
// echo "<script>window.location = 'Data barang.xlsx'</script>";
	}
}
?>