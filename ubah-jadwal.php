<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

// ambil data di URL
$kd_jadwal = $_GET["kd_jadwal"];

// query data mahasiswa berdasarkan id
$jadwal_pelajaran = query("SELECT * FROM jadwal_pelajaran WHERE kd_jadwal = $kd_jadwal")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubahJadwal($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'data-jadwal.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
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
    <title>Ubah Data Siswa</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header class="container">
        <h3>Ubah Data Siswa</h3>
    </header>
    <section id="edit-data-siswa" class="container">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="kd_jadwal" class="col-4 col-form-label">Kode Jadwal</label>
                <div class="col-8">
                    <input id="kd_jadwal" name="kd_jadwal" placeholder="masukkan kode jadwal" type="text"
                        class="form-control" required="required" value="<?= $jadwal_pelajaran["kd_jadwal"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="hari" class="col-4 col-form-label">Hari</label>
                <div class="col-8">
                    <input id="hari" name="hari" placeholder="masukkan hari" type="text" class="form-control"
                        required="required" value="<?= $jadwal_pelajaran["hari"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="waktu" class="col-4 col-form-label">Waktu</label>
                <div class="col-8">
                    <input id="waktu" name="waktu" placeholder="masukkan waktu mulai mata pelajaran" type="text"
                        class="form-control" required="required" aria-describedby="waktuHelpBlock"
                        value="<?= $jadwal_pelajaran["waktu"]; ?>">
                    <span id="waktuHelpBlock" class="form-text text-muted">format: (jj:mm:dd)</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="kd_mapel" class="col-4 col-form-label">Mata Pelajaran</label>
                <div class="col-8">
                    <select id="kd_mapel" name="kd_mapel" class="custom-select">
                        <option value="1000"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1000' ? ' selected="selected"' : ''; ?>>Matematika
                        </option>
                        <option value="1001"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1001' ? ' selected="selected"' : ''; ?>>Biologi
                        </option>
                        <option value="1002"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1002' ? ' selected="selected"' : ''; ?>>Bahasa Inggris
                        </option>
                        <option value="1003"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1003' ? ' selected="selected"' : ''; ?>>Fisika
                        </option>
                        <option value="1004"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1004' ? ' selected="selected"' : ''; ?>>Bahasa
                            Indonesia</option>
                        <option value="1005"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1005' ? ' selected="selected"' : ''; ?>>Kimia</option>
                        <option value="1006"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1006' ? ' selected="selected"' : ''; ?>>Ekonomi
                        </option>
                        <option value="1007"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1007' ? ' selected="selected"' : ''; ?>>Sosiologi
                        </option>
                        <option value="1008"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1008' ? ' selected="selected"' : ''; ?>>Sejarah
                        </option>
                        <option value="1009"
                            <?= $jadwal_pelajaran['kd_mapel'] == '1009' ? ' selected="selected"' : ''; ?>>Sastra Jepang
                        </option>
                    </select>
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="nip" class="col-4 col-form-label">NIP Pengajar</label>
                <div class="col-8">
                    <input id="nip" name="nip" placeholder="masukkan nip" type="text" class="form-control"
                        required="required">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="nip" class="col-4 col-form-label">Pengajar</label>
                <div class="col-8">
                    <select id="nip" name="nip" class="custom-select">
                        <option value="1234567890112343"
                            <?= $jadwal_pelajaran['nip'] == '1234567890112343' ? ' selected="selected"' : ''; ?>>Ria
                            Nadiatama</option>
                        <option value="1234567890112344"
                            <?= $jadwal_pelajaran['nip'] == '1234567890112344' ? ' selected="selected"' : ''; ?>>
                            Muhammad Zain</option>
                        <option value="1963122419123452"
                            <?= $jadwal_pelajaran['nip'] == '1963122419123452' ? ' selected="selected"' : ''; ?>>Dea
                            Aryananda</option>
                        <option value="1963122419890030"
                            <?= $jadwal_pelajaran['nip'] == '1963122419890030' ? ' selected="selected"' : ''; ?>>Reynara
                            Ghavin</option>
                        <option value="1963122419899008"
                            <?= $jadwal_pelajaran['nip'] == '1963122419899008' ? ' selected="selected"' : ''; ?>>Akaela
                            Karina</option>
                        <option value="1963122419899022"
                            <?= $jadwal_pelajaran['nip'] == '1963122419899022' ? ' selected="selected"' : ''; ?>>
                            Muhammad Husain</option>
                        <option value="1963122419899065"
                            <?= $jadwal_pelajaran['nip'] == '1963122419899065' ? ' selected="selected"' : ''; ?>>Ahmad
                            Hafidzi</option>
                        <option value="1963122419899999"
                            <?= $jadwal_pelajaran['nip'] == '1963122419899999' ? ' selected="selected"' : ''; ?>>Edward
                            Bramhiers</option>
                        <option value="1983122419899111"
                            <?= $jadwal_pelajaran['nip'] == '1983122419899111' ? ' selected="selected"' : ''; ?>>Aveera
                            Narudhana</option>
                        <option value="1993122419899990"
                            <?= $jadwal_pelajaran['nip'] == '1993122419899990' ? ' selected="selected"' : ''; ?>>Arisha
                            Hanifa</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="kd_kelas" class="col-4 col-form-label">Kode Kelas</label>
                <div class="col-8">
                    <select id="kd_kelas" name="kd_kelas" class="custom-select">
                        <option value="B100"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'B100' ? ' selected="selected"' : ''; ?>>B100</option>
                        <option value="B110"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'B110' ? ' selected="selected"' : ''; ?>>B110</option>
                        <option value="B120"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'B120' ? ' selected="selected"' : ''; ?>>B120</option>
                        <option value="M100"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'M100' ? ' selected="selected"' : ''; ?>>M100</option>
                        <option value="M110"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'M110' ? ' selected="selected"' : ''; ?>>M110</option>
                        <option value="M120"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'M120' ? ' selected="selected"' : ''; ?>>M120</option>
                        <option value="S100"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'S100' ? ' selected="selected"' : ''; ?>>S100</option>
                        <option value="S110"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'S110' ? ' selected="selected"' : ''; ?>>S110</option>
                        <option value="S120"
                            <?= $jadwal_pelajaran['kd_kelas'] == 'S120' ? ' selected="selected"' : ''; ?>>S120</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label for="jmlh_jam" class="col-4 col-form-label">Jumlah Jam</label>
                <div class="col-8">
                    <input id="jmlh_jam" name="jmlh_jam" placeholder="masukkan jumlah jam pelajaran" type="text"
                        class="form-control" required="required" value="<?= $jadwal_pelajaran["jmlh_jam"]; ?>">
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