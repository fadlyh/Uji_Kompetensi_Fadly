<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'outlet';
require 'functions.php';


if(isset($_POST['btn-simpan'])){
    $nama   = $_POST['nama_outlet'];
    $alamat = $_POST['alamat_outlet'];
    $telp   = $_POST['telp_outlet'];

    $query = "INSERT INTO outlet (nama_outlet,alamat_outlet,telp_outlet) values ('$nama','$alamat','$telp')";
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Simpan Data';
        $type = 'success';
        header('location: outlet.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}
?> 


<form id="form" method="POST">
    <h1 id="title-form">tambah outlet</h1>
    <label>Nama Outlet</label>
            <div class="content-inputs"> 
                    <input type="text"   name="nama_outlet" class="input" required />
            </div>
                    <label>Alamat Outlet</label>
            <div class="content-inputs">
            <input type="text"  name="alamat_outlet" class="input" required />
                  
            </div>
                    <label>Nomor Telepon</label>
            <div class="content-inputs"> 
                    <input type="text"  name="telp_outlet" class="input" required />
            </div>
               
                <input type="submit" value="tambah" name="btn-simpan" class="btn">
                </form>
            </div>
    