<?php
include 'connect.php';
$nis = $_POST['NIS'];
$password = md5($_POST['password']);
$queryResult = "SELECT * FROM data_siswa WHERE NIS='" . $nis . "' and password='" . $password . "'";

$result = mysqli_query($connect, $queryResult);
$count = mysqli_num_rows($result);
$test = array();
while ($fetchData = $result->fetch_assoc()) {
	$test[] = $fetchData;
}
if ($count == 1) {
	$response = [
		"status" => "Success",
		"message" => "Login Berhasil",
		"data" => $test,
	];
	echo json_encode($response);
} else {
	$responseeror = [
		"status" => "Error",
		"message" => "Login Gagal",
	];
	echo json_encode($responseeror);
}
