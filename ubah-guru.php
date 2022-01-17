<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// ambil data di URL
$nip = $_GET["nip"];

// query data mahasiswa berdasarkan id
$guru = query("SELECT * FROM guru WHERE nip = $nip")[0];


// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if( ubahGuru($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'data-guru.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
                document.location.href = 'data-guru.php';
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
    <title>Ubah Data Guru</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header class="container">
        <h3>Ubah Data Guru</h3>
    </header>
    <section id="ubah-data-guru" class="container">

    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="nip" class="col-4 col-form-label">NIP</label> 
        <div class="col-8">
        <input id="nip" name="nip" placeholder="masukkan nip" type="text" class="form-control" required="required" value="<?= $guru["nip"]; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-4 col-form-label">Nama</label> 
        <div class="col-8">
        <input id="nama" name="nama" placeholder="masukkan nama" type="text" class="form-control" required="required" value="<?= $guru["nama"]; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-4">Jenis Kelamin</label> 
        <div class="col-8">
        <div class="custom-control custom-radio custom-control-inline">
            <input name="jns_kelamin" id="jns_kelamin_0" type="radio" class="custom-control-input" value="Laki-laki" required="required" <?php echo ($guru['jns_kelamin']=='Laki-laki')?'checked':'' ?>> 
            <label for="jns_kelamin_0" class="custom-control-label">Laki-laki</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input name="jns_kelamin" id="jns_kelamin_1" type="radio" class="custom-control-input" value="Perempuan" required="required" <?php echo ($guru['jns_kelamin']=='Perempuan')?'checked':'' ?>> 
            <label for="jns_kelamin_1" class="custom-control-label">Perempuan</label>
        </div>
        </div>
    </div>
    <div class="form-group row">
            <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label> 
            <div class="col-8">
            <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $guru["tgl_lahir"]; ?>">
            </div>
        </div>
    <div class="form-group row">
        <label for="alamat" class="col-4 col-form-label">Alamat</label> 
        <div class="col-8">
        <textarea id="alamat" name="alamat" cols="40" rows="3" class="form-control"><?php echo $guru["alamat"]; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="no_telp" class="col-4 col-form-label">No Telp</label> 
        <div class="col-8">
        <input id="no_telp" name="no_telp" placeholder="masukkan nomor telpon" type="text" class="form-control" required="required" value="<?= $guru["no_telp"]; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="bidang_studi" class="col-4 col-form-label">Bidang Studi</label> 
        <div class="col-8">
        <input id="bidang_studi" name="bidang_studi" placeholder="masukkan bidang studi" type="text" class="form-control" required="required" value="<?= $guru["bidang_studi"]; ?>">
        </div>
    </div>
    <div class="form-group row">
    <label for="kd_golongan" class="col-4 col-form-label">Kode Golongan</label> 
    <div class="col-8">
      <select id="kd_golongan" name="kd_golongan" class="custom-select">
        <option value="1111" <?=$guru['kd_golongan'] == '1111' ? ' selected="selected"' : '';?>>1111</option>
        <option value="2222" <?=$guru['kd_golongan'] == '2222' ? ' selected="selected"' : '';?>>2222</option>
        <option value="3333" <?=$guru['kd_golongan'] == '3333' ? ' selected="selected"' : '';?>>3333</option>
        <option value="4444" <?=$guru['kd_golongan'] == '4444' ? ' selected="selected"' : '';?>>4444</option>
      </select>
    </div>
  </div> 
    <div class="form-group row">
        <div class="offset-4 col-8">
        <button name="submit" type="submit" class="btn btn-success">Submit</button>
        <button name="submit" type="submit" class="btn btn-danger"><a href="data-guru.php" style="color: #fff; text-decoration:none; ">Cancel</a></button>
        </div>
    </div>
    </form>
    </section>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>
</html>