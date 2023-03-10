<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/tabelc.css?version=<?= filemtime("../css/tabelc.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'transaksi';
require 'functions.php';
require 'navbar.php';
$query = "SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.status_bayar='belum'";
$data = ambildata($conn,$query);
?> 

<table>
     <thead>
        <tr>
          <th><label>no</label></th>
          <th><label>Invoice </label></th>
          <th><label>Member</label></th>
          <th><label>Status</label></th>
          <th><label>total Harga</label></th>
          <th width="15%"><label>Aksi</label></th>
        </tr>
      </thead>
      <tbody>
     
      <?php  $no=1; foreach ($data as $transaksi) : ?>
        <tr class="data-label">
             <td><?= $no++?></td>
             <td><?= $transaksi['kode_invoice'] ?></td>
             <td><?= $transaksi['nama_member'] ?></td>
             <td><?= $transaksi['status'] ?></td>
             <td><?= $transaksi['total_harga'] ?></td>
             <td width="15%"> <a href="transaksi_bayar.php?id=<?= $transaksi['id_transaksi']; ?>"><button class="button1">konfirmasi</button></td>
           
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </body>
  </html>
