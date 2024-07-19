<?php 
//SESSION
include '../../process/login.php';
//some code for testing the session and ensuring that the user is logged in
if ($_SESSION['role'] <> 'ADMIN') {
    header('location: ../../index.php');
}
?> 

<!DOCTYPE html>
<html lang="en">
    <!-- the head of the html starts and finishes here at the navbar.php, remember that -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin</title>
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
    <body>
        <h1>this is part of the navbar php</h1>