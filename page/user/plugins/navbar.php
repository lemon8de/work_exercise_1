<?php 
//SESSION
include '../../process/login.php';
//some code for testing the session and ensuring that the user is logged in
if ($_SESSION['role'] <> 'USER') {
    header('location: ../../index.php');
}
?> 

<!DOCTYPE html>
<html lang="en">
    <!-- the head of the html starts and finishes here at the navbar.php, remember that -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exercise1 | User</title>
        <link rel="icon" href="../../dist/img/logo.png" type="image/x-icon" />

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="../../dist/css/font.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Sweet Alert -->
        <link rel="stylesheet" href="../../plugins/sweetalert2/dist/sweetalert2.min.css">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

        <!-- removed preloader here  -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
                </li>
            </ul>
        </nav>