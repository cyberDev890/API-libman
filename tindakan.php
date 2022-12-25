<?php
include 'connect.php';
$nis = $_POST['NIS'];

$query = "SELECT data_buku.nama_buku,pengembalian.id_kembali,data_buku.semester, data_buku.gambar, pengembalian.tanggal_pengembalian FROM `pengembalian` JOIN data_buku ON pengembalian.kd_buku=data_buku.kd_buku WHERE pengembalian.NIS='$nis'";
// Menjalankan query dan menyimpan hasilnya dalam variabel
$result = mysqli_query($connect, $query);
// Inisialisasi array kosong untuk menampung hasil
$data = array();
// Menyimpan hasil query ke dalam array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
// Mengeluarkan data dalam format JSON
if (count($data) > 0) {
    echo json_encode($data);
} else{
    echo json_encode('Data Kosong');
}
