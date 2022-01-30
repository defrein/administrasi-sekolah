<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$nip = '';
$tampil_nama = array();

require 'functions.php';
$jadwal = query("SELECT * FROM jadwal_pelajaran, mapel, kelas, guru where mapel.kd_mapel=jadwal_pelajaran.kd_mapel and kelas.kd_kelas=jadwal_pelajaran.kd_kelas and guru.nip=jadwal_pelajaran.nip");
if (isset($_POST["refresh"])) {
    $nip = $_POST["nip"];
    $jadwal = query("SELECT * FROM jadwal_pelajaran, mapel, kelas, guru where mapel.kd_mapel=jadwal_pelajaran.kd_mapel and kelas.kd_kelas=jadwal_pelajaran.kd_kelas and guru.nip=jadwal_pelajaran.nip and guru.nip = '$nip'");
    $tampil_nama = query("SELECT nama FROM guru where guru.nip = '$nip'");
}

$user_type = $_SESSION['user_type'] == 'Super Admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Jadwal Guru</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/print.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section id="data-siswa" class="container">
        <div class="top-data">
            <h1><span class="hide-on-print">Cetak</span> Jadwal Guru</h1>
            <div class="pilihkelas hide-on-print" style="width: 80%; float:right;">
                <form action="" method="post">
                    <div class="form-group row" style="margin-left:40px;">
                        <label for="nip" class="col-3 col-form-label">Pilih Nama Guru</label>
                        <div class="col-4">
                            <select id="nip" name="nip" class="custom-select">
                                <option value="1234567890112343"
                                    <?= $nip == '1234567890112343' ? ' selected="selected"' : ''; ?>>Ria Nadiatama
                                </option>
                                <option value="1234567890112344"
                                    <?= $nip == '1234567890112344' ? ' selected="selected"' : ''; ?>>Muhammad Zain
                                </option>
                                <option value="1963122419123452"
                                    <?= $nip == '1963122419123452' ? ' selected="selected"' : ''; ?>>Dea Aryananda
                                </option>
                                <option value="1963122419890030"
                                    <?= $nip == '1963122419890030' ? ' selected="selected"' : ''; ?>>Reynara Ghavin
                                </option>
                                <option value="1963122419899008"
                                    <?= $nip == '1963122419899008' ? ' selected="selected"' : ''; ?>>Akaela Karina
                                </option>
                                <option value="1963122419899022"
                                    <?= $nip == '1963122419899022' ? ' selected="selected"' : ''; ?>>Muhammad Husain
                                </option>
                                <option value="1963122419899065"
                                    <?= $nip == '1963122419899065' ? ' selected="selected"' : ''; ?>>Ahmad Hafidzi
                                </option>
                                <option value="1963122419899999"
                                    <?= $nip == '1963122419899999' ? ' selected="selected"' : ''; ?>>Edward Bramhiers
                                </option>
                                <option value="1983122419899111"
                                    <?= $nip == '1983122419899111' ? ' selected="selected"' : ''; ?>>Aveera Narudhana
                                </option>
                                <option value="1993122419899990"
                                    <?= $nip == '1993122419899990' ? ' selected="selected"' : ''; ?>>Arisha Hanifa
                                </option>
                            </select>
                        </div>
                        <div class="buttons">
                            <button type="button" class="btn btn-danger"><a href="data-jadwal.php"
                                    style="color: #fff; text-decoration:none; ">
                                    Batal</a></button>
                            <button id="print" onclick="printTable()" class="btn btn-secondary"
                                style="margin-right: 10px;">Cetak</button>
                            <button id="show-all" class="btn btn-info" style="margin-right: 10px;">Semua</button>
                            <button name="refresh" type="submit" class="btn btn-success"
                                style="margin-right: 10px;">Refresh</button>
                        </div>
                </form>
            </div>
        </div>
        <div class="tampil_kelas" style="clear:both">
            <h5 style="margin-left: 10px;">
                <?php
                echo " ";
                foreach ($tampil_nama as $namaguru) {
                    foreach ($namaguru as $key => $val) {
                        echo "$val";
                    }
                }
                ?></h5>
        </div>
        <div class="list-guru" id="printIndentTable">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No.</th>
                        <!-- <th scope="col">NIP</th> -->
                        <th scope="col">Hari</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Jumlah Jam</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Tingkat</th>
                        <th scope="col">Pengajar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($jadwal as $row) : ?>

                    <tr>
                        <td scope="row"><?= $i; ?></td>
                        <td><?= $row["hari"]; ?></td>
                        <td><?= $row["waktu"]; ?></td>
                        <td><?= $row["nama_mapel"]; ?></td>
                        <td><?= $row["jmlh_jam"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                        <td><?= $row["tingkat"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <script>
    function printTable() {
        window.print();
    }
    </script>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>

</html>