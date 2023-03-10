<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'transaksi';
require'functions.php';
$query = 'SELECT transaksi.*,member.nama_member , detail_transaksi.total_harga FROM transaksi INNER JOIN member ON member.id_member = transaksi.member_id INNER JOIN detail_transaksi ON detail_transaksi.transaksi_id = transaksi.id_transaksi WHERE transaksi.id_transaksi = ' . $_GET['id'];
$data = ambilsatubaris($conn,$query);
if(isset($_POST['btn-simpan'])) {
    $total_bayar = $_POST['total_bayar'];
    if($total_bayar >= $data['total_harga']){
        $query = "UPDATE transaksi SET status_bayar = 'dibayar',tgl_pembayaran = '" . Date('Y-m-d h:i:s') . "' WHERE id_transaksi = " . $_GET['id'];
        $query2 = "UPDATE detail_transaksi SET total_bayar = '$total_bayar' WHERE transaksi_id = " . $_GET['id'];
        $execute = bisa($conn,$query);
        $execute2 = bisa($conn,$query2);
        if($execute == 1 && $execute2 == 1){
            echo "<script>alert('OK');</script>";
            header('location:transaksi_telah_dibayar.php?id='.$_GET['id']);
        }else{
            echo "Gagal Tambah Data";
        }   
    }else{
        $message = "Jumlah Uang Pembayaran Kurang";
        header('location:transaksi_bayar.php?id='.$_GET['id']. '&msg='.$message);
    }
}
?> 


<form id="form" method="POST" action="transaksi_bayar.php?id=<?= $data['id_transaksi'] ?>">
    <h1 id="title-form">transaksi</h1>
    <label>Kode Invoice</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $data['kode_invoice'] ?>" name="kode_invoice" class="input">
            </div>
    <label>Nama Member</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $data['nama_member']; ?>" name="nama_member" class="input">

            </div>
    <label>Total Yang Harus Di Bayar</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $data['total_harga'] ?>" name="total_harga" class="input">
            </div>

    <label>Masukan Jumlah Pembayaran</label>
            <div class="content-inputs"> 
                    <input type="number"  value="<?= $edit['telp_member']; ?>" name="total_bayar" id="total_bayar" class="input">
                    <?php if (isset($_GET['msg'])): ?>
                        <small class="text-danger"><?= $_GET['msg'] ?></small>
                    <?php endif ?>
                </div>
            <input type="submit" value="konfirmasi" name="btn-simpan" class="btn">
                </form>
            </div>
    
<?php
?> 
</body>
</html>

