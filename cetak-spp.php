<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// ambil data di URL
$no_kuitansi = $_GET["no_kuitansi"];

// query data spp berdasarkan no_kuitansi
$spp = query("SELECT * FROM spp, siswa, kelas WHERE siswa.nis=spp.nis and siswa.kd_kelas=kelas.kd_kelas and no_kuitansi = $no_kuitansi")[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Bukti Pembayaran SPP</title>
    <link rel="stylesheet" href="assets/css/spp.css">
    <link rel="stylesheet" href="assets/css/print.css">

    

</head>
<body>
    <header class="container">
        <h1>Bukti Pembayaran SPP</h1>
        <hr>
    </header>
    <section id="detail-spp" class="container">
        <table >
            <tr>
                <td>No. Kuitansi </td>
                <td>: <?= $spp["no_kuitansi"]; ?></td>
            </tr>
            <tr>
                <td >Tanggal Bayar</td>
                <td>: <?= $spp["tgl_bayar"]; ?></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>NIS</td>
                <td>: <?= $spp["nis"]; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: <?= $spp["nama"]; ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: <?= $spp["tingkat"]; ?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>: <?= $spp["jurusan"]; ?></td>
            </tr>
        </table>
        <br>
        <table class="right">
            <tr>
                <td>Total Bayar</td>
                <td>: Rp <?= $spp["total"]; ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>: <?= $spp["ket_bayar"]; ?></td>
            </tr>
        </table>
        <div class="petugas">
            <p class="petugas-ket">Petugas Administrasi</p>
            <p>ADMIN</p>
            <p><?= $_SESSION['username']; ?></p>
        </div>
    
    </section>
    <div class="buttons hide-on-print">
        <button id="print" onclick="printSPP()" class="cetak " style="margin-right: 10px;" >Cetak</button>
        <button type="button" class="batal"><a href="data-spp.php" >Batal</a></button>
    </div>
    <script>
        function printSPP() {
        window.print();
        }
    </script>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>
</html>