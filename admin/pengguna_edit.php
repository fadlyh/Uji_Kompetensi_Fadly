<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'pengguna';
require 'functions.php';

$role = ['admin','owner','kasir'];

$id_user = $_GET['id'];
$queryedit = "SELECT * FROM user WHERE id_user = '$id_user'";
$edit = ambilsatubaris($conn,$queryedit);

if(isset($_POST['btn-simpan'])){
    $nama     = $_POST['nama_user'];
    $username = $_POST['username'];
    $role     = $_POST['role'];
    if($_POST['password'] != null || $_POST['password'] == ''){
        $pass     = md5($_POST['password']);
        $query = "UPDATE user SET nama_user = '$nama' , username = '$username' , role = '$role' , password ='$pass' WHERE id_user = '$id_user'";    
    }else{
        $query = "UPDATE user SET nama_user = '$nama' , username = '$username' , role = '$role' WHERE id_user = '$id_user'";
    }
    
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil mengubah ' .$role;
        $type = 'success';
        header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}

?> 
<form id="form" method="POST">
    <h1 id="title-form">edit pengguna</h1>
    <label>Nama Pengguna</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $edit['nama_user']; ?>" name="nama_user" class="input">
            </div>
    <label>Username</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $edit['username']; ?>" name="username" class="input">
            </div>
    <label>Password</label>
            <div class="content-inputs"> 
                    <input type="text"  placeholder="Kosongkan saja jika tidak akan mengubah password" name="password" class="input">
            </div>
                      <label>Role</label>
            <div class="content-inputs"> 
                    <select name="role" class="input">
                        <?php foreach ($role as $key): ?>
                            <?php if ($key == $edit['role']): ?>
                            <option value="<?= $key ?>" selected><?= $key ?></option>    
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= ucfirst($key) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
                <input type="submit" value="selesai" name="btn-simpan" class="btn">
                </div>
  
                </form>
<?php
?> 
</body>
</html>

