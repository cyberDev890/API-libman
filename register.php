<?php
include 'connect.php';
$nis = $_POST['NIS'];
$nama = $_POST['nama_siswa'];
$Password = md5($_POST['password']);
$tingkatan = $_POST['tingkatan'];
$kelas = $_POST['kelas'];
$JK = $_POST['jenis_kelamin'];
$noTelp = $_POST['notelp'];
$gambar = $_POST['gambar'];

$checkNIS = "SELECT * FROM data_siswa WHERE NIS='$nis'";
$sendNIS = mysqli_query($connect, $checkNIS);
$countNIS = mysqli_num_rows($sendNIS);

if ($countNIS == 1) {
    echo json_encode("NIS sudah terdaftar");
} else {
    $insert = "INSERT INTO data_siswa (NIS, nama_siswa, password, tingkatan, kelas, jenis_kelamin, notelp, gambar) 
VALUES ('$nis', '$nama', '$Password', '$tingkatan', '$kelas','$JK', '$noTelp',NULL)";
    $query = mysqli_query($connect, $insert);
    if ($query) {
        echo json_encode("Success");
    } else {
        echo json_encode("Eror");
    }
}
?>