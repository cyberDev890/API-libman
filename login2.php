<?php
include 'connection.php';

if($_POST){
$NIS = $_POST['NIS'] ?? '';
$password = $_POST['password'] ?? '';
$response = []; //Data Response

$userQuery = $connection->prepare("SELECT * FROM data_siswa where NIS = ?");
$userQuery->execute(array($NIS));
$query = $userQuery->fetch();

if($userQuery->rowCount() == 0){
	$response['status'] = false;
	$response['message'] = "NIS Tidak Terdaftar";
} else {
	// Ambil password di db

	$passwordDB = $query['password'];

	if(strcmp(md5($password),$passwordDB) === 0){
		$response['status'] = true;
		$response['message'] = "Login Berhasil";
		$response['data'] = [
			'NIS' => $query['NIS'],
			'nama_siswa' => $query['nama_siswa'],
			'tingkatan' => $query['tingkatan'],
			'kelas' => $query['kelas'],
			'jenis_kelamin' => $query['jenis_kelamin'],
			'notelp' => $query['notelp'],
			'gambar' => $query['gambar']
		];
	} else {
		$response['status'] = false;
		$response['message'] = "Password anda salah";
	}
}

//Jadikan data JSON
$json = json_encode($response, JSON_PRETTY_PRINT);

//Print
echo $json;

}









// $queryResult = "SELECT * FROM data_siswa WHERE NIS='" . $nis . "' AND password='" . $password . "'";

// $result = mysqli_query($connect, $queryResult);
// $count = mysqli_num_rows($result);

// $response = array();

// if ($count == 1) {
// 	$fetchData = $result->fetch_assoc();

// 	$response['status'] = true;
// 	$response['message'] = "Login Berhasil";
// 	$response['data'] = array(
// 		"NIS" => $fetchData['NIS'],
// 		"nama_siswa" => $fetchData['nama_siswa'],
// 		"tingkatan" => $fetchData['tingkatan'],
// 		"kelas" => $fetchData['kelas'],
// 		"jenis_kelamin" => $fetchData['jenis_kelamin'],
// 		"notelp" => $fetchData['notelp'],
// 		"gambar" => $fetchData['gambar']
// 	);
// } else {
// 	$response['status'] = false;
// 	$response['message'] = "Login Gagal";
// }

// echo json_encode($response);
