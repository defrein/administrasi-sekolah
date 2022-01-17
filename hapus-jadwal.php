<?php 
require 'functions.php';

$kd_jadwal = $_GET["kd_jadwal"];

if( hapusJadwal($kd_jadwal) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'data-jadwal.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'data-jadwal.php';
		</script>
	";
}
?>