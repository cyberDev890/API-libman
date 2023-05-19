<?php

include 'connect.php';

if ($_POST) {

    // POST DATA
    $NIS = filter_input(INPUT_POST, 'NIS', FILTER_SANITIZE_STRING);
    $nama_siswa = filter_input(INPUT_POST, 'nama_siswa', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $tingkatan = filter_input(INPUT_POST, 'tingkatan', FILTER_SANITIZE_STRING);
    $kelas = filter_input(INPUT_POST, 'kelas', FILTER_SANITIZE_STRING);
    $jenis_kelamin = filter_input(INPUT_POST, 'jenis_kelamin', FILTER_SANITIZE_STRING);
    $notelp = filter_input(INPUT_POST, 'notelp', FILTER_SANITIZE_STRING);
    $gambar = filter_input(INPUT_POST, 'gambar', FILTER_SANITIZE_STRING);


    $response = [];

    // Cek username dalam database
    $userQuery = $connect->prepare("SELECT * FROM data_siswa WHERE NIS = ?");
    $userQuery->bind_param("s", $NIS);
    $userQuery->execute();
    $userResult = $userQuery->get_result();

    // Cek apakah username sudah ada atau tidak
    if ($userResult->num_rows != 0) {
        // Beri Response
        $response['status'] = false;
        $response['message'] = 'Akun sudah digunakan';
    } else {
        $insertAccount = 'INSERT INTO data_siswa (NIS, nama_siswa, password, tingkatan, kelas, jenis_kelamin, notelp, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $statement = $connect->prepare($insertAccount);

        try {
            // Eksekusi statement db
            $statement->bind_param("ssssssss", $NIS, $nama_siswa, md5($password), $tingkatan, $kelas, $jenis_kelamin, $notelp, $gambar);
            $statement->execute();

            // Beri response
            $response['status'] = true;
            $response['message'] = 'Akun berhasil didaftar';
            $response['data'] = [
                'NIS' => $NIS,
                'nama_siswa' => $nama_siswa,
                'password' => $password,
                'tingkatan' => $tingkatan,
                'kelas' => $kelas,
                'jenis_kelamin' => $jenis_kelamin,
                'notelp' => $notelp,
                'gambar' => $gambar
            ];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    // Print JSON
    echo $json;
}
