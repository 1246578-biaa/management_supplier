<?php
function koneksiDatabase() {
    $koneksi = mysqli_connect("localhost", "root", "", "management_supplier3");

    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    return $koneksi;
}
?>

