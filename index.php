<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPK BEASISWA</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
</head>

<body>

    <!-- Cek status login atau belum -->
    <?php
    if ($_SESSION['status'] != "y") {
        header("Location:login.php");
    }
    ?>

    <nav class="navbar navbar-dark bg-primary border navbar-expand-sm fixed-top">
        <a class="navbar-brand" href="index.php">SPK BEASISWA</a>
        <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home </a></li>
            <?php if ($_SESSION['level'] == "Pimpinan") {
            ?>
                <li class="nav-item active"><a class="nav-link" href="?page=perangkingan&thn="><i class="fas fa-chart-bar"></i> Perangkingan </a></li>
                <li class="nav-item active"><a class="nav-link" href="?page=report"><i class="fa fa-print"></i> Report </a></li>
            <?php } elseif ($_SESSION['level'] == "Super Admin") {
            ?>
                <li class="nav-item active"><a class="nav-link" href="?page=users"><i class="fas fa-user-tie"></i> Users </a></li>
                <li class="nav-item active"><a class="nav-link" href="?page=siswa"><i class="fas fa-user-graduate"></i> Siswa </a></li>
                <li class="nav-item active"><a class="nav-link" href="?page=pendaftaran"><i class="fas fa-address-book"></i> Pendaftaran </a></li>
                <li class="nav-item active"><a class="nav-link" href="?page=perangkingan&thn="><i class="fas fa-chart-bar"></i> Perangkingan </a></li>
                <li class="nav-item active"><a class="nav-link" href="?page=report"><i class="fa fa-print"></i> Report </a></li>
            <?php } else { ?>
                <li class="nav-item active"><a class="nav-link" href="?page=siswa"><i class="fas fa-user-graduate"></i> Siswa </a></li>
                <li class="nav-item active"><a class="nav-link" href="?page=pendaftaran"><i class="fas fa-address-book"></i> Pendaftaran </a></li>
            <?php } ?>

            <li class="nav-item active"><a class="nav-link" href="?page=logout"><i class="fas fa-sign-out-alt"></i> Logout </a></li>
        </ul>
    </nav>

    <div class="container" style="margin-top:100px;margin-bottom:100px">
        <?php

        // pengaturan menu
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page == "") {
            include "welcome.php";
        } elseif ($page == "siswa") {
            if ($action == "") {
                include "tampil_siswa.php";
            } elseif ($action == "tambah") {
                include "tambah_siswa.php";
            } elseif ($action == "update") {
                include "update_siswa.php";
            } else {
                include "hapus_siswa.php";
            }
        } elseif ($page == "pendaftaran") {
            if ($action == "") {
                include "tampil_pendaftaran.php";
            } elseif ($action == "tambah") {
                include "tambah_pendaftaran.php";
            } elseif ($action == "update") {
                include "update_pendaftaran.php";
            } else {
                include "hapus_pendaftaran.php";
            }
        } elseif ($page == "perangkingan") {
            if ($action == "") {
                include "perangkingan.php";
            }
        } elseif ($page == "users") {
            if ($action == "") {
                include "tampil_users.php";
            } elseif ($action == "tambah") {
                include "tambah_users.php";
            } elseif ($action == "update") {
                include "update_users.php";
            } else {
                include "hapus_users.php";
            }
        } elseif ($page == "report") {
            if ($action == "") {
                include "report.php";
            }
        } else {
            if ($action == "") {
                include "logout.php";
            }
        }
        ?>
    </div>

    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').dataTable();
        });
    </script>

    <script src="assets/js/chosen.jquery.min.js"></script>
    <script>
        $(function() {
            $('.chosen').chosen();
        });
    </script>

</body>

</html>