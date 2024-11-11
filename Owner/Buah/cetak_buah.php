<?php
    include('../../koneksi.php');
    include('../fpdf181/fpdf.php');
    $pdf = new FPDF('P','cm','A4');
    $pdf -> addpage();
    $pdf -> setfont('Arial','B','16');
    $pdf -> cell(19,0.7,'Cetak Buah',0,1,'C');
    $pdf -> line(1,2.7,20,2.7);
    $pdf -> ln(2);
    $pdf -> setfont('Arial','B','12');
    $pdf -> cell(1,0.7,'No',1,0,'C');
    $pdf -> cell(3,0.7,'ID Buah',1,0,'C');
    $pdf -> cell(5,0.7,'Nama Buah / Barang',1,0,'C');
    $pdf -> cell(3,0.7,'Jumlah Beli',1,0,'C');
    $pdf -> cell(3,0.7,'Harga Satuan',1,0,'C');
    $pdf -> cell(4,0.7,'Nama Pelanggan',1,1,'C');
    $pdf -> setfont('','',12);
    $no = 1;
    $tampil = mysqli_query($koneksi,"SELECT * FROM tb_buah");
    while ($data = mysqli_fetch_assoc($tampil)) {
    $pdf -> cell(1,0.7,$no++,1,0,'C');
    $pdf -> cell(3,0.7,$data['id_buah'],1,0,'C');
    $pdf -> cell(5,0.7,$data['nama_buah'],1,0,'C');
    $pdf -> cell(3,0.7,$data['jumlah_beli'],1,0,'C');
    $pdf -> cell(3,0.7,$data['harga_satuan'],1,0,'C');
    $pdf -> cell(4,0.7,$data['nama_pelanggan'],1,1,'C');
    }
    $pdf -> output();
?>