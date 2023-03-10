<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/sukses.css?version=<?= filemtime("../css/sukses.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'transaksi';
require 'functions.php';
require 'layout_header.php';
$query = 'SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.id_transaksi = ' . $_GET['id'];
$data = ambilsatubaris($conn,$query);
?> 
<body><div class="conf-modal center success">

    <div class="title-text"><h1>Success!</h1></div>
    <h3>Pesanan Atas Nama <?= $data['nama_member'] ?> Behasil Di Simpan</h3>
                        <strong>Kode Invoice <?= $data['kode_invoice'] ?></strong><br>
                        <strong>Total Pembayaran <?= $data['total_harga'] ?></strong><br><br>
                        <a href="outlet_edit.php?id=<?= $outlet['id_outlet']; ?>" ><button class="button1">edit</button></a>
</div>
</body>
</html>