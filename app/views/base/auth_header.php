<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once "./app/views/base/analytics.php"
    ?>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link TO CSS -->
    <?php
    require_once './app/views/base/css.php';
    ?>
    <!-- Font Link -->
    <?php
    require_once "./app/views/base/font.php"
    ?>
    <!-- Box Icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

</head>

<body>
<header class="shadow header-center">
    <a href="index.php?url=home" class="logo">
        <img src="<?php echo BASEPATH ?>/public/img/logo.png" alt="">
    </a>
</header>