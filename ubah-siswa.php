<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

// ambil data di URL
$nis = $_GET["nis"];

// query data mahasiswa berdasarkan id
$siswa = query("SELECT * FROM siswa WHERE nis = $nis")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubahSiswa($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'data-siswa.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'data-siswa.php';
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
                <label for="nis" class="col-4 col-form-label">NIS</label>
                <div class="col-8">
                    <input id="nis" name="nis" placeholder="masukkan nis siswa" type="text" class="form-control"
                        required="required" value="<?= $siswa["nis"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-4 col-form-label">Nama</label>
                <div class="col-8">
                    <input id="nama" name="nama" placeholder="masukkan nama siswa" type="text" class="form-control"
                        required="required" value="<?= $siswa["nama"]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4">Jenis Kelamin</label>
                <div class="col-8">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input name="jns_kelamin" id="jns_kelamin_0" type="radio" class="custom-control-input"
                            value="Laki-laki" required="required"
                            <?php echo ($siswa['jns_kelamin'] == 'Laki-laki') ? 'checked' : '' ?>>
                        <label for="jns_kelamin_0" class="custom-control-label">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input name="jns_kelamin" id="jns_kelamin_1" type="radio" class="custom-control-input"
                            value="Perempuan" required="required"
                            <?php echo ($siswa['jns_kelamin'] == 'Perempuan') ? 'checked' : '' ?>>
                        <label for="jns_kelamin_1" class="custom-control-label">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-4 col-form-label">Alamat</label>
                <div class="col-8">
                    <textarea id="alamat" name="alamat" cols="40" rows="3"
                        class="form-control"><?php echo $siswa["alamat"]; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="kd_kelas" class="col-4 col-form-label">Kelas</label>
                <div class="col-8">
                    <select id="kd_kelas" name="kd_kelas" class="custom-select">
                        <option value="B100" <?= $siswa['kd_kelas'] == 'B100' ? ' selected="selected"' : ''; ?>>10
                            Bahasa</option>
                        <option value="B110" <?= $siswa['kd_kelas'] == 'B110' ? ' selected="selected"' : ''; ?>>11
                            Bahasa</option>
                        <option value="B120" <?= $siswa['kd_kelas'] == 'B120' ? ' selected="selected"' : ''; ?>>12
                            Bahasa</option>
                        <option value="M100" <?= $siswa['kd_kelas'] == 'M100' ? ' selected="selected"' : ''; ?>>10 MIPA
                        </option>
                        <option value="M110" <?= $siswa['kd_kelas'] == 'M110' ? ' selected="selected"' : ''; ?>>11 MIPA
                        </option>
                        <option value="M120" <?= $siswa['kd_kelas'] == 'M120' ? ' selected="selected"' : ''; ?>>12 MIPA
                        </option>
                        <option value="S100" <?= $siswa['kd_kelas'] == 'S100' ? ' selected="selected"' : ''; ?>>10
                            Sosial</option>
                        <option value="S110" <?= $siswa['kd_kelas'] == 'S110' ? ' selected="selected"' : ''; ?>>11
                            Sosial</option>
                        <option value="S120" <?= $siswa['kd_kelas'] == 'S120' ? ' selected="selected"' : ''; ?>>12
                            Sosial</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-success">Submit</button>
                    <a class="btn btn-danger" href="data-siswa.php"
                        style="color: #fff; text-decoration:none; ">Cancel</a>
                </div>
            </div>
        </form>
    </section>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>

</html>