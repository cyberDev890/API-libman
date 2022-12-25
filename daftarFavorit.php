<?php
include 'connect.php';

// Memeriksa apakah request yang dikirim adalah GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Menjalankan query
    $result = mysqli_query($connect, "SELECT buku_favorit.nama_buku,data_buku.semester,data_buku.gambar FROM `buku_favorit` JOIN data_buku ON buku_favorit.kd_buku= data_buku.kd_buku");

    // Membuat array untuk menampung hasil query
    $response = array();

    // Menampilkan hasil query
    if (mysqli_num_rows($result) > 0) {
        // Output data satu per satu
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($response, array(
                "nama_buku" => $row["nama_buku"],
                "semester" => $row["semester"],
                "gambar" => $row["gambar"]
            ));
        }
    } else {
        $response['message'] = "Tidak ada data";
    }

    // Menampilkan respon dalam format JSON
    echo json_encode($response);
}
