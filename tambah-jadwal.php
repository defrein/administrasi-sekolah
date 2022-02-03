<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil di tambahkan atau tidak
    if (tambahJadwal($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'data-jadwal.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal ditambahkan!');
                document.location.href = 'data-jadwal.php';
			</script>
		";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Jadwal</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header class="container">
        <h3>Tambah Data Jadwal</h3>
    </header>
    <section id="tambah-data-jadwal" class="container">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="kd_jadwal" class="col-4 col-form-label">Kode Jadwal</label>
                <div class="col-8">
                    <input id="kd_jadwal" name="kd_jadwal" placeholder="masukkan kode jadwal" type="text"
                        class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="hari" class="col-4 col-form-label">Hari</label>
                <div class="col-8">
                    <input id="hari" name="hari" placeholder="masukkan hari" type="text" class="form-control"
                        required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="waktu" class="col-4 col-form-label">Waktu</label>
                <div class="col-8">
                    <input id="waktu" name="waktu" placeholder="masukkan waktu mulai mata pelajaran" type="text"
                        class="form-control" required="required" aria-describedby="waktuHelpBlock">
                    <span id="waktuHelpBlock" class="form-text text-muted">format: (jj:mm:dd)</span>
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="nip" class="col-4 col-form-label">NIP Mengajar</label>
                <div class="col-8">
                    <input id="nip" name="nip" placeholder="masukkan nip" type="text" class="form-control"
                        required="required">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="kd_mapel" class="col-4 col-form-label">Mata Pelajaran</label>
                <div class="col-8">
                    <select id="kd_mapel" name="kd_mapel" class="custom-select">
                        <option value="1000">Matematika</option>
                        <option value="1001">Biologi</option>
                        <option value="1002">Bahasa Inggris</option>
                        <option value="1003">Fisika</option>
                        <option value="1004">Bahasa Indonesia</option>
                        <option value="1005">Kimia</option>
                        <option value="1006">Ekonomi</option>
                        <option value="1007">Sosiologi</option>
                        <option value="1008">Sejarah</option>
                        <option value="1009">Sastra Jepang</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nip" class="col-4 col-form-label">Pengajar</label>
                <div class="col-8">
                    <select id="nip" name="nip" class="custom-select">
                        <option value="1234567890112343">Ria Nadiatama</option>
                        <option value="1234567890112344">Muhammad Zain</option>
                        <option value="1963122419123452">Dea Aryananda</option>
                        <option value="1963122419890030">Reynara Ghavin</option>
                        <option value="1963122419899008">Akaela Karina</option>
                        <option value="1963122419899022">Muhammad Husain</option>
                        <option value="1963122419899065">Ahmad Hafidzi</option>
                        <option value="1963122419899999">Edward Bramhiers</option>
                        <option value="1983122419899111">Aveera Narudhana</option>
                        <option value="1993122419899990">Arisha Hanifa</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="kd_kelas" class="col-4 col-form-label">Kode Kelas</label>
                <div class="col-8">
                    <select id="kd_kelas" name="kd_kelas" class="custom-select">
                        <option value="B100">B100</option>
                        <option value="B110">B110</option>
                        <option value="B120">B120</option>
                        <option value="M100">M100</option>
                        <option value="M110">M110</option>
                        <option value="M120">M120</option>
                        <option value="S100">S100</option>
                        <option value="S110">S110</option>
                        <option value="S120">S120</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="jmlh_jam" class="col-4 col-form-label">Jumlah Jam</label>
                <div class="col-8">
                    <input id="jmlh_jam" name="jmlh_jam" placeholder="masukkan jumlah jam pelajaran" type="text"
                        class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-success">Submit</button>
                    <button name="submit" type="submit" class="btn btn-danger"><a href="data-jadwal.php"
                            style="color: #fff; text-decoration:none; ">Cancel</a></button>
                </div>
            </div>

        </form>
    </section>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>

</html>