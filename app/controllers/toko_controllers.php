<?php
include '../model/toko.php';

$tokoModel = new Toko();
$toko = $tokoModel->getData();

include '../view/toko_view.php';
?>
