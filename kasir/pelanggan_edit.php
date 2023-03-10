<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'pelanggan';
require 'functions.php';

$id_member = $_GET['id'];
$queryedit = "SELECT * FROM member WHERE id_member = '$id_member'";
$edit = ambilsatubaris($conn,$queryedit);

if(isset($_POST['btn-simpan'])){
    $nama     = $_POST['nama_member'];
    $alamat_member = $_POST['alamat_member'];
    $no_ktp     = $_POST['no_ktp']; 
    $telp_member     = $_POST['telp_member']; 
    $jenis_kelamin     = $_POST['jenis_kelamin']; 
    $query = "UPDATE member SET nama_member = '$nama', alamat_member = '$alamat_member', no_ktp = '$no_ktp', telp_member = '$telp_member', jenis_kelamin = '$jenis_kelamin' WHERE id_member ='$id_member'";
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil mengubah pelanggan';
        $type = 'success';
        header('location: pelanggan.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}


?> 
<form id="form" method="POST">
    <h1 id="title-form">edit pelanggan</h1>
    <label>No KTP Member</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $edit['no_ktp']; ?>" name="no_ktp" class="input">
            </div>
    <label>Nama Member</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $edit['nama_member']; ?>" name="nama_member" class="input">

            </div>
    <label>Alamat Member</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $edit['alamat_member']; ?>" name="alamat_member" class="input">
            </div>

    <label>No Telepon</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $edit['telp_member']; ?>" name="telp_member" class="input">

            </div>
    <label>Jenis Kelamin</label>
            <div class="content-inputs"> 
            <select name="jenis_kelamin" class="input">
                        <option value="L" <?php if($edit['jenis_kelamin']  == 'L'){echo "selected";} ?>>Laki-laki</option>
                        <option value="P" <?php if($edit['jenis_kelamin']  == 'P'){echo "selected";} ?>>Perempuan</option>
                    </select>
            </div>
            <input type="submit" value="selesai" name="btn-simpan" class="btn">
                </form>
            </div>
    
<?php
?> 
</body>
</html>