<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/tabelc.css?version=<?= filemtime("../css/tabelc.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'pengguna';
require 'functions.php';
require 'navbar.php';
$query = 'SELECT * FROM user order by role desc';
$data = ambildata($conn,$query);
?> 
 <div>
                        <a href="pengguna_tambah.php"><button class="btn2"> 𝚃𝚊𝚖𝚋𝚊𝚑 𝙳𝚊𝚝𝚊</button>
                    </div>
<table>
     <thead>
        <tr>
          <th><label>No </label></th>
          <th><label>Nama</label></th>
          <th><label>Username</label></th>
          <th><label>Role</label></th>
          <th width="15%"><label>Aksi</label></th>
        </tr>
      </thead>
      <tbody>
      <?php  $no=1; foreach($data as $user): ?>
        <tr class="data-label">
             <td><?= $no++ ?></td>
             <td><?= $user['nama_user'] ?></td>
             <td><?= $user['username'] ?></td>
             <td><?= $user['role'] ?></td>
             <td align="center">
             <a href="pengguna_edit.php?id=<?= $user['id_user']; ?>" ><button class="button1">edit</button></a>
             <a href="pengguna_hapus.php?id=<?= $user['id_user']; ?>" onclick="return confirm('Yakin hapus data?');"><button class="button1">hapus</button></a>
                                    </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

</body>
  

