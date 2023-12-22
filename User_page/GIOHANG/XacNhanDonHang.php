<?php
include("../LOGIN_REQUIRED/LogIn_Required.php"); 
include '../Shared_Layout/header.php';

$statement = "";

if (isset($_POST['selectedProducts'])) {
    $selectedProducts = json_decode($_POST['selectedProducts'], true);
    $_SESSION['selectedProducts'] = $selectedProducts;
    foreach ($selectedProducts as $product) {
        $masp = $product['MASP'];
        $soluong = $product['SOLUONG'];

        $statement .= "'" . $masp . "',";
    }
    $statement = rtrim($statement, ","); // Loại bỏ dấu phẩy cuối cùng
    $query = "SELECT SUM(SOLUONG*DONGIA) AS total FROM giohang WHERE MASP IN ($statement) AND MAND = '{$_SESSION['MAND']}'";
    $result = mysqli_query($conn, $query);
    $ctdh = mysqli_query($conn, "SELECT *,giohang.SOLUONG as slgh,giohang.DONGIA as dggh FROM giohang join sanpham on giohang.MASP=sanpham.MASP WHERE giohang.MASP IN ($statement) AND giohang.MAND = '{$_SESSION['MAND']}'");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $tongtien = $row["total"];
    } else {
        echo "Lỗi trong quá trình thực thi câu truy vấn.";
    }
}

$_SESSION['tongtien'] = $tongtien;


?>


<title>Xác nhận đơn hàng</title>
<b class="screen-overlay"></b>

<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
    <div class="container">
        <h2 class="title-page text-center">Xác nhận đặt hàng</h2>
    </div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
    <div class="container d-flex justify-content-center">

        <main class="col-md-9">

            <article class="card mb-4">
                <header class="card-header">


                    <span>
                        <?php
                        // In ngày hiện tại đã được chuyển đổi
                        echo 'Ngày đặt hàng: ' . date('d/m/Y', strtotime(date('Y-m-d')));
                        ?>
                    </span>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="text-muted">Giao đến</h6>
                            <p>
                                <?php
                                echo $_SESSION["TENND"] . '<br>' .
                                    'Số điện thoại: ' . $_SESSION["SDT"] . '<br>' .
                                    'Địa chỉ: ' . $_SESSION["DIACHI"] . '<br>';
                                ?>

                            </p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Thanh toán</h6>
                            <span class="text-success">
                                <i class="fab fa fa-money-bill"></i>
                                Số tiền thanh toán 
                            </span>
                            <p>
                                Tổng tiền:
                                <?php echo formatCurrencyVND($tongtien) ?> <br>
                                Phí ship:
                                <?php echo formatCurrencyVND(0) ?> <br>
                                <span class="b">Số tiền cần thanh toán:
                                    <?php echo formatCurrencyVND($tongtien) ?>
                                </span>
                            </p>
                        </div>
                    </div> <!-- row.// -->
                </div> <!-- card-body .// -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>

                            <?php if (mysqli_num_rows($ctdh) <> 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($ctdh)): ?>
                                    <tr>
                                        <td width="65">
                                            <img src="../..//Images/<?php echo $row['ANH'] ?>" class="img-xs border">
                                        </td>
                                        <td>
                                            <p class="title mb-0"><?php echo $row['TENSP'] ?> </p>
                                            <var
                                                class="price text-muted"><?php echo formatCurrencyVND($row['dggh']) ?></var>
                                        </td>
                                        <td> Số lượng <br> <?php echo $row['slgh'] ?> </td>
                                        <td width="250"> Thành tiền <br>
                                        <?php echo formatCurrencyVND($row['slgh']*$row['dggh']) ?> </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endif; ?>


                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <a href="../GIOHANG/DatHangThanhCong.php" class="btn btn-primary float-md-right m-3">
                            Đặt hàng </a>
                    </div>
                    <div class="d-flex justify-content-center">
                    <a href="../vnpay_php/index.php" class="btn btn-primary float-md-right m-3">Thanh toán VNpay
                        </a>
                    </div>
                </div> <!-- table-responsive .end// -->
            </article> <!-- card order-item .// -->

        </main> <!-- col.// -->


    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<?php 
include '../Shared_Layout/footer.php'; ?>
