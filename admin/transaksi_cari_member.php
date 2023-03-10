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
$query = 'SELECT * FROM member';
$data = ambildata($conn,$query);
// print_r($data);
?> 
<div><button class="h4">Jika pelanggan belum terdaftar maka daftarkan dulu lewat menu pelanggan</button>
</div>

</div>
    <table>
        <thead>
                <tr>
                    <th><label>nama </label></th>
                    <th><label>alamat</label></th>
                    <th><label>Jk</label></th>
                    <th><label>telepon</label></th>
                    <th><label>no ktp</label></th>
                    <th width="15%"><label>Aksi</label></th>
                </tr>
        </thead>
    <tbody>
            <?php  $no=1; foreach ($data as $member) : ?>
<tr class="data-label">
                    <td><?= $member['nama_member'] ?></td>
                    <td><?= $member['alamat_member'] ?></td>
                    <td><?= $member['jenis_kelamin'] ?></td>
                    <td><?= $member['telp_member'] ?></td>
                    <td><?= $member['no_ktp'] ?></td>
<td align="center">
<a href="transaksi_tambah.php?id=<?= $member['id_member']; ?>"><button class="button1">pilih</button></a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>