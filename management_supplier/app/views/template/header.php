<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$namaAdmin = isset($_SESSION['admin']['email']) ? $_SESSION['admin']['email'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Supplier</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- SB Admin + Bootstrap -->
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="admin/css/plugins/dataTables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="admin/css/sb-admin.css">

</head>

<body>
<div id="wrapper">

    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">EL-FATH Fotocopy</a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?= htmlspecialchars($namaAdmin) ?>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-user">
                    <li><a href="?controller=login&action=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                </ul>
            </li>
        </ul>

        <div class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">

                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </li>

                    <li><a href="?controller=dashboard&action=index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>

                    <li>
                        <a href="#"><i class="fa fa-exchange fa-fw"></i> Penerimaan <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="?controller=pesanan_dikirim&action=index"><i class="fa fa-cart-shopping"></i> Pesanan Dikirim</a></li>
                            <li><a href="?controller=pesanan_diambil&action=index"><i class="fa fa-truck"></i> Pesanan Diambil</a></li>
                            <li><a href="?controller=return_to&action=index"><i class="fa fa-rotate-left"></i> Retur</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-database fa-fw"></i> Master Data <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="?controller=supplier&action=index"><i class="fa fa-user fa-fw"></i> Master Supplier</a></li>
                            <li><a href="?controller=barang&action=index"><i class="fa fa-cubes fa-fw"></i> Master Barang</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- MULAI KONTEN -->
    <div id="page-wrapper">
