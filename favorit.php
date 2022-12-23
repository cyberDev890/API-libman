<?php

include 'connect.php';
$response = array();
$NIS = $_POST['NIS'];
$nama_siswa = $_POST['nama_siswa'];
$nama_buku = $_POST['nama_buku'];
$kd_buku = $_POST['kd_buku'];

$checkFavorit = "SELECT * FROM buku_favorit WHERE NIS='$NIS'";
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
        $response['value'] = "1";
        $response['message'] = "Success";
        echo json_encode($response);
    } else {
        # code...
        $response['value'] = "0";
        $response['message'] = "Failed";
        echo json_encode($response);
    }
}
