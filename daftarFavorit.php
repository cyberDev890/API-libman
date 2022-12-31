
<?php
include 'connect.php';
$nis = $_POST['NIS'];

$query =  "SELECT buku_favorit.nama_buku,data_buku.semester,data_buku.gambar FROM `buku_favorit` JOIN data_buku ON buku_favorit.kd_buku= data_buku.kd_buku WHERE buku_favorit.NIS='$nis'";
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
} else {
    echo json_encode('Data Kosong');
}
