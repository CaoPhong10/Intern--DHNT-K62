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
    <h2>Chỉnh sửa loại sản phẩm</h2>
    <form action="" method="POST" id="form-3">
        <div class="form-horizontal">
            
            <div class="form-group">
                <label>Mã loại sản phẩm</label>
                <input type="text" class="form-control ml-2"  value="<?php echo $maLoaiSP ?>" disabled name="maLoaiSP" style="width:52%">
            </div>
            <div class="form-group">
                <label>Tên loại</label>
                <input type="text" class="form-control ml-2"name="tenLoaiSP" id="tenloai" value="<?php echo $tenLoaiSP?>" style="width:52%">
                <span class="error_message"></span>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10"> 
                    <input type="submit" value="Chỉnh sửa" class="btn btn-success" name="edit" />
                    <a href="javascript:history.go(-1);"><input type="button" value="Quay lại" class="btn btn-success" name="Quay lại" /></a>
                </div>
            </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mong muốn của chúng ta
        Validator({
            form: '#form-3',
            formGroupSelector: '.form-group',
            errorSelector: '.error_message',
            rules: [
                Validator.isRequired('#tenloai', 'Vui lòng nhập tên loại!'),
            ],
            onSubmit: function (data) {
                // Call API
                //console.log(data);
            }
        });
    });
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE loaisanpham SET TENLOAISP = '{$_POST['tenLoaiSP']}' WHERE MALOAISP = '$maLoaiSP'";
    mysqli_query($conn, $sql);
    echo '<script>window.location.href = "../CATEGORY";</script>'; 
}
include("../../../footer_admin.php");
?>