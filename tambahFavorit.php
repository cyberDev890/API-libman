<?php

include 'connect.php';
$NIS = $_POST['NIS'];
$nama_siswa = $_POST['nama_siswa'];
$nama_buku = $_POST['nama_buku'];
$kd_buku = $_POST['kd_buku'];

$checkFavorit = "SELECT * FROM buku_favorit WHERE NIS='$NIS' AND kd_buku='$kd_buku' ";
$sendFavorit = mysqli_query($connect, $checkFavorit);
$countFavorit = mysqli_num_rows($sendFavorit);
// Insert the data into the database
if ($countFavorit == 1) {
    echo json_encode("Sudah ditambahkan");
} else {
    $query = "INSERT INTO buku_favorit (`NIS`, `nama_siswa`, `nama_buku`, `kd_buku`)  VALUES ('$NIS', '$nama_siswa', '$nama_buku', '$kd_buku')";
    $send = mysqli_query($connect, $query);
    if ($send) {
        # code...
        echo json_encode("Success");
    } else {
        # code...
        echo json_encode("Eror");

    }
}
