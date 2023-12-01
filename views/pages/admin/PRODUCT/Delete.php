<?php
require("../../../db_connect.php");

$maSP = $_GET['maSP'];
$sql = "SELECT TENSP, DONGIA, SOLUONG, MOTA, ANH, TENLOAISP, TENTHUONGHIEU, HEDIEUHANH
FROM ((sanpham join loaisanpham on sanpham.MALOAISP = loaisanpham.MALOAISP) join thuonghieu on
sanpham.MATH = thuonghieu.MATH) join thongsokythuat on sanpham.MATSKT=thongsokythuat.MATSKT
WHERE sanpham.MASP = '$maSP'";
$result = mysqlI_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["xoa"])) {
        $sql = "DELETE FROM sanpham WHERE MASP = '$maSP'";
        $result = mysqli_query($conn, $sql);
        header('Location:Index.php');

}
include("../../../header_admin.php");
?>

<h2 style="text-align:center">Xóa sản phẩm</h2>


<div class="container">
        <h3>Bạn có chắc muốn xóa?</h3>
        <hr />

        <dl class="dl-horizontal">
                <dt>
                        Tên sản phẩm
                </dt>

                <dd>
                        <?php
                        echo $row['TENSP'];
                        ?>
                </dd>

                <dt>
                        Đơn giá
                </dt>

                <dd>
                        <?php
                        echo $row['DONGIA'];
                        ?>
                </dd>

                <dt>
                        Số lượng
                </dt>

                <dd>
                        <?php
                        echo $row['SOLUONG'];
                        ?>
                </dd>

                <dt>
                        Mô tả
                </dt>

                <dd>
                        <?php
                        echo $row['MOTA'];
                        ?>
                </dd>

                <dt>
                        Ảnh
                </dt>

                <dd>
                        <img class="" width="30%" src="<?php $anh = $row['ANH'];
                        echo "../../../Images/" . $anh ?>  ">
                </dd>

                <dt>
                        Loại sản phẩm
                </dt>

                <dd>
                        <?php
                        echo $row['TENLOAISP'];
                        ?>
                </dd>

                <dt>
                        Thương hiệu
                </dt>

                <dd>
                        <?php
                        echo $row['TENTHUONGHIEU'];
                        ?>
                </dd>

                <dt>
                        Hệ điều hành
                </dt>

                <dd>
                        <?php
                        echo $row['HEDIEUHANH'];
                        ?>
                </dd>

        </dl>


        <form action="" method="post">
                <div class="form-actions no-color">
                        <input type="submit" value="Xóa" name="xoa" class="btn btn-danger" /> |
                        <a href="./Index.php" class="btn btn-primary"   >Trở về trang danh sách</a>
                </div>
        </form>
</div>