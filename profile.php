<?php

use function PHPUnit\Framework\returnSelf;

include 'connect.php';

// Check if the required POST data is set
if (isset($_POST['NIS'])) {
    $NIS = $_POST['NIS'];
} else {
    return;
}
if (isset($_POST['nama_siswa'])) {
    $nama = $_POST['nama_siswa'];
} else {
    return;
}
if (isset($_POST['notelp'])) {
    $notelp = $_POST['notelp'];
} else {
    return;
}
if (isset($_POST['data'])) {
    $data = $_POST['data'];
} else {
    return;
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    return;
}

$path = "uploads/$name";

// Retrieve the old image path from the database
$query = "SELECT gambar FROM `data_siswa` WHERE `data_siswa`.`NIS` = '$NIS'";
$exe = mysqli_query($connect, $query);

if ($exe) {
    $row = mysqli_fetch_array($exe);
    $old_path = $row['gambar'];

    // Remove the old image file if it exists
    if (file_exists($old_path)) {
        unlink($old_path);
    }
}

// Update the student data in the database
$query = "UPDATE `data_siswa` SET `nama_siswa` = '$nama', `notelp` = '$notelp', `gambar` = '$path' WHERE `data_siswa`.`NIS` = '$NIS'";
file_put_contents($path, base64_decode($data));

$arr = [];
$exe = mysqli_query($connect, $query);

if ($exe) {
    $arr['success'] = true;
    $arr['message'] = "Data updated successfully";
    $arr['data'] = [
        'NIS' => $NIS,
        'nama_siswa' => $nama,
        'notelp' => $notelp,
        'gambar' => $path
    ];
} else {
    $arr['success'] = false;
    $arr['message'] = "Failed to update data";
}

echo json_encode($arr);
?>
