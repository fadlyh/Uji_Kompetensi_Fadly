<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'paket';
require 'functions.php';

$jenis = ['kiloan','selimut','bedcover','kaos','lain'];

$id_paket = $_GET['id'];
$queryedit = "SELECT * FROM paket WHERE id_paket = '$id_paket'";
$edit = ambilsatubaris($conn,$queryedit);


$query = 'SELECT * FROM outlet';
$data = ambildata($conn,$query);

if(isset($_POST['btn-simpan'])){
    $nama   = $_POST['nama_paket'];
    $jenis_paket = $_POST['jenis_paket'];
    $harga   = $_POST['harga'];
    $id_outlet  = $_POST['id_outlet'];

    $query = "UPDATE paket SET nama_paket='$nama',jenis_paket='$jenis_paket',harga='$harga',id_outlet='$id_outlet' WHERE id_paket = '$id_paket'";
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Ubah Data';
        $type = 'success';
        header('location: paket.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}

?> 
<form id="form" method="POST">
    <h1 id="title-form">edit paket</h1>
    <input type="hidden" value="<?= $edit['id_paket']; ?>" name="id_paket" class="input">
    <label>Nama Paket</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $edit['nama_paket']; ?>" name="nama_paket" class="input">
            </div>
    <label>Jenis Paket</label>
            <div class="content-inputs"> 
            <select name="jenis_paket" class="input">
                        <?php foreach ($jenis as $key): ?>
                            <?php if ($key == $edit['jenis_paket']): ?>
                            <option value="<?= $key ?>" selected><?= $key ?></option>    
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
            </div>
            
    <label>Harga</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $edit['harga']; ?>" name="harga" class="input">
            </div>

    <label>Pilih Outlet</label>
            <div class="content-inputs"> 
                    <select name="id_out" class="input">
                                <?php foreach ($data as $outlet): ?>
                                    <?php if ($data['id_outlet'] == $edit['id_outlet']): ?>
                                    <option value="<?= $outlet['id_outlet'] ?>" selected><?= $outlet['nama_outlet']; ?></option>
                                    <?php endif ?>
                                    <option value="<?= $outlet['id_outlet'] ?>"><?= $outlet['nama_outlet']; ?></option>
                                <?php endforeach ?>
                    </select>
            </div>
                <input type="submit" value="selesai" name="btn-simpan"  class="btn">
                </form>
            </div>
    
<?php
?> 
</body>
</html>
