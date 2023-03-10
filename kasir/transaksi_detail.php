
<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'transaksi';
require 'functions.php';
$status = ['baru','proses','selesai','diambil'];
$query = "SELECT transaksi.*,member.nama_member , detail_transaksi.*,outlet.nama_outlet,paket.nama_paket FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi INNER JOIN outlet ON outlet.id_outlet = transaksi.outlet_id INNER JOIN paket ON paket.outlet_id = transaksi.outlet_id  WHERE transaksi.id_transaksi=".$_GET['id'];
$data = ambilsatubaris($conn,$query);

if(isset($_POST['btn-simpan'])){
    $status     = $_POST['status'];
    $query = "UPDATE transaksi SET status = '$status' WHERE id_transaksi = " . $_GET['id'];
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil mengubah status transaksi';
        $type = 'success';
        header('location: transaksi.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}
?> 
<form id="form" method="POST">
    <h1 id="title-form">detail</h1>
    <label>Kode Invoice</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $data['kode_invoice'] ?>" name="kode_invoice" class="input">
            </div>
    <label>Outlet</label>
            <div class="content-inputs">
            <input type="text"  value="<?= $data['nama_outlet'] ?>" name="nama_outlet" class="input">
                  
            </div>
    <label>Pelanggan</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $data['nama_member'] ?>" name="nama_member" class="input">
            </div>
    <label>Jenis Paket</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $data['nama_paket'] ?>" name="nama_paket" class="input">
            </div>
    <label>Jumlah</label>
            <div class="content-inputs"> 
                    <input type="text"value="<?= $data['qty'] ?>" name="qty" class="input">
            </div>
    <label>Total Harga</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $data['total_harga'] ?>" name="biaya_tambahan" class="input">
            </div>
            <?php if ($data['total_bayar'] > 0 ): ?>
    <label>Total Bayar</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $data['total_bayar'] ?>" name="biaya_tambahan" class="input">
            </div>
    <label>Di Bayar Pada Tanggal </label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $data['tgl_pembayaran'] ?>" name="biaya_tambahan" class="input">
            </div>
            <?php else: ?>
    <label>Total Bayar</label>
            <div class="content-inputs"> 
                    <input type="text" placeholder="Belum Melakukan Pembayaran" name="biaya_tambahan" class="input">
            </div>
    <label>Batas Waktu Pembayaran</label>
            <div class="content-inputs"> 
                    <input type="text" value="<?= $data['batas_waktu'] ?>" name="biaya_tambahan" class="input">
            </div>
            <?php  endif;?>
    <label>Status Transaksi</label>
            <div class="content-inputs"> 
            <select name="status" class="input">
                            <?php foreach ($status as $key): ?>
                            <?php if ($key == $data['status']): ?>
                            <option value="<?= $key ?>" selected><?= $key ?></option>
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= $key ?></option>
                            <?php endforeach ?>
                        </select>
            </div>
                    <button type="submit" name="btn-simpan"  class="btn">Ubah</button>
 </form>
<?php
?> 
</body>
</html>
          
        