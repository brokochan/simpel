<?php 

$koneksi = new mysqli('dpmpt.garutkab.go.id', 'dpmptgar_peron', 'Dodolgarut123_', 'dpmptgarutkabgo_dtinvestasi');
if ($koneksi->connect_errno) { // JIKA KONEKSI BERMASALAH
    die('kesalahan saat membuat koneksi ke database. <br>' . $koneksi->error);
}
?>
