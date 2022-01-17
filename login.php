<?php
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

require 'functions.php';

if(isset($_POST["login"])){
    $username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;
            $_SESSION["user_type"] = $row["user_type"];
            $_SESSION["username"] = $row["username"];

			header("Location: index.php");
			exit;
		} else { ?>
            <div class="alert alert-danger" role="alert" style="text-align: center;">
            Kombinasi username dan password salah
            </div>
        <?php }
	} else { ?>
        <div class="alert alert-danger" role="alert" style="text-align: center;">
        Kombinasi username dan password salah
        </div>
    <?php }

	$error = true;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <section style="display: flex !important;
    justify-content: center !important;
    align-items: center !important;">
        <div class="box">
            <div class="boxContainer">
                <div class="form">
                    <h1 style="position: relative; color: #fff;font-size: 30px;font-weight: 600;letter-spacing: 1px;margin-bottom: 10px;text-align: center;">Administrasi Sekolah</h1>
                    <img src="assets/img/school.png" alt="" style="display: block; margin: 0 auto 10px auto; width: 150px">
                    <h2>Admin Login</h2>
                    <form action="" method="post">
                        <div class="inputBox">
                            <input type="text" placeholder="Username" id="username" name="username">
                        </div>
                        <div class="inputBox">
                            <input type="password" placeholder="Password" id="password" name="password">
                        </div>
                        <!-- <div class="form-check">
                            <input type="checkbox">
                            <label>Remember Me</label>
                        </div> -->
                        <div class="inputBox">
                            <input type="submit" value="Login" name="login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>