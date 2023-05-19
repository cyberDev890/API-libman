<?php
include 'connect.php';

if ($_POST) {
    $NIS = $_POST['NIS'] ?? '';
    $password = $_POST['password'] ?? '';
    $response = []; //Data Response

    $userQuery = $connect->prepare("SELECT * FROM data_siswa WHERE NIS = ?");
    $userQuery->bind_param("s", $NIS); // Mengikat parameter NIS
    $userQuery->execute();
    $query = $userQuery->get_result()->fetch_assoc();

    if (!$query) {
        $response['status'] = false;
        $response['message'] = "NIS Tidak Terdaftar";
    } else {
        $passwordDB = $query['password'];

        if (strcmp(md5($password), $passwordDB) === 0) {
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
            $response['message'] = "Password Anda Salah";
        }
    }

    // Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    // Print JSON
    echo $json;
}
?>