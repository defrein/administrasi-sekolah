<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$users = query("SELECT * FROM users WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if( ubahAdmin($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'data-admin.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
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
    <title>Ubah Data Admin</title>
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header class="container">
        <h3>Ubah Data Admin</h3>
    </header>
    <section id="edit-data-admin" class="container">

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $users["id"]; ?>">
        <div class="form-group row">
            <label for="username" class="col-4 col-form-label">Username</label> 
            <div class="col-8">
            <input id="username" name="username" placeholder="masukkan username" type="text" class="form-control" required="required" value="<?= $users["username"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-4 col-form-label">Password</label> 
            <div class="col-8">
            <input id="password" name="password" placeholder="masukkan password baru" type="password" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="password2" class="col-4 col-form-label">Konfirmasi Password</label> 
            <div class="col-8">
            <input id="password2" name="password2" placeholder="masukkan konfirmasi password" type="password" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="user_type" class="col-4 col-form-label">Tipe User</label> 
            <div class="col-8">
            <select id="user_type" name="user_type" class="custom-select">
                <option value="Admin" <?=$users['user_type'] == 'Admin' ? ' selected="selected"' : '';?>>Admin</option>
                <option value="Super Admin" <?=$users['user_type'] == 'Super Admin' ? ' selected="selected"' : '';?>>Super Admin</option>
            </select>
            </div>
        </div> 
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-success">Submit</button>
            <button name="submit" type="submit" class="btn btn-danger"><a href="data-admin.php" style="color: #fff; text-decoration:none; ">Cancel</a></button>            </div>
        </div>
    </form>
    </section>
    <script src="https://kit.fontawesome.com/7009cf2d19.js " crossorigin="anonymous "></script>
</body>
</html>