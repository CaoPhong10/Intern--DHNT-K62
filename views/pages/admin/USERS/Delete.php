<?php
include("../../../db_connect.php");
include("../../../header_admin.php");
$maND = $_GET['maND'];
$sql = "SELECT MAND, TENND FROM nguoidung WHERE MAND = '{$maND}'";
$kq = mysqli_query($conn, $sql);
$tenND = mysqli_fetch_assoc($kq);
$tenND = $tenND['TENND'];
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "DELETE FROM nguoidung  WHERE MAND = '$maND'";
        mysqli_query($conn, $sql);
        echo '<script>window.location.href = "../USERS";</script>';
}
include("../../../footer_admin.php");
?>