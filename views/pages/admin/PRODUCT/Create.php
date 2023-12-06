<?php
require("../../../db_connect.php");


$sql = "SELECT MASP from sanpham ORDER BY MASP DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$maSP = (int) substr($row['MASP'], 2);
$maSP = $maSP + 1;
$maSP = "SP" . str_pad($maSP, 6, "0", STR_PAD_LEFT);

if (isset($_POST["taomoi"])) {
        $target_dir = "../../Images/";
        $target_file = $target_dir . basename($_FILES["Avatar"]["name"]);
        $check = getimagesize($_FILES["Avatar"]["tmp_name"]);
        if ($check !== false) {
                move_uploaded_file($_FILES["Avatar"]["tmp_name"], $target_file);
                $sql = "INSERT INTO sanpham VALUES ('$maSP', '" . $_POST['TENSP'] . "', '" . $_POST['DONGIA'] . "', 
        '" . $_POST['SOLUONG'] . "', '" . $_POST['MOTA'] . "', '" . $_FILES["Avatar"]["name"] . "', '" . $_POST['loaisp'] . "',
        '" . $_POST['thuonghieu'] . "', '" . $_POST['matskt'] . "')";
                $result = mysqli_query($conn, $sql);
                header('Location:index.php');
        }
        ?>
        <script>
                window.alert("Tệp ảnh không hợp lệ");
        </script>
        <?php

}
include("../../../header_admin.php");
?>
<div class="container">
        
        <h2 style="text-align:center">Thêm sản phẩm</h2>
        <form action="" method="post" enctype="multipart/form-data">

                <div class="form-horizontal">
                        <h2>Sản phẩm</h2>
                        <div class="form-group">
                                <label class="control-label col-md-2">Mã sản phẩm </label>
                                <input type="text" class="form-control ml-2" readonly value="<?php echo $maSP ?>"
                                        name="MASP" style="width:82%">
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-2">Tên sản phẩm </label>
                                <div class="col-md-10">
                                        <input type="text" class="form-control" name="TENSP" required>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-2">Đơn giá </label>
                                <div class="col-md-10">
                                        <input type="text" class="form-control" name="DONGIA" required>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-2">Số lượng </label>
                                <div class="col-md-10">
                                        <input type="number" class="form-control" name="SOLUONG" required>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-2">Mô tả </label>
                                <div class="col-md-10">
                                        <input type="text" class="form-control" name="MOTA" required>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-2">Ảnh</label>
                                <div class="col-md-10">
                                        <input type="file" value="Chọn File" name="Avatar" accept="image/*" required />
                                </div>
                        </div>

                        <?php
                        $sql_loaisp = "SELECT TENLOAISP, MALOAISP from loaisanpham ";
                        $result_loaisp = mysqli_query($conn, $sql_loaisp);
                        ?>
                        <div class="form-group">
                                <label class="control-label col-md-2">Loại sản phẩm</label>
                                <div class="col-md-10">
                                        <select name="loaisp" id="" class="form-control">
                                                <?php while ($row = mysqli_fetch_row($result_loaisp)) {
                                                        echo "<option selected value='$row[1]'>$row[0]</option>";
                                                } ?>
                                        </select>
                                </div>
                        </div>

                        <?php
                        $sql_thuonghieu = "SELECT TENTHUONGHIEU, MATH from thuonghieu ";
                        $result_thuonghieu = mysqli_query($conn, $sql_thuonghieu);
                        ?>
                        <div class="form-group">
                                <label class="control-label col-md-2">Thương hiệu</label>
                                <div class="col-md-10">
                                        <select name="thuonghieu" id="" class="form-control">
                                                <?php while ($row = mysqli_fetch_row($result_thuonghieu)) {
                                                        echo "<option selected value='$row[1]'>$row[0]</option>";
                                                } ?>
                                        </select>
                                </div>
                        </div>
                        <?php
                        $sql_tskt = "SELECT MATSKT from thongsokythuat ";
                        $result_tskt = mysqli_query($conn, $sql_tskt);
                        ?>
                        <div class="form-group">
                                <label class="control-label col-md-2">Mã thông số kỹ thuật</label>
                                <div class="col-md-10">
                                        <select name="matskt" id="" class="form-control">
                                                <?php while ($row = mysqli_fetch_row($result_tskt)) {
                                                        echo "<option selected value='$row[0]'>$row[0]</option>";
                                                } ?>
                                        </select>
                                </div>
                        </div>

                        <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                        <input type="submit" value="Tạo mới" class="btn btn-primary" name="taomoi" />
                                </div>
                        </div>
                </div>
        </form>

        <div>
                <a href="./index.php" class="btn btn-primary">Trở về trang danh sách</a>
        </div>
</div>
<?php
include("../../../footer_admin.php");
?>