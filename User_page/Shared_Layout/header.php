<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="../../Content/images/favicon.ico" rel="shortcut icon" type="image/x-icon">

    <!-- jQuery -->
    <script src="../../Scripts/js/jquery-2.0.0.min.js" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="../../Scripts/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="../../Content/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font awesome 5 -->

    <link href="../../Content/fonts/fontawesome/css/all.min.css" rel="stylesheet" />
    <!-- custom style -->
    <link href="../../Content/css/ui.css" rel="stylesheet" type="text/css" />
    <link href="../../Content/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="../../Content/css/toast.css" rel="stylesheet" type="text/css" />

    <!-- custom javascript -->
    <script>
        function showSuccessToast(notification) {
            $("#notification").text(notification);
            $("#toast_updateCart").removeClass("active");
            $(".progress").removeClass("active");

            setTimeout(function () {
                $("#toast_updateCart").addClass("active");
                $(".progress").addClass("active");
            }, 100); // Delay 100ms trước khi thêm class "active" để restart animation

            timer1 = setTimeout(function () {
                $("#toast_updateCart").removeClass("active");
            }, 5000);

            timer2 = setTimeout(function () {
                $(".progress").removeClass("active");
            }, 5300);
        }</script>
</head>

<body>
    <?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include("../../db_connect.php");
    
    function formatCurrencyVND($number)
    {
        $formattedNumber = number_format($number, 0, ',', '.') . ' VND';
        return $formattedNumber;
    }
    ?>
    <header class="section-header">
        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-3 col-md-12">
                        <a href="<?php echo '../Home/Index.php'; ?>" class="brand-wrap">
                            <img src="../../Images/logo22.png" style="width:90%" height="60%">
                        </a> <!-- brand-wrap.// -->
                    </div>
                    <div class="col-xl-6 col-lg-5 col-md-6">
                        <form action="../LOAISANPHAM/DanhSachSanPham.php" method="get" class="search-header">
                            <div class="input-group w-100">
                                <input type="text" class="form-control"
                                    placeholder="Tìm kiếm theo tên sản phẩm hoặc mã sản phẩm" name="id">

                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- search-wrap .end// -->
                    </div> <!-- col.// -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="widgets-wrap float-md-right">
                            <div class="widget-header mr-3">
                                <a href="../GIOHANG/GioHang.php" class="widget-view">
                                    <div class="icon-area">
                                        <i class="fa fa-shopping-cart"></i>
                                        <?php
                                        if (isset($_SESSION["MAND"])) {

                                            $query = "SELECT COUNT(MASP) AS SoLuong FROM giohang WHERE MAND = '{$_SESSION['MAND']}'";
                                            $result = mysqli_query($conn, $query);
                                            $row = mysqli_fetch_assoc($result);
                                            $_SESSION['SLGH'] = $row['SoLuong'];
                                            $_SESSION['SLGH'] == "" ? 0 : $_SESSION['SLGH'];
                                            echo '<span class="notify" id="CartCount">' . $_SESSION['SLGH'] . '</span>';

                                        }
                                        ?>
                                    </div>
                                    <small class="text"> Giỏ hàng </small>
                                </a>
                            </div>
                            <div class="widget-header mr-3">
                                <a  href="../KHACHHANG/detail.php" class="widget-view">
                                    <div class="icon-area">
                                        <i class="fa fa-user"></i>

                                    </div>
                                    <small class="text"> Cá nhân </small>
                                </a>
                            </div>
                            <?php if (isset($_SESSION["MAND"])): ?>
                                <!-- Nếu đã đăng nhập -->
                                <div class="widget-header mr-3">
                                    <a href="../AUTHENTICATION/Dangxuat.php" class="widget-view">
                                        <div class="icon-area">
                                            <i class="fa fa-sign-out-alt"></i>
                                        </div>
                                        <small class="text"> Đăng xuất </small>
                                    </a>
                                </div>
                            <?php else: ?>
                                <!-- Nếu chưa đăng nhập -->
                                <div class="widget-header mr-3">
                                    <a href="../AUTHENTICATION/Dangnhap.php" class="widget-view" id="DangNhapBtn">
                                        <div class="icon-area">
                                            <i class="fa fa-sign-in-alt"></i>
                                        </div>
                                        <small class="text"> Đăng nhập </small>
                                    </a>
                                </div>
                                <div class="widget-header mr-3">
                                    <a href="../AUTHENTICATION/Dangky.php" class="widget-view" id="DangKyBtn">
                                        <div class="icon-area">
                                            <i class="fa fa-user-plus"></i>
                                        </div>
                                        <small class="text"> Đăng ký </small>
                                    </a>
                                </div>
                            <?php endif; ?>


                        </div> <!-- widgets-wrap.// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- container.// -->
            
           
            <div class="container">
            <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-3 col-md-12">              
                    </div>
                    <div class="col-xl-6 col-lg-5 col-md-6">
                    <nav>
                            <ul class="category-list">
                            <?php
                                $result = mysqli_query($conn, "SELECT * from loaisanpham ");

                                if (mysqli_num_rows($result) <> 0) {
                                    while ($rows = mysqli_fetch_assoc($result)) {
                                        echo "<li class='category-item'>";
                                        echo "<a href='../LOAISANPHAM/DanhSachSanPham.php?id= {$rows['MALOAISP']}'>{$rows["TENLOAISP"]}</a>";
                                        echo "</li>";

                                    }
                                }
                                ?>
                            </ul>
                    </nav>                    
                    </div> <!-- col.// -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                    
                    </div>
                        </div> <!-- widgets-wrap.// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div>
       
        
        
    </header> <!-- section-header.// -->
    <div id="toast_updateCart">
        <div class="toast-content">
            <i class="fas fa-solid fa-check check"></i>

            <div class="message">

                <span id="notification" class="text text-2"></span>
            </div>
        </div>
        <i class="fa fa-times close"></i>

        <div class="progress"></div>
    </div>
    
<style>
   .category-list 
   {
    list-style-type: none; 
    padding: 0; 
    margin: 0;
    } 
    .category-item 
    {
        margin-right: 10px; 
        padding: 5px 10px; 
        float: left;
    }
   
</style>