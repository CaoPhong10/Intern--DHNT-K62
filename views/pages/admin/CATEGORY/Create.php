<?php
include("../../../header_admin.php");
include("../../../db_connect.php");
$sql = "SELECT MALOAISP from loaisanpham ORDER BY MALOAISP DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$maLoaiSP = (int) substr($row['MALOAISP'], 3);
$maLoaiSP = $maLoaiSP + 1;
$maLoaiSP = "LSP" . str_pad($maLoaiSP, 2, "0", STR_PAD_LEFT);
?>
<div class="container">
    <h2>Thêm loại sản phẩm</h2>
    <form action="" method="POST" id="form-3">
        <div class="form-horizontal">
            
            <div class="form-group">
                <label>Mã loại sản phẩm</label>
                <input type="text" name="maLoaiSP" class="form-control textfile"  value="<?php echo $maLoaiSP ?>" disabled  style="width:52%">
            </div>
            <div class="form-group">
                <label>Tên loại</label>
                <input type="text" id="tenloai" class="form-control textfile" name="tenLoaiSP" style="width:52%">
                <span class="error_message"></span>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Thêm" class="btn btn-success" name="create" />
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
    $sql = "INSERT INTO loaisanpham VALUES ('$maLoaiSP', '{$_POST['tenLoaiSP']}')";
    mysqli_query($conn, $sql);
    echo '<script>window.location.href = "../CATEGORY";</script>'; 
}
include("../../../footer_admin.php");
?>