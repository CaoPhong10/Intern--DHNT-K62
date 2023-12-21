<?php
include("../LOGIN_REQUIRED/LogIn_Required.php"); 
include '../Shared_Layout/header.php';

?>
<title>Đơn đặt hàng đã đặt</title>

<section class="section-pagetop bg-gray">
    <div class="container">
        <h2 class="title-page">Tài khoản của tôi</h2>
    </div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container">

        <div class="row">
            <aside class="col-md-3">
                <nav class="list-group">
                    <a class="list-group-item" href="Detail.php"> Thông tin chung </a>
                    <a class="list-group-item active" href="DonDatHang.php"> Đơn hàng </a>
                    <a class="list-group-item" href="CaiDatThongTin.php">Cài đặt thông tin</a>
                </nav>
            </aside> <!-- col.// -->
            <main class="col-md-9">
                <?php
                $tt_hd = mysqli_query($conn, "SELECT * FROM hoadon 
                JOIN nguoidung on hoadon.MAND = nguoidung.MAND 
                where hoadon.MAND = '{$_SESSION['MAND']}'ORDER BY hoadon.MAHOADON DESC") ;

                ?>
                <?php if (mysqli_num_rows($tt_hd) <> 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($tt_hd)): ?>
                        <?php
                        $tongtien_querry = mysqli_query($conn, "select sum(chitiethoadon.SOLUONG*chitiethoadon.DONGIAXUAT) as tongtien
                        from chitiethoadon join hoadon on chitiethoadon.MAHOADON = hoadon.MAHOADON
                        WHERE hoadon.MAHOADON = '{$row['MAHOADON']}'");
                        $tongtien_row = mysqli_fetch_assoc($tongtien_querry);
                        $tongtien = $tongtien_row['tongtien'];
                        ?>
                        <article class="card mb-4">
                            <header class="card-header">
                                <a href="#" class="float-right"> <i class="fa fa-print"></i></a>
                                <strong class="d-inline-block mr-3">ID đơn đặt hàng:
                                    <?php echo $row['MAHOADON'] ?>
                                </strong>
                                <span>Ngày đặt:
                                    <?php echo $row['NGAYTAO'] ?>
                                </span>
                            </header>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="text-muted">Giao hàng đến</h6>
                                        <p>
                                            <?php echo $row['TENND'] ?> <br>
                                            SĐT:
                                            <?php echo $row['SDT'] ?><br> Email:
<?php echo $row['EMAIL'] ?> <br>
                                            Địa chỉ:
                                            <br>

                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 class="text-muted">Thanh toán</h6>
                                        <span class="text-success">
                                            <i class="fab fa fa-money-bill"></i>
                                            Thanh toán khi nhận hàng
                                        </span>
                                        <p>
                                            Tổng tiền:
                                            <?php echo formatCurrencyVND($tongtien); ?>
                                            <br>
                                            Tiền ship:
                                            <?php echo formatCurrencyVND(0); ?>
                                            <br>
                                            <span class="b">Thanh toán:
                                                <?php echo formatCurrencyVND($tongtien); ?>
                                            </span>
                                        </p>
                                    </div>
                                </div> <!-- row.// -->
                            </div> <!-- card-body .// -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <?php 
                                        $tt_cthd = mysqli_query($conn, "SELECT chitiethoadon.*, hoadon.*, sanpham.*, chitiethoadon.SOLUONG as SLCTHD, sanpham.DONGIA as DGSP
                                        FROM chitiethoadon
                                        JOIN hoadon ON chitiethoadon.MAHOADON = hoadon.MAHOADON
                                        JOIN sanpham ON sanpham.MASP = chitiethoadon.MASP
                                        WHERE hoadon.MAHOADON = '{$row['MAHOADON']}'");
                                        ?>
                                        <?php if (mysqli_num_rows($tt_cthd) <> 0): ?>
                                            <?php while ($row = mysqli_fetch_assoc($tt_cthd)): ?>
                                                <tr>
                                                    <td width="65">
                                                        <img src="../../Images/<?php echo $row["ANH"]?>" class="img-xs border">
                                                    </td>
                                                    <td>
                                                        <p class="title mb-0"><?php echo $row["TENSP"]?> </p>
                                                        <var
class="price text-muted"><?php echo formatCurrencyVND($row['DGSP']); ?></var>
                                                    </td>
                                                    <td> Số lượng <br> <?php echo $row['SLCTHD']; ?> </td>
                                                    <td width="250">
                                                        Thành tiền <br> Thanh toán:
                                                        <?php echo formatCurrencyVND($row['DGSP']*$row['SLCTHD']); ?>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div> <!-- table-responsive .end// -->
                        </article>

                    <?php endwhile; ?>
                <?php endif; ?>

            </main> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<?php
include '../Shared_Layout/footer.php';
?>