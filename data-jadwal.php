<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
// $jadwal = query("SELECT * FROM jadwal_pelajaran, mapel, kelas, guru where mapel.kd_mapel=jadwal_pelajaran.kd_mapel and kelas.kd_kelas=jadwal_pelajaran.kd_kelas and guru.nip = jadwal_pelajaran.nip");
$jadwal = query("SELECT * FROM jadwal_pelajaran, mapel, kelas, guru where mapel.kd_mapel=jadwal_pelajaran.kd_mapel and kelas.kd_kelas=jadwal_pelajaran.kd_kelas and guru.nip=jadwal_pelajaran.nip");
$user_type = $_SESSION['user_type'] == 'Super Admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jadwal</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="welcome">
            <h1>Administrasi Sekolah</h1>
            <p>Selamat datang,
                <?php
                echo $_SESSION['username'];
                ?>
            </p>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Menu Utama</a></li>
                <?php if ($user_type) {
                ?>
                <li id="list-admin"><a href="data-admin.php">List Admin</a></li>
                <?php } ?>
            </ul>
        </nav>
        <a href="logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a>
    </header>
    <section id="data-jadwal" class="container" style="margin-top: 40px;">
        <div class="top-data">
            <h1>Data Jadwal Pelajaran</h1>
            <button type="button" class="btn btn-primary"><a href="tambah-jadwal.php"
                    style="color: #fff; text-decoration:none;"> + Tambah Data</a></button>
            <button type="button" class="btn btn-secondary" style="margin-right:20px;"><a href="cetak-jadwal-guru.php"
                    style="color: #fff; text-decoration:none; "> Cetak Jadwal Guru</a></button>
            <button type="button" class="btn btn-secondary" style="margin-right:20px;"><a href="cetak-jadwal-kelas.php"
                    style="color: #fff; text-decoration:none; "> Cetak Jadwal Kelas</a></button>
        </div>
        <div class="list-jadwal">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode Jadwal</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Pengajar</th>
                        <th scope="col">Kode Kelas</th>
                        <th scope="col">Jumlah Jam</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($jadwal as $row) : ?>

                    <tr>
                        <td scope="row"><?= $i; ?></td>
                        <td scope="row"><?= $row["kd_jadwal"]; ?></td>
                        <td><?= $row["hari"]; ?></td>
                        <td><?= $row["waktu"]; ?></td>
                        <td><?= $row["nama_mapel"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["kd_kelas"]; ?></td>
                        <td><?= $row["jmlh_jam"]; ?></td>
                        <td class="button-action">
                            <a href="ubah-jadwal.php?kd_jadwal=<?= $row["kd_jadwal"]; ?>"><button type="button"
                                    class="btn btn-warning">Edit</button></a>
                            <a href="hapus-jadwal.php?kd_jadwal=<?= $row["kd_jadwal"]; ?>"><button type="button"
                                    class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </section>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>

</html>