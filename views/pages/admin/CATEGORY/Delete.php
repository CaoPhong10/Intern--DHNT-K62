<?php
include("../../../header_admin.php");
include("../../../db_connect.php");
$maLoaiSP = $_GET['id'];
$sql = "SELECT TENLOAISP FROM loaisanpham WHERE MALOAISP = '{$maLoaiSP}'";
$kq = mysqli_query($conn, $sql);
$tenLoaiSP = mysqli_fetch_assoc($kq);
$tenLoaiSP = $tenLoaiSP['TENLOAISP'];
?>
<div class="container">
    <h2>BẠN CÓ MUỐN XÓA LOẠI SẢN PHẨM NÀY?</h2>
    <form action="" method="POST">
        <div class="form-horizontal">
            
            <div class="form-group">
                <label>Mã loại sản phẩm</label>
                <input type="text" class="form-control textfile"  value="<?php echo $maLoaiSP ?>" disabled name="maLoaiSP" style="width:52%">
            </div>
            <div class="form-group">
                <label>Tên loại</label>
                <input type="text" class="form-control textfile"name="tenLoaiSP" disabled value="<?php echo $tenLoaiSP?>" style="width:52%">
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10"> 
                    <input type="submit" value="Xóa" class="btn btn-danger" name="delete" />
                    <a href="javascript:history.go(-1);"><input type="button" value="Quay lại" class="btn btn-success" name="Quay lại" /></a>
                </div>
            </div>
    </form>
</div>

<?php
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM loaisanpham WHERE MALOAISP = '$maLoaiSP'";
    mysqli_query($conn, $sql);
    echo '<script>window.location.href = "../CATEGORY";</script>'; 
}
include("../../../footer_admin.php");
?>