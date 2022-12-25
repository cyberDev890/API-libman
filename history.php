
<?php
include 'connect.php';
$nis = $_POST['NIS'];

$query = "SELECT riwayat.nama_buku, data_buku.gambar,data_buku.semester, riwayat.tanggal_pengembalian FROM `riwayat` JOIN data_buku ON riwayat.kd_buku = data_buku.kd_buku WHERE riwayat.NIS = $nis";
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
?>