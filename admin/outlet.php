
<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/tabelc.css?version=<?= filemtime("../css/tabelc.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'outlet';
require 'functions.php';
require 'navbar.php';
$query = 'SELECT outlet.*, user.nama_user FROM outlet LEFT JOIN user ON user.outlet_id = outlet.id_outlet';
$data = ambildata($conn, $query);
?>
 <div>
  <a href="outlet_tambah.php"><button class="btn2"> 𝚃𝚊𝚖𝚋𝚊𝚑 𝙳𝚊𝚝𝚊</button>
                    </div>
<table>
     <thead>
        <tr>
          <th><label>No</label></th>
          <th><label>Nama </label></th>
          <th><label>Owner</label></th>
          <th><label>No telepon</label></th>
          <th><label>Alamat</label></th>
          <th width="15%"><label>Aksi</label></th>
        </tr>
      </thead>
      <tbody>
     
      <?php  $no=1; foreach ($data as $outlet) : ?>
        <tr class="data-label">
             <td><?= $no++?></td>
             <td><?= $outlet['nama_outlet'] ?></td>
             <td><?php if ($outlet['nama_user'] == null) {
                                            echo 'Belum Ada Owner';
                                        } else {
                                            echo $outlet['nama_user'];
                                        } ?>
                                    </td>
             <td><?= $outlet['telp_outlet'] ?></td>
             <td><?= $outlet['alamat_outlet'] ?></td>
             <td>
             <a href="outlet_edit.php?id=<?= $outlet['id_outlet']; ?>" ><button class="button1">edit</button></a>
             <a href="outlet_hapus.php?id=<?= $outlet['id_outlet']; ?>" onclick="return confirm('Yakin hapus data?');"><button class="button1">hapus</button></a>
             </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

</body>