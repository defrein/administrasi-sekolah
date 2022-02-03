<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$kd_kelas = '';
$tampil_tingkat = array();
$tampil_jurusan = array();

require 'functions.php';
$jadwal = query("SELECT * FROM jadwal_pelajaran, mapel, kelas, guru where mapel.kd_mapel=jadwal_pelajaran.kd_mapel and kelas.kd_kelas=jadwal_pelajaran.kd_kelas and guru.nip=jadwal_pelajaran.nip");
if (isset($_POST["refresh"])) {
    $kd_kelas = $_POST["kd_kelas"];

    $jadwal = query("SELECT * FROM jadwal_pelajaran, mapel, kelas, guru where mapel.kd_mapel=jadwal_pelajaran.kd_mapel and kelas.kd_kelas=jadwal_pelajaran.kd_kelas and guru.nip=jadwal_pelajaran.nip and kelas.kd_kelas = '$kd_kelas'");
    $tampil_tingkat = query("SELECT tingkat FROM kelas where  kelas.kd_kelas = '$kd_kelas'");
    $tampil_jurusan = query("SELECT jurusan FROM kelas where  kelas.kd_kelas = '$kd_kelas'");
}


$user_type = $_SESSION['user_type'] == 'Super Admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Jadwal Kelas</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/print.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section id="data-siswa" class="container">
        <div class="top-data">
            <h1><span class="hide-on-print">Cetak</span> Jadwal Pelajaran </h1>
            <div class="pilihkelas hide-on-print" style="width: 60%; float:right;">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="kd_kelas" class="col-3 col-form-label">Pilih Kelas</label>
                        <div class="col-3">
                            <select id="kd_kelas" name="kd_kelas" class="custom-select">
                                <option value="B100" <?= $kd_kelas == 'B100' ? ' selected="selected"' : ''; ?>>10 Bahasa
                                </option>
                                <option value="B110" <?= $kd_kelas == 'B110' ? ' selected="selected"' : ''; ?>>11 Bahasa
                                </option>
                                <option value="B120" <?= $kd_kelas == 'B120' ? ' selected="selected"' : ''; ?>>12 Bahasa
                                </option>
                                <option value="M100" <?= $kd_kelas == 'M100' ? ' selected="selected"' : ''; ?>>10 MIPA
                                </option>
                                <option value="M110" <?= $kd_kelas == 'M110' ? ' selected="selected"' : ''; ?>>11 MIPA
                                </option>
                                <option value="M120" <?= $kd_kelas == 'M120' ? ' selected="selected"' : ''; ?>>12 MIPA
                                </option>
                                <option value="S100" <?= $kd_kelas == 'S100' ? ' selected="selected"' : ''; ?>>10 Sosial
                                </option>
                                <option value="S110" <?= $kd_kelas == 'S110' ? ' selected="selected"' : ''; ?>>11 Sosial
                                </option>
                                <option value="S120" <?= $kd_kelas == 'S120' ? ' selected="selected"' : ''; ?>>12 Sosial
                                </option>
                            </select>
                        </div>
                        <div class="buttons">
                            <button type="button" class="btn btn-danger" style="margin-right:10px;"><a
                                    href="data-jadwal.php" style="color: #fff; text-decoration:none; ">
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
                foreach ($tampil_tingkat as $tingkat) {
                    foreach ($tingkat as $key => $val) {
                        echo "Kelas $val ";
                    }
                }
                foreach ($tampil_jurusan as $jurusan) {
                    foreach ($jurusan as $key => $val) {
                        echo "$val";
                    }
                }
                ?></h5>
        </div>
        <div class="list-siswa" id="printIndentTable">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
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