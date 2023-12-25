<?php
include("../LOGIN_REQUIRED/LogIn_Required.php"); 

if (!isset($_SESSION['MAND'])) {
    header("Location: ../AUTHENTICATION/DangNhap.php");

    exit();

}
include '../Shared_Layout/header.php';

$result = mysqli_query($conn, "SELECT * FROM nguoidung  
    WHERE nguoidung.MAND = '{$_SESSION['MAND']}'");
?>
<title>Thông tin cá nhân</title>
<section class="section-pagetop bg-gray">
    <div class="container">
        <h2 class="title-page">Tài khoản của tôi</h2>
    </div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->
<!-- ========================= SECTION CONTENT ========================= -->
<?php if (mysqli_num_rows($result) <> 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <section class="section-content padding-y">
            <div class="container">

                <div class="row">
                    <aside class="col-md-3">
                        <nav class="list-group">
                            <a class="list-group-item active" href="Detail.php"> Thông tin chung </a>
                            <a class="list-group-item" href="DonDatHang.php"> Đơn hàng </a>
                            <a class="list-group-item" href="CaiDatThongTin.php">Cài đặt thông tin</a>
                        </nav>
                    </aside> <!-- col.// -->
                    <main class="col-md-9">

                        <article class="card mb-3">
                            <div class="card-body">
                                <figure class="icontext">
                                    <div class="icon">
                                        <img class="rounded-circle img-sm border"
                                            src="../../Content/images/avatars/avatar3.jpg">
                                    </div>
                                    <div class="text">
                                        <strong>
                                            <?php echo $row['TENND']; ?>
                                        </strong> <br>
                                        <p class="mb-2">
                                            <?php echo $row['EMAIL']; ?>
                                        </p>
                                        <a href="CaiDatThongTin.php" class="btn btn-light btn-sm">Chỉnh sửa</a>
                                    </div>  
                                </figure>
                                <hr>
                                <p>
                                    <i class="fa fa-map-marker text-muted"></i> &nbsp; Địa chỉ của tôi:
                                    <br>
                                    <?php echo $row['DIACHI']; ?>

                                </p>

                                <article class="card-group card-stat">
                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM nguoidung 
                                  JOIN hoadon ON nguoidung.MAND = hoadon.MAND
                                  WHERE nguoidung.MAND = '{$_SESSION['MAND']}'");
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row['total'];
                                                echo $total;
                                                ?>
                                            </h4>
                                            <span>Đơn đặt hàng</span>
                                        </div>
                                    </figure>
                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">
                                                <?php
                                                $query = "SELECT SUM(ct.SOLUONG) AS total
                                  FROM hoadon hd
                                  JOIN chitiethoadon ct ON hd.MAHOADON = ct.MAHOADON
                                  join nguoidung on hd.MAND = nguoidung.MAND
                                  WHERE hd.TINHTRANGDONHANG = 'Giao hàng thành công' and nguoidung.MAND = '{$_SESSION['MAND']}'";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row['total'];
                                                echo isset($total) ? $total : 0;

                                                ?>
                                            </h4>
                                            <span>Sản phẩm đã mua</span>
                                        </div>
                                    </figure>
                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(hoadon.MAHOADON) as total
                                                from hoadon join nguoidung on hoadon.MAND = nguoidung.MAND
                                                where hoadon.MAND = '{$_SESSION['MAND']}'and hoadon.TINHTRANGDONHANG = 'Đang giao hàng'");
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row['total'];
                                                echo isset($total) ? $total : 0;
                                                ?>
                                            </h4>
                                            <span>Đơn hàng đang giao</span>
                                        </div>
                                    </figure>
                                    <figure class="card bg">
                                        <div class="p-3">
                                            <h4 class="title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(hoadon.MAHOADON) as total
                                                from hoadon join nguoidung on hoadon.MAND = nguoidung.MAND
                                                where hoadon.MAND = '{$_SESSION['MAND']}'and hoadon.TINHTRANGDONHANG = 'Giao hàng thành công'");
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row['total'];
                                                echo isset($total) ? $total : 0;
                                                ?>
                                            </h4>
                                            <span>Đơn hàng đã giao</span>
                                        </div>
                                    </figure>
                                </article>


                            </div> <!-- card-body .// -->
                        </article> <!-- card.// -->

                        <article class="card  mb-3">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Đơn hàng gần đây</h5>

                                <div class="row">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT* 
                                  FROM hoadon join chitiethoadon on hoadon.MAHOADON = chitiethoadon.MAHOADON join sanpham on chitiethoadon.MASP = sanpham.MASP
                                  where hoadon.MAND = '{$_SESSION['MAND']}'
                                  ORDER by hoadon.NGAYTAO DESC
                                  LIMIT 4
                                  ");

                                    ?>
                                    <?php if (mysqli_num_rows($result) <> 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <div class="col-md-6">
                                                <figure class="itemside  mb-3">
                                                    <div class="aside"><img src="../../Images/<?php echo $row['ANH']; ?>"
                                                            class="border img-sm">
                                                    </div>
                                                    <figcaption class="info">
                                                        <time class="text-muted"><i class="fa fa-calendar-alt"></i>
                                                            <?php echo $row['NGAYTAO']; ?>
                                                        </time>
                                                        <p>
                                                        <a href="../SANPHAM/Detail.php?id=<?php echo $row['MASP']?>">
                                                            <?php echo $row['TENSP']; ?>
                                                        </p>
                                                        <span class="text-success">
                                                            <?php echo $row['TINHTRANGDONHANG']; ?>
                                                        </span>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>


                                </div> <!-- row.// -->

                                <a href="DonDatHang.php" class="btn btn-outline-primary btn-block"> Xem tất cả
                                    <i class="fa fa-chevron-down"></i> </a>
                            </div> <!-- card-body .// -->
                        </article> <!-- card.// -->

                    </main> <!-- col.// -->
                </div>

            </div> <!-- container .//  -->
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<!-- ========================= SECTION CONTENT END// ========================= -->
<?php include '../Shared_Layout/footer.php' ?>