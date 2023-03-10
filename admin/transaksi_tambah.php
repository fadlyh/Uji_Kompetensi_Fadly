<!DOCTYPE html>
<html lang="en">

<head>
<link href="../css/edit.css?version=<?= filemtime("../css/edit.css")?>" rel="stylesheet">
</head>
<body>
<?php
$title = 'pengguna';
require 'functions.php';
$tgl_sekarang = Date('Y-m-d h:i:s');
$tujuh_hari   = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
$batas_waktu  = date("Y-m-d h:i:s", $tujuh_hari);


$invoice   = 'DRY'.Date('Ymdsi');
$user_id   = $_SESSION['user_id']; 
$member_id = $_GET['id'];
$outlet_id = ambilsatubaris($conn, "SELECT outlet_id FROM transaksi WHERE member_id = $member_id");
$outlet = ambilsatubaris($conn,'SELECT nama_outlet from outlet WHERE id_outlet = ' . $outlet_id['outlet_id']);
$member = ambilsatubaris($conn,'SELECT nama_member from member WHERE id_member = ' . $member_id);
$paket = ambildata($conn,'SELECT * FROM paket WHERE outlet_id = ' . $outlet_id['outlet_id']);
if(isset($_POST['btn-simpan'])){   
    $kode_invoice = $_POST['kode_invoice'];
    $biaya_tambah = $_POST['biaya_tambahan'];
    $diskon = $_POST['diskon'];
    $pajak = $_POST['pajak'];
    $outleta = $outlet_id['outlet_id'];
    
    $query = "INSERT INTO transaksi (outlet_id,kode_invoice,member_id,tgl,batas_waktu,biaya_tambahan,diskon,pajak,status,status_bayar,user_id) VALUES ('$outleta','$kode_invoice','$member_id','$tgl_sekarang','$batas_waktu','$biaya_tambah','$diskon','$pajak','baru','belum','$user_id')";

    $execute = bisa($conn,$query);
    if ($execute == 1) {
        $paket_id = $_POST['id_paket'];
        $qty = $_POST['qty'];
        $hargapaket = ambilsatubaris($conn,'SELECT harga from paket WHERE id_paket = ' . $paket_id);
        $total1 = $hargapaket['harga'] * $qty;
        
        if ($biaya_tambah != 0 && $pajak != 0 && $diskon != 0) {
            $total3 = $total1 - ($total1 * $diskon / 100);
            $total2 = $biaya_tambah + $total3;
            $total_harga = $total2 + ($total2 * $pajak / 100);
        } elseif ($biaya_tambah != 0 && $diskon != 0) {
            $total2 = $total1 - ($total1 * $diskon / 100);
            $total = $biaya_tambah + $total2;
        } elseif ($biaya_tambah != 0 && $pajak != 0) {
            $total2 = $total1 + $biaya_tambah;
            $total_harga = $total2 + ($total2 * $pajak / 100);
        } elseif ($diskon != 0 && $pajak != 0) {
            $total2 = $total1 - ($total1 * $diskon / 100);
            $total_harga = $total2 + ($total2 * $pajak / 100);
        } elseif ($biaya_tambah != 0) {
            $total_harga = $total1 + $biaya_tambah;
        } elseif ($diskon != 0) {
            $total_harga = $total1 - ($total1 * $diskon / 100);
        } elseif ($pajak != 0) {
            $total_harga = $total1 + ($total1 * $pajak / 100);
        } else {
            $total_harga = $total1;
        }

        $kode_invoice;
        $transaksi = ambilsatubaris($conn,"SELECT * FROM transaksi WHERE kode_invoice = '" . $kode_invoice ."'");
        $transaksi_id = $transaksi['id_transaksi'];
            
        $sqlDetail = "INSERT INTO detail_transaksi (transaksi_id,paket_id,qty,total_harga) VALUES ('$transaksi_id','$paket_id','$qty','$total_harga')";

        $executeDetail = bisa($conn,$sqlDetail);
        if($executeDetail == 1){
            header('location: transaksi_sukses.php?id='.$transaksi_id);
        }else{
            echo "Gagal Tambah Data";
        }
    }
    
}
?>
    <form id="form" method="POST">
    <h1 id="title-form">tambah transaksii</h1>
    <label>Kode Invoice</label>
            <div class="content-inputs"> 
                    <input type="text"  value="<?= $invoice ?>"  name="kode_invoice" readonly="" class="input">
            </div>
    <label>Outlet</label>
            <div class="content-inputs">
            <input type="text" name="nama_outlet" value="<?= $outlet['nama_outlet'] ?>"  readonly="" class="input">
                  
            </div>
    <label>Pelanggan</label>
            <div class="content-inputs"> 
                    <input type="text"  name="nama_member" value="<?= $member['nama_member'] ?>"  readonly="" class="input">
            </div>

    <label>Pilih Paket</label>
            <div class="content-inputs"> 
            <select name="id_paket" class="input">
                        <?php foreach ($paket as $key): ?>
                            <option value="<?= $key['id_paket'] ?>"><?= $key['nama_paket'];  ?></option>
                        <?php endforeach ?>
                    </select>
            </div>

    <label>Jumlah</label>
            <div class="content-inputs"> 
                    <input type="text" placeholder="0" name="qty" class="input">
            </div>
            
    <label>Biaya Tambahan</label>
            <div class="content-inputs"> 
                    <input type="text" placeholder="0" name="biaya_tambahan" class="input">
            </div>

    <label>Diskon (%)</label>
            <div class="content-inputs"> 
                    <input type="text" placeholder="0" name="diskon" class="input">
            </div>

    <label>Pajak</label>
            <div class="content-inputs"> 
                    <input type="text"   value="10" name="pajak" class="input" readonly>
            </div>

                <input type="submit" value="tambah" name="btn-simpan" class="btn">
                </form>
            </div>

 </body>
</html>
            
           