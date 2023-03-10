<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'paket';
require 'functions.php';
$query = 'SELECT * FROM outlet';
$data = ambildata($conn,$query);

if(isset($_POST['btn-simpan'])){
    $nama   = $_POST['nama_paket'];
    $jenis_paket = $_POST['jenis_paket'];
    $harga   = $_POST['harga'];
    $outlet_id   = $_POST['outlet_id'];

    $query = "INSERT INTO paket (nama_paket,jenis_paket,harga,outlet_id) values ('$nama','$jenis_paket','$harga','$outlet_id')";
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Simpan Data';
        $type = 'success';
        header('location: paket.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}

?> 
<form id="form" method="POST">
    <h1 id="title-form">tambah paket</h1>
    <label>Nama Paket</label>
            <div class="content-inputs"> 
                    <input type="text"   name="nama_paket" class="input">
            </div>
    <label>Jenis Paket</label>
            <div class="content-inputs">
            <select name="jenis_paket" class="input">
                        <option value="kiloan">kiloan</option>
                        <option value="selimut">selimut</option>
                        <option value="bedcover">bedcover</option>
                        <option value="kiloan">kiloan</option>
                        <option value="kaos">kaos</option>
                        <option value="lain">lain</option>
                    </select>          
            </div>
    <label>Harga</label>
            <div class="content-inputs"> 
                    <input type="text"  name="harga" class="input">
            </div>
    <label>Pilih Outlet</label>
            <div class="content-inputs"> 
            <select name="outlet_id" class="input">
                        <?php foreach ($data as $outlet): ?>
                            <option value="<?= $outlet['id_outlet'] ?>"><?= $outlet['nama_outlet']; ?></option>
                        <?php endforeach ?>
                    </select>
            </div>
                <input type="submit" value="tambah" name="btn-simpan" class="btn">
                </form>
            </div>
 </body>
</html>