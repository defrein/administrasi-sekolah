<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'functions.php';
$siswa = query("SELECT * FROM siswa, kelas where kelas.kd_kelas=siswa.kd_kelas");
$kd_kelas = '';
if (isset($_POST["refresh"])) {
    $kd_kelas = $_POST["kd_kelas"];

    $siswa = query("SELECT * FROM siswa, kelas where kelas.kd_kelas=siswa.kd_kelas and siswa.kd_kelas = '$kd_kelas'");
}


$user_type = $_SESSION['user_type'] == 'Super Admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Siswa</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/print.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section id="data-siswa" class="container">
        <div class="top-data">
            <h1><span class="hide-on-print">Cetak</span> Data Siswa</h1>
            <div class="pilihkelas hide-on-print" style="width: 60%; float:right;">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="kd_kelas" class="col-2 col-form-label">Pilih Kelas</label>
                        <div class="col-4">
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
                                    href="data-siswa.php" style="color: #fff; text-decoration:none; ">
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
        <div class="list-siswa" id="printIndentTable">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($siswa as $row) : ?>

                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["nis"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["jns_kelamin"]; ?></td>
                        <td><?= $row["alamat"]; ?></td>
                        <td><?= $row["tingkat"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
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