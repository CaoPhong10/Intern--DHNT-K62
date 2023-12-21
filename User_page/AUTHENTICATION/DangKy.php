<?php
include '../Shared_Layout/header.php';
?>
<?php
include("../../db_connect.php");

$sqlTinh = "SELECT tinh.tenTinh, huyen.tenHuyen, xa.tenXa 
FROM tinh 
JOIN huyen ON tinh.maTinh = huyen.maTinh 
JOIN xa ON huyen.maHuyen = xa.maHuyen";
$resultTinh = $conn->query($sqlTinh);

$tinhList = array();
$huyenList = array();
$xaList = array();
if ($resultTinh->num_rows > 0) {
    while ($rowTinh = $resultTinh->fetch_assoc()) {
        $tenTinh = $rowTinh["tenTinh"];
        if (!in_array($tenTinh, $tinhList)) {
            $tinhList[] = $tenTinh;
        }
    }
}

if (isset($_POST['selectedTinh'])) {
    $selectedTinh = $_POST['selectedTinh'];

    $sqlMaTinh = "SELECT maTinh FROM tinh WHERE tenTinh = '$selectedTinh'";
    $resultMaTinh = $conn->query($sqlMaTinh);

    if ($resultMaTinh->num_rows > 0) {
        $rowMaTinh = $resultMaTinh->fetch_assoc();
        $maTinh = $rowMaTinh['maTinh'];

        $sqlHuyen = "SELECT tenHuyen FROM huyen WHERE maTinh = '$maTinh'";
        $resultHuyen = $conn->query($sqlHuyen);

        $huyenList = array();
        if ($resultHuyen->num_rows > 0) {
            while ($rowHuyen = $resultHuyen->fetch_assoc()) {
                $huyenList[] = $rowHuyen["tenHuyen"];
            }

            $selectedHuyen = $_POST['selectedHuyen'];

            if (!empty($selectedHuyen)) {
                $sqlMaHuyen = "SELECT maHuyen FROM huyen WHERE tenHuyen = '$selectedHuyen' AND maTinh = '$maTinh'";
                $resultMaHuyen = $conn->query($sqlMaHuyen);

                if ($resultMaHuyen->num_rows > 0) {
                    $rowMaHuyen = $resultMaHuyen->fetch_assoc();
                    $maHuyen = $rowMaHuyen['maHuyen'];

                    $sqlXa = "SELECT tenXa FROM xa WHERE maHuyen = '$maHuyen'";
                    $resultXa = $conn->query($sqlXa);

                    $xaList = array();
                    if ($resultXa->num_rows > 0) {
                        while ($rowXa = $resultXa->fetch_assoc()) {
                            $xaList[] = $rowXa["tenXa"];
                        }
                    }
                    echo json_encode(array('huyenList' => $huyenList, 'xaList' => $xaList));
                }
            }
        }
    }
}


?>
<title>Đăng ký</title>
<div class="row justify-content-md-center mt-5 mb-5">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Đăng ký</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="DangKy_Check.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger">
                            <?php echo $_GET['error']; ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <p class="alert alert-success">
                            <?php echo $_GET['success']; ?>
                        </p>
                    <?php } ?>

                    <div class="form-group">
                        <label for="TENND">Tên người dùng</label>
                        <input type="text" class="form-control" name="TENND" id="TENND" value="<?php if (isset($_GET['TENND']))
                            echo $_GET['TENND'] ?>">
                            <small class="form-text text-muted">Chúng tôi sẽ không chia sẻ tài khoản của bạn cho bất kỳ ai
                                khác.</small>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="MATKHAU">Mật khẩu</label>
                                <input type="password" class="form-control" name="MATKHAU" id="MATKHAU">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="CONFIRM-MATKHAU">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" id="CONFIRM-MATKHAU" name="CONFIRM-MATKHAU">
                                <div id="password-error" class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="GIOITINH">Giới Tính</label>
                            <input type="text" class="form-control" name="GIOITINH" id="GIOITINH" value="<?php if (isset($_GET['GIOITINH']))
                            echo $_GET['GIOITINH'] ?>">
                            <!-- Validation message here -->
                        </div>
                        <div class="form-group">
                            <label for="SDT">Số điện thoại</label>
                            <input type="text" class="form-control" name="SDT" id="SDT" value="<?php if (isset($_GET['SDT']))
                            echo $_GET['SDT'] ?>">
                            <!-- Validation message here -->
                        </div>
                        <div class="form-group">
                            <label for="DIACHI">Địa chỉ</label>
                            <input type="text" class="form-control" name="DIACHI" id="DIACHI" value="<?php if (isset($_GET['DIACHI']))
                            echo $_GET['DIACHI'] ?>">
                            <!-- Validation message here -->
                        </div>

                        <div class="form-group">
                            <label for="EMAIL">Địa chỉ email</label>
                            <input type="email" class="form-control" name="EMAIL" id="EMAIL" value="<?php if (isset($_GET['EMAIL']))
                            echo $_GET['EMAIL'] ?>">
                            <!-- Validation message here -->
                        </div>
                        
                        <div class="form-group">
                            <label for="Tinh">Tỉnh</label>
                            <select class="form-control" id="selectTinh">
                                <option value="">-- Chọn Tỉnh --</option>
                                <?php foreach ($tinhList as $tinh): ?>
                                    <option value="<?php echo $tinh; ?>"><?php echo $tinh; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Huyen">Huyện</label>
                            <select class="form-control" id="selectHuyen">
                                <option value="">-- Chọn Huyện --</option>
                                <?php foreach ($huyenList as $huyen): ?>
                                    <option value="<?php echo $huyen; ?>"><?php echo $huyen; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Xa">Xã</label>
                            <select class="form-control" id="selectXa" name="tenXa">
                                <option value="">-- Chọn Xã --</option>
                                <?php foreach ($xaList as $xa): ?>
                                    <option  id="tenXa" value="<?php echo $xa; ?>"><?php echo $xa; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>  

                        <div class="form-group">
                            <input type="submit" value="Đăng ký" class="btn btn-primary btn-block" id="register-button">
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center mt-4" style="font-size:20px">Đã có tài khoản? <a href="DangNhap.php">Đăng nhập</a></p>
        </div>
    </div>


<script>
    $(document).ready(function() {
    // Sự kiện khi chọn tỉnh
    $("#selectTinh").change(function() {
        var selectedTinh = $(this).val();
        if (selectedTinh !== "") {
            $.ajax({
                url: "xuly.php",
                method: "POST",
                data: { selectedTinh: selectedTinh },
                dataType: "json",
                success: function(data) {
                    // Cập nhật danh sách huyện
                    $("#selectHuyen").html(data.huyenOptions);
                    // Xóa danh sách xã
                    $("#selectXa").html('<option value="">-- Chọn Xã --</option>');
                }
            });
        } else {
            // Nếu không chọn tỉnh, xóa danh sách huyện và xã
            $("#selectHuyen").html('<option value="">-- Chọn Huyện --</option>');
            $("#selectXa").html('<option value="">-- Chọn Xã --</option>');
        }
    });

    // Sự kiện khi chọn huyện
    $("#selectHuyen").change(function() {
        var selectedHuyen = $(this).val();
        if (selectedHuyen !== "") {
            $.ajax({
                url: "xuly.php",
                method: "POST",
                data: { selectedHuyen: selectedHuyen },
                dataType: "json",
                success: function(data) {
                    // Cập nhật danh sách xã
                    $("#selectXa").html(data.xaOptions);
                }
            });
        } else {
            // Nếu không chọn huyện, xóa danh sách xã
            $("#selectXa").html('<option value="">-- Chọn Xã --</option>');
        }
    });
});
</script>
<?php include '../Shared_Layout/footer.php' ?>