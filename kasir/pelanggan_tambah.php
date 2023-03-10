
<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'pelanggan';
require 'functions.php';

if(isset($_POST['btn-simpan'])){
    $nama     = $_POST['nama_member'];
    $alamat_member = $_POST['alamat_member'];
    $no_ktp     = $_POST['no_ktp']; 
    $telp_member     = $_POST['telp_member']; 
    $jenis_kelamin     = $_POST['jenis_kelamin']; 
    $query = "INSERT INTO member (nama_member,alamat_member,no_ktp,telp_member,jenis_kelamin) values ('$nama','$alamat_member','$no_ktp','$telp_member','$jenis_kelamin')";
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil menambahkan ' .$role. ' baru';
        $type = 'success';
        header('location: pelanggan.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}
?> 

<form id="form" method="POST">
    <h1 id="title-form">tambah pelanggan</h1>
    <label>No KTP Member</label>
            <div class="content-inputs"> 
                    <input type="text"   name="no_ktp" class="input">
            </div>
    <label>Nama Member</label>
            <div class="content-inputs">
            <input type="text"  name="nama_member" class="input">
                  
            </div>
    <label>Alamat Member</label>
            <div class="content-inputs"> 
                    <input type="text"  name="alamat_member" class="input">
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
                <input type="submit" value="tambah" name="btn-simpan" class="btn">
                </form>
            </div>
</body>
</html>