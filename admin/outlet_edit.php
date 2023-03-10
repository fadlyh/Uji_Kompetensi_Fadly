<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'outlet';
require 'functions.php';
$query = 'SELECT outlet.*, user.nama_user,user.id_user FROM outlet LEFT JOIN user ON user.outlet_id = outlet.id_outlet WHERE id_outlet = ' . $_GET['id'];
$data = ambilsatubaris($conn,$query);

$query2 = 'SELECT user.*,outlet.nama_outlet FROM outlet RIGHT JOIN user ON user.outlet_id = outlet.id_outlet WHERE user.role = "owner" order by user.outlet_id asc';
$data2 = ambildata($conn,$query2);

if(isset($_POST['btn-simpan'])){
    $nama   = $_POST['nama_outlet'];
    $alamat = $_POST['alamat_outlet'];
    $telp   = $_POST['telp_outlet'];

    $query = "UPDATE outlet SET nama_outlet = '$nama' , alamat_outlet = '$alamat' , telp_outlet='$telp' WHERE id_outlet = " . $_GET['id'];
    
    
    if($_POST['owner_id_new']){
        $query2 = "UPDATE user SET outlet_id = '" . $_GET['id'] . "' WHERE id_user = " . $_POST['owner_id_new'];
        $query3 = "UPDATE user SET outlet_id = null WHERE id_user = " . $data['id_user'];
        $execute3 = bisa($conn,$query3);
    }else{
        $query2 = "UPDATE user SET outlet_id = '" . $_GET['id'] . "' WHERE id_user = " . $_POST['owner_id'];
    }

    $execute = bisa($conn,$query);
    $execute2 = bisa($conn,$query2);

    if($execute == 1 && $execute2 == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Mengubah Data';
        $type = 'success';
        header('location: outlet.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}


?> 
<form id="form" method="POST">
    <h1 id="title-form">edit outlet</h1>
    <input type="hidden"  value="<?= $data['id_outlet']; ?>" name="id_outlet">
    <label>Nama Outlet</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $data['nama_outlet']; ?>" name="nama_outlet" class="input" required />
            </div>
                    <label>Alamat Outlet</label>
            <div class="content-inputs">
            <input type="text" value="<?= $data['alamat_outlet']; ?>" name="alamat_outlet" class="input" required />
                  
            </div>
                    <label>Nomor Telepon</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $data['telp_outlet']; ?>" name="telp_outlet" class="input" required />
            </div>
                <?php if($data['nama_user']  == null): ?> 
                        <label>Belum Ada Owner</label>
                        <div class="content-inputs">
                        <select name="owner_id" class="input">
                            <?php foreach ($data2 as $owner): ?>
                                <!-- <?= print_r($owner) ?> -->
                                <option value="<?= $owner['id_user'] ?>"><?= $owner['nama_user'] ?> 
                                    <?php if ($owner['outlet_id'] == null): ?>
                                        ( Belum memiliki outlet )
                                    <?php else: ?>
                                        ( Owner di <?= $owner['nama_outlet'] ?> )
                                    <?php endif ?>                                    
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                <?php else: ?>
                        <label>Owner Sekarang : <?= $data['nama_user']; ?></label>
                        <div class="content-inputs"> 
                        <select name="owner_id_new" class="input">
                            <option>Pilih Untuk Mengganti owner</option>
                            <?php foreach ($data2 as $owner): ?>
                                <option value="<?= $owner['id_user'] ?>"><?= $owner['nama_user'] ?> 
                                    <?php if ($owner['outlet_id'] == null): ?>
                                        ( Belum memiliki outlet )
                                    <?php else: ?>
                                        ( Owner di <?= $owner['nama_outlet'] ?> )
                                    <?php endif ?>                                    
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                <?php endif; ?>
                <input type="submit" value="selesai" name="btn-simpan" class="btn">
                </form>
            </div>
    
<?php
?> 
</body>
</html>