<?php
    require('fpdf181/fpdf.php');
    include('../koneksi.php');
    $pdf = new FPDF ('P','mm','A4');
    $tampil = mysqli_query($koneksi,"SELECT * FROM stok_buah ORDER BY id_stok ASC");
    while ($data = mysqli_fetch_assoc($tampil)) {
      $pdf -> addpage();
       $pdf -> setfont('Arial','B',16);
       $pdf -> setfont('Arial','B',12);
       $pdf -> cell(10,5,'',0,1);
       $pdf -> setfont('Arial','B',10);
       $pdf -> cell(20,6,'ID Buah',1,0,'C');
       $pdf -> cell(86,6,'Gambar',1,0,'C');
       $pdf -> cell(30,6,'Jumlah Stok',1,0,'C');
       $pdf -> cell(50,6,'Harga',1,1,'C');
       $pdf -> setfont('Arial','',10);
       $pdf -> cell(20,60,$data['id_buah'],1,0,'C');
       $pdf -> image('../Icon/'.$data['gambar_buah'],45,30,50,50);
       $pdf -> cell(86,60,'',1);
       $pdf -> cell(30,60,$data['jumlah_stok'],1,0,'C');
       $pdf -> cell(50,60,$data['harga_awal'],1,1,'C');
    }
    $pdf -> output();
?>
  // $pdf -> line(1,2.7,20,2.7);
  // $pdf -> line(1,2.7,1,20);
  // $pdf -> line(20,2.7,20,20);
  // $pdf -> line(1,20,20,20);
