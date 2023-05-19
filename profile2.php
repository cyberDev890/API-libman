<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data yang dikirim melalui POST
    $NIS = $_POST['NIS'];
    $tingkatan = $_POST['tingkatan'];
    $kelas = $_POST['kelas'];
    $notelp = $_POST['notelp'];

    // Melakukan query untuk mendapatkan data gambar sebelumnya
    $query = "SELECT gambar FROM data_siswa WHERE NIS = ?";
    $statement = $connect->prepare($query);
    $statement->bind_param("s", $NIS);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $oldImage = $row['gambar'];

    // Mengecek apakah ada file gambar yang diunggah
    if (isset($_FILES['gambar'])) {
        $file = $_FILES['gambar'];

        // Memisahkan nama file dan ekstensi
        $fileName = $file['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Membuat nama file unik dengan menggunakan timestamp
        $newFileName = uniqid() . '.' . $fileExtension;

        // Menentukan lokasi penyimpanan file
        $uploadPath = 'uploads/' . $newFileName;

        // Memindahkan file ke folder uploads
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            // Menghapus gambar sebelumnya jika ada
            if (!empty($oldImage)) {
                $oldImagePath = 'uploads/' . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Melakukan query untuk mengupdate data siswa
            $query = "UPDATE data_siswa SET tingkatan = ?, kelas = ?, notelp = ?, gambar = ? WHERE NIS = ?";
            $statement = $connect->prepare($query);
            $statement->bind_param("sssss", $tingkatan, $kelas, $notelp, $newFileName, $NIS);
            $result = $statement->execute();
            if ($result) {
                // Mengirim respon berhasil
                $response['status'] = true;
                $response['message'] = 'Data siswa berhasil diperbarui.';
            } else {
                // Mengirim respon gagal
                $response['status'] = false;
                $response['message'] = 'Gagal memperbarui data siswa.';
            }
        } else {
            // Mengirim respon gagal jika gagal memindahkan file
            $response['status'] = false;
            $response['message'] = 'Gagal mengunggah gambar.';
        }
    } else {
        // Melakukan query untuk mengupdate data siswa tanpa mengubah gambar
        $query = "UPDATE data_siswa SET tingkatan = ?, kelas = ?, notelp = ? WHERE NIS = ?";
        $statement = $connect->prepare($query);
        $statement->bind_param("ssss", $tingkatan, $kelas, $notelp, $NIS);
        $result = $statement->execute();
    
        if ($result) {
            // Mengirim respon berhasil
            $response['status'] = true;
            $response['message'] = 'Data siswa berhasil diperbarui.';
        } else {
            // Mengirim respon gagal
            $response['status'] = false;
            $response['message'] = 'Gagal memperbarui data siswa.';
        }
    }
    } else {
    // Mengirim respon jika metode HTTP yang digunakan bukan POST
    $response['status'] = false;
    $response['message'] = 'Metode request tidak valid.';
    }
    
    // Mengirim respon dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    ?>
