<!-- <?php

$connection = null;

try{
    //Config
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "libman";

    //Connect
    $connection = new mysqli($host, $username, $password, $dbname);

    // Cek koneksi
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // if($connection){
    //     echo "Koneksi Berhasil";
    // } else {
    //     echo "Gagal gan";
    // }

} catch (Exception $e){
    echo "Error ! " . $e->getMessage();
    die;
}

?> -->
