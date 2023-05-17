<?php
include 'connect.php';

$nis = $_POST['NIS'];
$password = md5($_POST['password']);
$queryResult = "SELECT * FROM data_siswa WHERE NIS='" . $nis . "' AND password='" . $password . "'";

$result = mysqli_query($connect, $queryResult);
$count = mysqli_num_rows($result);

$response = array();

if ($count == 1) {
	$fetchData = $result->fetch_assoc();

	$response['status'] = true;
	$response['message'] = "Login Berhasil";
	$response['data'] = array(
		"NIS" => $fetchData['NIS'],
		"nama_siswa" => $fetchData['nama_siswa'],
		"password" => $fetchData['password'],
		"tingkatan" => $fetchData['tingkatan'],
		"kelas" => $fetchData['kelas'],
		"jenis_kelamin" => $fetchData['jenis_kelamin'],
		"notelp" => $fetchData['notelp'],
		"gambar" => $fetchData['gambar']
	);
} else {
	$response['status'] = false;
	$response['message'] = "Login Gagal";
}

echo json_encode($response);
