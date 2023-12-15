<?php
require("../../../db_connect.php");
include("../../../header_admin.php");
$maTH = $_GET['maTH'];
$sql = "SELECT * FROM thuonghieu
WHERE thuonghieu.MATH = '$maTH'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

function isBrandExists($conn, $tenTH) {
    $tenTH = mysqli_real_escape_string($conn, $tenTH);
    $sql = "SELECT COUNT(*) as count FROM thuonghieu WHERE TENTHUONGHIEU = '$tenTH'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}
if (isset($_POST['tenTH'])) $tenTH = $_POST["tenTH"];
if (isset($_POST["luu"])) {
    if (!isBrandExists($conn, $tenTH)) {
    $sql = "UPDATE thuonghieu SET TENTHUONGHIEU = '" . $_POST['tenTH'] . "', QUOCGIA = '" . $_POST['quocGia'] . "'
        WHERE MATH = '".$maTH."'";

    $result = mysqli_query($conn, $sql);
    echo "
    <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4><i class='icon fa fa-check'></i> Thành công!</h4>
        Thêm dữ liệu thành công
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'Index.php';
        }, 2000); // Chuyển hướng sau 2 giây
    </script>
    ";
} else {
    echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Lỗi !</h4>
            Thương hiệu đã tồn tại
        </div>';
}
}

?>
<div class="container">
        <h2 style="text-align:center">Chỉnh sửa</h2>

        <form action="" method="post" enctype="multipart/form-data">

                <div class="form-horizontal">
                        <h4>Thương hiệu</h4>
                        <hr />
                        <div class="form-group">
                                <label class="control-label col-md-2">Mã Thương Hiệu </label>
                                <input type="text" class="form-control ml-2" readonly value="<?php echo $maTH ?>"
                                        name="maTH" style="width:82%">
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-2">Tên Thương Hiệu </label>
                                <div class="col-md-10">
                                        <input type="text" class="form-control" name="tenTH" 
                                                value="<?php echo $row['TENTHUONGHIEU'] ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-md-2">Quốc Gia</label>
                                <div class="col-md-10">
                                        <input type="text" class="form-control" name="quocGia" 
                                        value="<?php echo $row['QUOCGIA'] ?>">
                                </div>
                        </div>

                        
                        <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                        <input type="submit" value="Lưu" class="btn btn-success" name="luu" />
                                </div>
                        </div>
                </div>
        </form>

        <div>
                <a href="./Index.php" class="btn btn-primary">Trở về trang danh sách</a>
        </div>
</div>

<?php
include("../../../footer_admin.php");
?>