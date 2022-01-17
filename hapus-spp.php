<?php 
require 'functions.php';

$no_kuitansi = $_GET["no_kuitansi"];

if( hapusSpp($no_kuitansi) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'data-spp.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'data-spp.php';
		</script>
	";
}
?>