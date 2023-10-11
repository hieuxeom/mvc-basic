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
    <title>Responsive Coffee Website</title>
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
<header class="shadow">
    <a href="index.php?url=home" class="logo">
        <img src="<?php echo BASEPATH ?>/public/img/logo.png" alt="">
    </a>
    <!-- Menu-Icon -->
    <i class='bx bx-menu' id="menu-icon"></i>
    <!-- Links -->
    <ul class="navbar">
        <li><a href="index.php?url=home">Trang chủ</a></li>
        <li><a href="index.php?url=home">Giới thiệu</a></li>
        <li><a href="index.php?url=home">Sản phẩm</a></li>
        <li><a href="index.php?url=blog">Tin tức</a></li>
    </ul>
    <!-- Icon -->
    <div class="header-icon">
        <a href="index.php?url=cart"><i class='bx bx-cart-alt'></i></a>
        <a href="#"><i class='bx bx-search' id="search-icon"></i></a>
        <!-- <a href='index.php?url=home'><i class='bx bxs-user'></i></a> -->
        <?php
        if (isset($_SESSION['permission'])) {
            if ($_SESSION['permission'] == 'admin') {
                echo "<a href='index.php?url=admin'><i class='bx bxs-user'></i></a>";
            } else {
                echo "<a href='index.php?url=profile'><i class='bx bxs-user'></i></a>";
            }
        }

        if ($_SESSION['is_login'] == false) {
            echo "<a href='index.php?url=auth'><i class='bx bx-log-in' ><span>Đăng nhập</span></i></a>";
        } else {
            echo "<a href='index.php?url=auth/logout'><i class='bx bx-log-out' ><span>Đăng xuất</span></i></a>";
        }
        ?>
    </div>
    <!-- Search Box -->
    <form class="search-box" action="index.php?url=search" method='post'>
        <input type="search" name="keyword" id="" placeholder="Search Here...">
    </form>

</header>