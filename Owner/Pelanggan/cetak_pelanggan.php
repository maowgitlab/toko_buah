<?php
    include('../../koneksi.php');
    include('../fpdf181/fpdf.php');
    $pdf = new FPDF('P','cm','A4');
    $pdf -> addpage();
    $pdf -> setfont('Arial','B','16');
    $pdf -> cell(19,0.7,'Cetak Pelanggan',0,1,'C');
    $pdf -> line(1,2.7,20,2.7);
    $pdf -> ln(2);
    $pdf -> setfont('Arial','B','12');
    $pdf -> cell(1,0.7,'No',1,0,'C');
    $pdf -> cell(3,0.7,'ID Pelanggan',1,0,'C');
    $pdf -> cell(4,0.7,'Nama Pelanggan',1,0,'C');
    $pdf -> cell(3,0.7,'Jenis Kelamin',1,0,'C');
    $pdf -> cell(4,0.7,'Nomer HP',1,0,'C');
    $pdf -> cell(4,0.7,'Tanggal Beli',1,1,'C');
    $pdf -> setfont('','',12);
    $no = 1;
    $tampil = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan");
    while ($data = mysqli_fetch_assoc($tampil)) {
        if ($data['jenkel'] == "L") {
            $jenkel = "Laki-Laki";
        }else {
            $jenkel = "Perempuan";
        }
        $pdf -> cell(1,0.7,$no++,1,0,'C');
        $pdf -> cell(3,0.7,$data['id_pelanggan'],1,0,'C');
        $pdf -> cell(4,0.7,$data['nama_pelanggan'],1,0,'C');
        $pdf -> cell(3,0.7,$jenkel,1,0,'C');
        $pdf -> cell(4,0.7,$data['no_hp'],1,0,'C');
        $pdf -> cell(4,0.7,$data['tgl_beli'],1,1,'C');
    }
    $pdf -> output();
?>