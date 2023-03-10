<title>cetak laporan</title>
</head>
<body>
<?php
$title = 'laporan';
require 'functions.php';
$bulan = ambilsatubaris($conn,"SELECT SUM(total_harga) AS total FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.transaksi_id WHERE status_bayar = 'dibayar' AND MONTH(tgl_pembayaran) = MONTH(NOW())");
$tahun = ambilsatubaris($conn,"SELECT SUM(total_harga) AS total FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.transaksi_id WHERE status_bayar = 'dibayar' AND YEAR(tgl_pembayaran) = YEAR(NOW())");
$minggu = ambilsatubaris($conn,"SELECT SUM(total_harga) AS total FROM detail_transaksi INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.transaksi_id WHERE status_bayar = 'dibayar' AND WEEK(tgl_pembayaran) = WEEK(NOW())");


$penjualan = ambildata($conn,"SELECT SUM(detail_transaksi.total_harga) AS total,COUNT(detail_transaksi.paket_id) as jumlah_paket,paket.nama_paket,transaksi.tgl_pembayaran FROM detail_transaksi
INNER JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.transaksi_id
INNER JOIN paket ON paket.id_paket = detail_transaksi.paket_id
WHERE transaksi.status_bayar = 'dibayar' GROUP BY detail_transaksi.paket_id");
?>

	<center>
		<h2>DATA LAPORAN TRANSAKSI LAUNDRY</h2>
	</center>
 
<table border="1" align="center">
     <thead>
        <tr width="100px">
        <th width="50px"><label>no </label></th>
          <th width="300px"><label>nama paket</label></th>
          <th width="300px"><label>jumlah transaksi</label></th>
          <th width="300px"><label>tanggal transaksi</label></th>
          <th width="300px"><label>total hasil</label></th>
          
        </tr>
      </thead>
      <tbody>
      <?php $no=1; foreach($penjualan as $transaksi): ?>
        <tr class="data-label">
        <td align="center"><?= $no++ ?></td>
            <td><?= $transaksi['nama_paket'] ?></td>
            <td align="center"><?= $transaksi['jumlah_paket'] ?></td>
            <td><?= $transaksi['tgl_pembayaran'] ?></td>
            <td align="center"><?= $transaksi['total'] ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <script>window.print();</script>
</body>
                  