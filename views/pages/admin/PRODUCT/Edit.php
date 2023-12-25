<?php
require("../../../db_connect.php");

$maSP = $_GET['maSP'];
$sql_sanpham = "SELECT TENSP, DONGIA, SOLUONG, MOTA, ANH, TENLOAISP, TENTHUONGHIEU, HEDIEUHANH, sanpham.MATSKT,
RAM, ROM, KICHCOMANHINH, VIXULY, PIN, CAMERA
FROM ((sanpham join loaisanpham on sanpham.MALOAISP = loaisanpham.MALOAISP) join thuonghieu on
sanpham.MATH = thuonghieu.MATH) join thongsokythuat on sanpham.MATSKT=thongsokythuat.MATSKT
WHERE sanpham.MASP = '$maSP'";
$result = mysqli_query($conn, $sql_sanpham);
$row = mysqli_fetch_assoc($result);
$maTSKT = $row['MATSKT'];

if (isset($_POST["luu"])) {
        $target_dir = "../../../Images/";

        // Kiểm tra xem người dùng đã chọn ảnh mới hay chưa
        if (!empty($_FILES["Avatar"]["name"])) {
                $target_file = $target_dir . basename($_FILES["Avatar"]["name"]);
                $check = getimagesize($_FILES["Avatar"]["tmp_name"]);

                if ($check !== false) {
                        move_uploaded_file($_FILES["Avatar"]["tmp_name"], $target_file);
                        $anh_moi = $_FILES["Avatar"]["name"];
                } else {
                        ?>
                        <script>
                                window.alert("Tệp ảnh không hợp lệ");
                        </script>
                        <?php
                }
        } else {
                // Nếu không có ảnh mới, sử dụng ảnh cũ
                $anh_moi = $row['ANH'];
        }

        $sql = "UPDATE sanpham SET TENSP = '" . $_POST['TENSP'] . "', DONGIA = '" . $_POST['DONGIA'] . "',
            SOLUONG = '" . $_POST['SOLUONG'] . "', MOTA = '" . $_POST['MOTA'] . "', ANH = '$anh_moi',
            MALOAISP = '" . $_POST['loaisp'] . "', MATH = '" . $_POST['thuonghieu'] . "'
            WHERE MASP = '" . $maSP . "'";
        $result = mysqli_query($conn, $sql);
        $sql = "UPDATE thongsokythuat SET HEDIEUHANH = '" . $_POST['HEDIEUHANH'] . "', RAM = '" . $_POST['RAM'] . "',
            ROM = '" . $_POST['ROM'] . "', KICHCOMANHINH = '" . $_POST['KICHCOMANHINH'] . "',
            VIXULY = '" . $_POST['VIXULY'] . "', PIN = '" . $_POST['PIN'] . "', CAMERA = '" . $_POST['CAMERA'] . "'
            WHERE MATSKT = '" . $maTSKT . "'";
        $result = mysqli_query($conn, $sql);
        header('Location:index.php');
}

include("../../../header_admin.php");
?>
<h2 style="text-align:center">Chỉnh sửa</h2>

<div class="container ">

        <form action="" class="d-flex justify-content-center" method="post" enctype="multipart/form-data">
                <div>
                        <div class="form-group">

                                <label class="control-label ">Mã sản phẩm </label>
                                <div class="col-md-10">
                                        <input type="text" class="form-control textfile" readonly
                                                value="<?php echo $maSP ?>" name="MASP">
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label ">Tên sản phẩm </label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="TENSP"
                                                value="<?php echo $row['TENSP'] ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label">Đơn giá</label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="DONGIA"
                                                value="<?php echo number_format($row['DONGIA']); ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label ">Số lượng</label>
                                <div class="col-md-10">
                                        <input required type="number" class="form-control textfile" name="SOLUONG"
                                                value="<?php echo $row['SOLUONG'] ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label ">Mô tả</label>
                                <div class="col-md-10">
                                        <textarea class="form-control textfile" name="MOTA" id="" cols="60" rows="10"><?php echo $row['MOTA'] ?>
                                        </textarea>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label">Ảnh</label>
                                <div class="col-md-10">
                                        <input required type="file" class="textfile" value="Chọn File" name="Avatar"
                                                accept="image/*" />
                                </div>
                        </div>

                        <?php
                        $sql_loaisp = "SELECT TENLOAISP, MALOAISP from loaisanpham ";
                        $result_loaisp = mysqli_query($conn, $sql_loaisp);
                        ?>
                        <div class="form-group">
                                <label class="control-label">Loại sản phẩm</label>
                                <div class="col-md-10">
                                        <select name="loaisp" id="" class="form-control textfile">
                                                <?php while ($rows = mysqli_fetch_row($result_loaisp)) {
                                                        if ($row["TENLOAISP"] == $rows[0]) {
                                                                echo "<option selected value='$rows[1]'>$rows[0]</option>";
                                                        } else
                                                                echo "<option value='$rows[1]'>$rows[0]</option>";
                                                } ?>
                                        </select>
                                </div>
                        </div>





                </div>
                <div>
                        <?php
                        $sql_thuonghieu = "SELECT TENTHUONGHIEU, MATH from thuonghieu ";
                        $result_thuonghieu = mysqli_query($conn, $sql_thuonghieu);
                        ?>
                        <div class="form-group">
                                <label class="control-label">Thương hiệu</label>
                                <div class="col-md-10">
                                        <select name="thuonghieu" id="" class="form-control textfile">
                                                <?php while ($rows = mysqli_fetch_row($result_thuonghieu)) {
                                                        if ($row["TENTHUONGHIEU"] == $rows[0]) {
                                                                echo "<option selected value='$rows[1]'>$rows[0]</option>";
                                                        } else
                                                                echo "<option value='$rows[1]'>$rows[0]</option>";
                                                } ?>
                                        </select>
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label">Hệ điều hành </label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="HEDIEUHANH"
                                                value="<?php echo $row['HEDIEUHANH'] ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label">Ram</label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="RAM"
                                                value="<?php echo number_format($row['RAM']); ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label">Rom</label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="ROM"
                                                value="<?php echo $row['ROM'] ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label">Kích cỡ màn hình</label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="KICHCOMANHINH"
                                                value="<?php echo $row['KICHCOMANHINH'] ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label">Vi xử lý</label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="VIXULY"
                                                value="<?php echo $row['VIXULY'] ?>">
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label">Pin</label>
                                <div class="col-md-10">
                                        <input required type="number" class="form-control textfile" name="PIN"
                                                value="<?php echo $row['PIN'] ?>">
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label">Camera</label>
                                <div class="col-md-10">
                                        <input required type="text" class="form-control textfile" name="CAMERA"
                                                value="<?php echo $row['CAMERA'] ?>">
                                </div>
                        </div>

                        <div class="form-group mt">
                                <div>
                                        <input type="submit" value="Lưu" class="btn btn-success" name="luu" />
                                        <a href="./Index.php" class="btn btn-success">Trở về trang danh sách</a>
                                </div>
                        </div>
                </div>

        </form>


</div>

<?php
include("../../../footer_admin.php");
?>