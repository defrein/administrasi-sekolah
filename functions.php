<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sekolah_database");


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambahSiswa($data) {
	global $conn;

	$nis = htmlspecialchars($data["nis"]);
	$nama = htmlspecialchars($data["nama"]);
	$jns_kelamin = htmlspecialchars($data["jns_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$kd_kelas = htmlspecialchars($data["kd_kelas"]);

	$query = "INSERT INTO siswa
				VALUES
			  ('$nis', '$nama', '$jns_kelamin', '$alamat', '$kd_kelas')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahGuru($data) {
	global $conn;

	$nip = htmlspecialchars($data["nip"]);
	$nama = htmlspecialchars($data["nama"]);
	$jns_kelamin = htmlspecialchars($data["jns_kelamin"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$no_telp = htmlspecialchars($data["no_telp"]);
	$bidang_studi = htmlspecialchars($data["bidang_studi"]);
	$kd_golongan = htmlspecialchars($data["kd_golongan"]);

	$query = "INSERT INTO guru
				VALUES
			  ('$nip', '$nama', '$jns_kelamin',  '$tgl_lahir','$alamat', '$no_telp', '$bidang_studi', '$kd_golongan')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahSpp($data) {
	global $conn;

	$no_kuitansi = htmlspecialchars($data["no_kuitansi"]);
	$tgl_bayar = htmlspecialchars($data["tgl_bayar"]);
	$ket_bayar = htmlspecialchars($data["ket_bayar"]);
	$total = htmlspecialchars($data["total"]);
	$nis = htmlspecialchars($data["nis"]);

	$query = "INSERT INTO spp
				VALUES
			  ('$no_kuitansi', '$tgl_bayar', '$ket_bayar', '$total', '$nis')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahJadwal($data) {
	global $conn;

	$kd_jadwal = htmlspecialchars($data["kd_jadwal"]);
	$hari = htmlspecialchars($data["hari"]);
	$waktu = htmlspecialchars($data["waktu"]);
	$jmlh_jam = htmlspecialchars($data["jmlh_jam"]);
	$kd_kelas = htmlspecialchars($data["kd_kelas"]);
	$nip = htmlspecialchars($data["nip"]);
	$kd_mapel = htmlspecialchars($data["kd_mapel"]);

	$query = "INSERT INTO jadwal_pelajaran
				VALUES
			  ('$kd_jadwal', '$hari', '$waktu',  '$jmlh_jam','$kd_kelas', '$nip', '$kd_mapel')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$user_type = htmlspecialchars($data["user_type"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database

	$query = "INSERT INTO users
				VALUES
			  ('', '$username', '$password',  '$user_type')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function hapusSiswa($nis) {
	global $conn;
	mysqli_query($conn, "DELETE FROM siswa WHERE nis = $nis");
	return mysqli_affected_rows($conn);
}
function hapusGuru($nip) {
	global $conn;
	mysqli_query($conn, "DELETE FROM guru WHERE nip = $nip");
	return mysqli_affected_rows($conn);
}
function hapusSpp($no_kuitansi) {
	global $conn;
	mysqli_query($conn, "DELETE FROM spp WHERE no_kuitansi = $no_kuitansi");
	return mysqli_affected_rows($conn);
}
function hapusJadwal($kd_jadwal) {
	global $conn;
	mysqli_query($conn, "DELETE FROM jadwal_pelajaran WHERE kd_jadwal = $kd_jadwal");
	return mysqli_affected_rows($conn);
}
function hapusAdmin($id) {
	global $conn;
	
	$result=mysqli_query($conn, "SELECT count(*) as total from users");
	$result2=mysqli_query($conn, "SELECT * from users where id = $id");
	$result3=mysqli_query($conn, " SELECT count(*) as totalsuperadmin from users where user_type = 'Super Admin'");
	$data=mysqli_fetch_assoc($result);
	$data2=mysqli_fetch_assoc($result2);
	$data3=mysqli_fetch_assoc($result3);
	if($data['total']>1){
		if($data2['user_type'] == 'Super Admin'){
			if ($data3['totalsuperadmin']>1){
				mysqli_query($conn, "DELETE FROM users WHERE id = $id");
				return mysqli_affected_rows($conn);
			}
		} else {
			mysqli_query($conn, "DELETE FROM users WHERE id = $id");
			return mysqli_affected_rows($conn);
		}
	}
}

function ubahSiswa($data) {
	global $conn;

	$nis = htmlspecialchars($data["nis"]);
	$nama = htmlspecialchars($data["nama"]);
	$jns_kelamin = htmlspecialchars($data["jns_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$kd_kelas = htmlspecialchars($data["kd_kelas"]);

	

	$query = "UPDATE siswa SET
				nis = '$nis',
				nama = '$nama',
				jns_kelamin = '$jns_kelamin',
				alamat = '$alamat',
				kd_kelas = '$kd_kelas'
			  WHERE nis = $nis
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

function ubahGuru($data) {
	global $conn;

	$nip = htmlspecialchars($data["nip"]);
	$nama = htmlspecialchars($data["nama"]);
	$jns_kelamin = htmlspecialchars($data["jns_kelamin"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$no_telp = htmlspecialchars($data["no_telp"]);
	$bidang_studi = htmlspecialchars($data["bidang_studi"]);
	$kd_golongan = htmlspecialchars($data["kd_golongan"]);
	
	$query = "UPDATE guru SET
				nip = '$nip',
				nama = '$nama',
				jns_kelamin = '$jns_kelamin',
				tgl_lahir = '$tgl_lahir',
				alamat = '$alamat',
				no_telp = '$no_telp',
				bidang_studi = '$bidang_studi',
				kd_golongan = '$kd_golongan'
			  WHERE nip = $nip
			";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);

}
function ubahSpp($data) {
	global $conn;

	$no_kuitansi = htmlspecialchars($data["no_kuitansi"]);
	$tgl_bayar = htmlspecialchars($data["tgl_bayar"]);
	$ket_bayar = htmlspecialchars($data["ket_bayar"]);
	$total = htmlspecialchars($data["total"]);
	$nis = htmlspecialchars($data["nis"]);
	
	$query = "UPDATE spp SET
				no_kuitansi = '$no_kuitansi',
				tgl_bayar = '$tgl_bayar',
				ket_bayar = '$ket_bayar',
				total = '$total',
				nis = '$nis'
			  WHERE no_kuitansi = $no_kuitansi
			";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);

}
function ubahJadwal($data) {
	global $conn;

	$kd_jadwal = htmlspecialchars($data["kd_jadwal"]);
	$hari = htmlspecialchars($data["hari"]);
	$waktu = htmlspecialchars($data["waktu"]);
	$jmlh_jam = htmlspecialchars($data["jmlh_jam"]);
	$kd_kelas = htmlspecialchars($data["kd_kelas"]);
	$nip = htmlspecialchars($data["nip"]);
	$kd_mapel = htmlspecialchars($data["kd_mapel"]);
	
	$query = "UPDATE jadwal_pelajaran SET
				kd_jadwal = '$kd_jadwal',
				hari = '$hari',
				waktu = '$waktu',
				jmlh_jam = '$jmlh_jam',
				kd_kelas = '$kd_kelas',
				nip = '$nip',
				kd_mapel = '$kd_mapel'
			  WHERE kd_jadwal = $kd_jadwal
			";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);

}

function ubahAdmin($data) {
	global $conn;

	$id = $data["id"];
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$user_type = htmlspecialchars($data["user_type"]);

	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$query = "UPDATE users SET
				username = '$username',
				password = '$password',
				user_type = '$user_type'
			  WHERE id = $id;
			";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);

}

?>