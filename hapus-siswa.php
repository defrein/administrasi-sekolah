<?php 
require 'functions.php';

$nis = $_GET["nis"];

if( hapusSiswa($nis) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'data-siswa.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'data-siswa.php';
		</script>
	";
}
?>