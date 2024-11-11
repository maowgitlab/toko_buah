<?php
  include('../koneksi.php');
  include('fpdf181/fpdf.php');
  $pdf = new FPDF('P','cm','A4');
  $pdf -> addpage();
  $pdf -> setfont('Arial','B','16');
  $pdf -> cell(19,0.7,'Detail Data Pembelian',0,1,'C');
  $pdf -> line(1,2.7,20,2.7);
  $pdf -> ln(2);
  $pdf -> setfont('Arial','B','10');
  $pdf -> cell(1,0.7,'No',1,0,'C');
  $pdf -> cell(4,0.7,'Tukang Jual',1,0,'C');
  $pdf -> cell(4,0.7,'Nama Pelanggan',1,0,'C');
  $pdf -> cell(6,0.7,'Buah yang Dibeli',1,0,'C');
  $pdf -> cell(4,0.7,'Total Harga',1,1,'C');
  $pdf -> setfont('Arial','','10');
  $no = 1;
  $tampil = mysqli_query($koneksi,"SELECT * FROM detail_pembelian") or die (mysqli_error($koneksi));
  while ($data = mysqli_fetch_assoc($tampil)) {
    $pdf -> cell(1,0.7,$no++,1,0,'C');
    $pdf -> cell(4,0.7,$data['id_akun'],1,0,'C');
    $pdf -> cell(4,0.7,$data['id_pembeli'],1,0,'C');
    $pdf -> cell(6,0.7,$data['id_buah'],1,0,'C');
    $pdf -> cell(4,0.7,$data['total_harga'],1,1,'C');
  }
  $tampil1 = mysqli_query($koneksi,"SELECT sum(total_harga) AS total FROM detail_pembelian");
  $data = mysqli_fetch_assoc($tampil1);
  $pdf -> setfont('Arial','B','10');
  $pdf -> cell(15,0.7,'',0,0);
  $pdf -> cell(4,0.7,'Keuntungan',1,1,'C');
  $pdf -> cell(15,0.7,'',0,0);
  $pdf -> cell(4,0.7,$data['total'],1,0,'C');
  $pdf -> output();
 ?>
