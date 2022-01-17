<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambahSpp($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'data-spp.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'data-spp.php';
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
    <title>Tambah Data SPP</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header class="container">
        <h3>Tambah Data SPP</h3>
    </header>
    <section id="tambah-data-spp" class="container">

    <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="no_kuitansi" class="col-4 col-form-label">No Kuitansi</label> 
    <div class="col-8">
      <input id="no_kuitansi" name="no_kuitansi" placeholder="masukkan no kuitansi" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="nis" class="col-4 col-form-label">NIS</label> 
    <div class="col-8">
      <input id="nis" name="nis" placeholder="masukkan nis" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
            <label for="tgl_bayar" class="col-4 col-form-label">Tanggal</label> 
            <div class="col-8">
            <input type="date" id="tgl_bayar" name="tgl_bayar">
            </div>
        </div>
  <div class="form-group row">
    <label for="ket_bayar" class="col-4 col-form-label">Keterangan</label> 
    <div class="col-8">
      <input id="ket_bayar" name="ket_bayar" placeholder="masukkan keterangan" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="total" class="col-4 col-form-label">Total</label> 
    <div class="col-8">
      <input id="total" name="total" type="text" class="form-control" required="required">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-success">Submit</button>
      <button name="submit" type="submit" class="btn btn-danger"><a href="data-spp.php" style="color: #fff; text-decoration:none; ">Cancel</a></button>
    </div>
  </div>
</form>
    </section>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>
</html>