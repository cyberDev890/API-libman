<?php
include 'connect.php';

// Memeriksa apakah request yang dikirim adalah GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Menjalankan query
    $result = mysqli_query($connect, "SELECT * FROM data_buku");

    // Membuat array untuk menampung hasil query
    $response = array();

    // Menampilkan hasil query
    if (mysqli_num_rows($result) > 0) {
        // Output data satu per satu
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($response, array(
                "kd_buku" => $row["kd_buku"],
                "nama_buku" => $row["nama_buku"],
                "jenis_buku" => $row["jenis_buku"],
                "semester" => $row["semester"],
                "tingkatan" => $row["tingkatan"],
                "jumlah" => $row["jumlah"],
                "gambar" => $row["gambar"]
            ));
        }
    } else {
        $response['message'] = "Tidak ada data";
    }

    // Menampilkan respon dalam format JSON
    echo json_encode($response);
}
