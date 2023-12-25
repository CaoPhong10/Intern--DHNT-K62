<?php
include("../../../db_connect.php");
include("../../../header_admin.php");
$maND = $_GET['maND'];
$sql = "SELECT MAND, TENND FROM nguoidung WHERE MAND = '{$maND}'";
$kq = mysqli_query($conn, $sql);
$tenND = mysqli_fetch_assoc($kq);
$tenND = $tenND['TENND'];
if (isset($_POST["delete"])) {
        $sql = "DELETE FROM nguoidung  WHERE MAND = '$maND'";
        mysqli_query($conn, $sql);
        echo "
    <div class='alert alert-success alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h4><i class='icon fa fa-check'></i> Thành công!</h4>
        Xoá thành công
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'Index.php';
        }, 2000); // Chuyển hướng sau 2 giây
    </script>
    ";
}
?>
<div class="container">
        <h2>Xóa người dùng này?</h2>
        <form action="" method="POST">
                <div class="form-horizontal">

                        <div class="form-group">
                                <label>Mã người dùng</label>
                                <input type="text" class="form-control ml-2 textfile" value="<?php echo $maND ?>"
                                        disabled name="maND">
                        </div>
                        <div class="form-group">
                                <label>Tên người dùng</label>
                                <input type="text" class="form-control ml-2 textfile" name="tenND" disabled
                                        value="<?php echo $tenND ?>">
                        </div>
                        <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                        <input type="submit" value="Xóa" class="btn btn-danger" name="delete" />
                                        <a href="javascript:history.go(-1);"><input type="button" value="Quay lại"
                                                        class="btn btn-success" name="Quay lại" /></a>
                                </div>
                        </div>
        </form>
</div>
<?php

include("../../../footer_admin.php");
?>