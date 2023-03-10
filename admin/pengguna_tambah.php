<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'pengguna';
require'functions.php';
$outlet = ambildata($conn,'SELECT * FROM outlet');
if(isset($_POST['btn-simpan'])){
    $nama     = $_POST['nama_user'];
    $username = $_POST['username'];
    $pass     = md5($_POST['password']);
    $role     = $_POST['role'];
    if($role == 'kasir'){
        $outlet_id = $_POST['outlet_id'];
        $query = "INSERT INTO user (nama_user,username,password,role,outlet_id) values ('$nama','$username','$pass','$role','$outlet_id')";
    }else{
        $query = "INSERT INTO user (nama_user,username,password,role) values ('$nama','$username','$pass','$role')";
    
    }
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil menambahkan ' .$role. ' baru';
        $type = 'success';
        header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}

?> 
<form id="form" method="POST">
    <h1 id="title-form">tambah pengguna</h1>
    <label>Nama Pengguna</label>
            <div class="content-inputs"> 
                    <input type="text"   name="nama_user" class="input">
            </div>
    <label>Username</label>
            <div class="content-inputs">
            <input type="text"  name="username" class="input">
                  
            </div>
    <label>Password</label>
            <div class="content-inputs"> 
                    <input type="text"  name="password" class="input">
            </div>
    <label>No Telepon</label>
            <div class="content-inputs"> 
                    <input type="text"  name="telp_member" class="input">
            </div>
    <label>Jenis Kelamin</label>
            <div class="content-inputs"> 
            <select name="jenis_kelamin" class="input">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
            </div>
    <label>Role</label>
            <div class="content-inputs"> 
            <select name="role" class="input">
                        <option value="admin">Admin</option>
                        <option value="owner">Owner</option>
                        <option value="kasir">Kasir</option>
                    </select>
            </div>
    <label>Jika Role Nya Kasir Maka Pilih Outlet Dimana Dia Akan Ditempatkan</label>
            <div class="content-inputs"> 
            <select name="outlet_id" class="input">
                        <?php foreach ($outlet as $key): ?>
                            <option value="<?= $key['id_outlet'] ?>"><?= $key['nama_outlet'] ?></option>
                        <?php endforeach ?>
                    </select>
            </div>
                <input type="submit" value="tambah" name="btn-simpan" class="btn">
                </form>
            </div>
</body>
</html>