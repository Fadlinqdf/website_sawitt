<?php
include('config/koneksi.php');
header('Content-Type: application/json');

// Ambil data jumlah pendaftar per tanggal
$query = "SELECT DATE(tanggal_daftar) AS tanggal, COUNT(*) AS total 
          FROM pendaftaran_magang 
          GROUP BY DATE(tanggal_daftar) 
          ORDER BY DATE(tanggal_daftar) ASC";

$result = $koneksi->query($query);

$dates = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = $row['tanggal'];
    $totals[] = $row['total'];
}

echo json_encode(['dates' => $dates, 'totals' => $totals]);
exit;
