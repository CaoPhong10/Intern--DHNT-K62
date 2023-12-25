<?php
require("../../../db_connect.php");

$maSP = $_GET['maSP'];
$sql = "SELECT TENSP, DONGIA, SOLUONG, MOTA, ANH, TENLOAISP, TENTHUONGHIEU, HEDIEUHANH, thongsokythuat.MATSKT
FROM ((sanpham join loaisanpham on sanpham.MALOAISP = loaisanpham.MALOAISP) join thuonghieu on
sanpham.MATH = thuonghieu.MATH) join thongsokythuat on sanpham.MATSKT=thongsokythuat.MATSKT
WHERE sanpham.MASP = '$maSP'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["xoa"])) {
        $sql = "DELETE FROM sanpham WHERE MASP = '$maSP'";
        $result = mysqli_query($conn, $sql);
        $sql = "DELETE FROM thongsokythuat WHERE MATSKT = '{$row['MATSKT']}'";
        $result = mysqli_query($conn, $sql);
        header('Location:Index.php');

}
include("../../../header_admin.php");
?>


<div class="container">
    <h2>BẠN CÓ MUỐN XÓA SẢN PHẨM NÀY?</h2>
    <form action="" method="POST">
        <div class="form-horizontal">
            
            <div class="form-group">
                <label>Mã sản phẩm</label>
                <input type="text" class="form-control textfile"  value="<?php echo $maSP ?>" disabled name="maSP" style="width:52%">
            </div>
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control textfile"name="tenSP" disabled value="<?php echo $row['TENSP']?>" style="width:52%">
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10"> 
                    <input type="submit" value="Xóa" class="btn btn-danger" name="xoa" />
                    <a href="javascript:history.go(-1);"><input type="button" value="Quay lại" class="btn btn-success" name="Quay lại" /></a>
                </div>
            </div>
    </form>
</div>
<?php
include("../../../footer_admin.php");
?>