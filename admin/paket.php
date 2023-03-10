<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/tabelc.css?version=<?= filemtime("../css/tabelc.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'paket';
require 'functions.php';
require 'navbar.php';
$query = 'SELECT outlet.nama_outlet ,paket.* FROM paket INNER JOIN outlet ON paket.outlet_id = outlet.id_outlet';
$data = ambildata($conn, $query);
?>
 <div>
                        <a href="paket_tambah.php"><button class="btn2"> 𝚃𝚊𝚖𝚋𝚊𝚑 𝙳𝚊𝚝𝚊</button>
                    </div>
<table>
     <thead>
        <tr>
          <th><label>No </label></th>
          <th><label>Nama Paket</label></th>
          <th><label>Jenis</label></th>
          <th><label>Harga</label></th>
          <th><label>Outlet</label></th>
          <th width="15%"><label>Aksi</label></th>
        </tr>
      </thead>
      <tbody>
     <?php  $no=1; foreach ($data as $paket) : ?>
        <tr class="data-label">
             <td><?= $no++ ?></td>
             <td><?= $paket['nama_paket'] ?></td>
             <td><?= $paket['jenis_paket'] ?></td>
             <td><?= $paket['harga'] ?></td>
             <td><?= $paket['nama_outlet'] ?></td>
             <td align="center">
                 <a href="paket_edit.php?id=<?= $paket['id_paket']; ?>" ><button class="button1">edit</button></a>
                 <a href="paket_hapus.php?id=<?= $paket['id_paket']; ?>" onclick="return confirm('Yakin hapus data?');"><button class="button1">hapus</button></a>
                                    </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

</body>
  