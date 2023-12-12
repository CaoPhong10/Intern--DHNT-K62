<?php include '../Shared_Layout/header.php' ?>
<title>Trang chủ</title>
<div class="container">


    <!-- ========================= SECTION MAIN  ========================= -->
    <section class="section-main padding-y">
        <main class="card">
            <div class="card-body">

                <div class="row">
                    <aside class="col-lg col-md-3 flex-lg-grow-0">
                        
                    </aside> <!-- col.// -->
                    <div class="col-md-9 col-xl-12 col-lg-7">

                        <!-- ================== COMPONENT SLIDER  BOOTSTRAP  ==================  -->
                        <div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                                <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel1_indicator" data-slide-to="1"></li>
                                
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col">
                                            <img src="../../Content/images/banners/slide1.jpg" alt="First slide">
                                        </div>
                                        <div class="col">
                                            <img src="../../Content/images/banners/slide2.jpg" alt="Second slide">
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col">
                                            <img src="../../Content/images/banners/slide3.jpg" alt="Third slide">
                                        </div>
                                        <div class="col">
                                            <img src="../../Content/images/banners/slide4.jpg" alt="Fourth slide">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- ==================  COMPONENT SLIDER BOOTSTRAP end.// ==================  .// -->

                    </div> <!-- col.// -->

                </div> <!-- row.// -->

            </div> <!-- card-body.// -->
        </main> <!-- card.// -->

    </section>


    <!-- ========================= SECTION MAIN END// ========================= -->
    <!-- =============== SECTION 1 =============== -->
    <section class="padding-bottom">
        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">Điện thoại</h4>
        </header>

        <div class="card card-home-category">
            <div class="row no-gutters">
                <div class="col-md-3">

                    <div class="home-category-banner bg-light-orange">
                        <h5 class="title">Danh sách điện thoại hot nhất hiện nay</h5>
                        <p>Tìm kiếm và khám phá những mẫu điện thoại độc đáo và tiên tiến nhất.</p>
                        <a href="../LOAISANPHAM/DanhSachSanPham.php?id=LSP07"
                            class="btn btn-outline-primary rounded-pill">Xem ngay</a>
                        
                    </div>


                </div> <!-- col.// -->
                <div class="col-md-9">
                    <ul class="row no-gutters bordered-cols">

                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM sanpham WHERE MALOAISP = 'LSP07' LIMIT 6");

                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                echo '<li class="col-6 col-lg-4 col-md-4">';
                                echo "<a href='../SANPHAM/Detail.php?id={$rows['MASP']} ' class='item'>";
                                echo '<div class="card-body">';
                                echo "<img class='img-sm float-right' src=../../Images/{$rows['ANH']}> ";
                                echo "<p class='text-muted'><i class='fa fa-mobile'></i> {$rows['TENSP']}</p>";
                                echo '</div>';
                                echo '</a>';
                                echo '</li>';

                            }
                        }
                        ?>
                    </ul>
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
    </section>

    <section class="padding-bottom">
        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">Laptop</h4>
        </header>

        <div class="card card-home-category">
            <div class="row no-gutters">
                <div class="col-md-3">

                    <div class="home-category-banner bg-light-orange">
                        <h5 class="title">Các mẫu laptop cho công việc và giải trí</h5>
                        <p>Tìm kiếm và khám phá những mẫu laptop tiên tiến và đa năng cho công việc và giải trí của bạn.
                        </p>
                        <a href="../LOAISANPHAM/DanhSachSanPham.php?id=LSP06"
                            class="btn btn-outline-primary rounded-pill">Xem ngay</a>
                       
                    </div>


                </div> <!-- col.// -->
                <div class="col-md-9">
                    <ul class="row no-gutters bordered-cols">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM sanpham WHERE MALOAISP = 'LSP06' LIMIT 6");

                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                echo '<li class="col-6 col-lg-4 col-md-4">';
                                echo "<a href='../SANPHAM/Detail.php?id={$rows['MASP']} ' class='item'>";
                                echo '<div class="card-body">';
                                echo "<img class='img-sm float-right' src=../../Images/{$rows['ANH']}> ";
                                echo "<p class='text-muted'><i class='fa fa-laptop'></i> {$rows['TENSP']}</p>";
                                echo '</div>';
                                echo '</a>';
                                echo '</li>';

                            }
                        }
                        ?>

                    </ul>
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
    </section>

    <section class="padding-bottom">
        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">Máy tính bảng</h4>
        </header>

        <div class="card card-home-category">
            <div class="row no-gutters">
                <div class="col-md-3">

                    <div class="home-category-banner bg-light-orange">
                        <h5 class="title">Các mẫu máy tính bảng đa năng</h5>
                        <p>Tìm kiếm và khám phá những mẫu máy tính bảng tiện ích và đa năng cho công việc và giải trí
                            của bạn.</p>
                        <a href="../LOAISANPHAM/DanhSachSanPham.php?id=LSP08"
                            class="btn btn-outline-primary rounded-pill">Xem ngay</a>
                       
                    </div>


                </div> <!-- col.// -->
                <div class="col-md-9">
                    <ul class="row no-gutters bordered-cols">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM sanpham WHERE MALOAISP = 'LSP08' LIMIT 6");

                        if (mysqli_num_rows($result) <> 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                echo '<li class="col-6 col-lg-4 col-md-4">';
                                echo "<a href='../SANPHAM/Detail.php?id={$rows['MASP']} ' class='item'>";
                                echo '<div class="card-body">';
                                echo "<img class='img-sm float-right' src=../../Images/{$rows['ANH']}> ";
                                echo "<p class='text-muted'><i class='fa fa-tablet'></i> {$rows['TENSP']}</p>";
                                echo '</div>';
                                echo '</a>';
                                echo '</li>';

                            }
                        }
                        ?>

                    </ul>
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
    </section>



    <section class="padding-bottom-sm">

        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">Sản phẩm đang hot</h4>
        </header>

        <div class="row row-sm">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM sanpham  LIMIT 12");

            if (mysqli_num_rows($result) <> 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <div class="card card-sm card-product-grid">
                            <a href="../SANPHAM/Detail.php?id=<?php echo $rows['MASP']?>" class="img-wrap">
                                <img src="../../Images/<?= $rows['ANH'] ?>">
                            </a>
                            <figcaption class="info-wrap">
                                <a href="../SANPHAM/Detail.php?id=<?php echo $rows['MASP']?>" class="title">
                                    <?= $rows['TENSP'] ?>
                                </a>
                                <div class="price mt-1">
                                    <?= $rows['DONGIA'] ?>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


        </div> <!-- row.// -->
    </section>


    <section class="padding-bottom">

        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">chính sách</h4>
        </header>

        <div class="row">
            <div class="col-md-3 col-sm-6">
                <article class="card card-post">
                    <img src="../../Content/images/posts/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h6 class="title">Bảo hành sản phẩm</h6>
                        <p class="small text-uppercase text-muted">Bảo vệ đơn hàng</p>
                    </div>
                </article> <!-- card.// -->
            </div> <!-- col.// -->
            <div class="col-md-3 col-sm-6">
                <article class="card card-post">
                    <img src="../../Content/images/posts/2.jpg" class="card-img-top">
                    <div class="card-body">
                        <h6 class="title">Thanh toán dễ dàng</h6>
                        <p class="small text-uppercase text-muted">Nhiều phương thức thanh toán</p>
                    </div>
                </article> <!-- card.// -->
            </div> <!-- col.// -->
            <div class="col-md-3 col-sm-6">
                <article class="card card-post">
                    <img src="../../Content/images/posts/3.jpg" class="card-img-top">

                    <div class="card-body">
                        <h6 class="title">Kiểm tra đơn hàng</h6>
                        <p class="small text-uppercase text-muted">Kiểm tra dễ dàng</p>
                    </div>
                </article> <!-- card.// -->
            </div> <!-- col.// -->
            <div class="col-md-3 col-sm-6">
                <article class="card card-post">
                    <img src="../../Content/images/posts/4.jpg" class="card-img-top">
                    <div class="card-body">
                        <h6 class="title">Vận chuyển an toàn</h6>
                        <p class="small text-uppercase text-muted">Dịch vụ giao hàng tiện lợi</p>
                    </div>
                </article> <!-- card.// -->
            </div> <!-- col.// -->
        </div> <!-- row.// -->

    </section>


    <article class="my-4">
        <img src="../../Content/images/banners/ad-sm.png" class="w-100">
    </article>
</div>
<!-- container end.// -->
<?php include '../Shared_Layout/footer.php' ?>