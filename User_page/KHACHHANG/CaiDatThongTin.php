<?php
include("../LOGIN_REQUIRED/LogIn_Required.php"); 
include '../Shared_Layout/header.php';


$result = mysqli_query($conn, "SELECT nguoidung.*, xa.tenXa, huyen.tenHuyen, tinh.tenTinh FROM nguoidung 
    JOIN xa ON nguoidung.maXA = xa.maXa
    JOIN huyen ON xa.maHuyen = huyen.maHuyen
    JOIN tinh ON huyen.maTinh = tinh.maTinh
    WHERE nguoidung.MAND = '{$_SESSION['MAND']}'");
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

                    $sqlXa = "SELECT tenXa, maXa FROM xa WHERE maHuyen = '$maHuyen'";
                    $resultXa = $conn->query($sqlXa);

                    $xaList = array();
                    if ($resultXa->num_rows > 0) {
                        while ($rowXa = $resultXa->fetch_assoc()) {
                            $maXa = $rowXa["maXa"];
                            $tenXa = $rowXa["tenXa"];
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


<title>Cài đặt thông tin</title>

<section class="section-pagetop bg-gray">
    <div class="container">
        <h2 class="title-page">Tài khoản của tôi</h2>
    </div> <!-- container //  -->
</section>


<section class="section-content padding-y">
    <div class="container">
        <div class="row">
            <aside class="col-md-3">
                <nav class="list-group">
                    <a class="list-group-item " href="Detail.php"> Thông tin chung </a>
                    <a class="list-group-item" href="DonDatHang.php"> Đơn hàng </a>
                    <a class="list-group-item active" href="CaiDatThongTin.php">Cài đặt thông tin</a>
                </nav>
            </aside> <!-- col.// -->
            <?php if (mysqli_num_rows($result) != 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <main class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="CapNhatThongTin.php" class="row">
                                    <div class="col-md-9">
                                        <div class="form-row">
                                            <div class="col form-group display-flex">
                                                <div class="d-flex justify-content-between">
                                                    <label>Họ và tên</label>
                                                    <small class="text-danger">
                                                        <?php if (isset($_GET['tennd_error']))
                                                            echo $_GET['tennd_error'] ?>
                                                        </small>
                                                </div>
                                                    <div>
                                                        <input type="text" class="form-control" name="TENND" id="TENND" value="<?php if (isset($row['TENND']))
                                                            echo $row['TENND'] ?>">
                                                    </div>
                                                </div>

                                                <div class="col form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Giới tính</label>
                                                        <small class="text-danger">
                                                            <?php if (isset($_GET['gioitinh_error'])) echo $_GET['gioitinh_error'] ?>
                                                        </small>
                                                    </div>
                                                    <div>
                                                        <select class="form-control" name="GIOITINH" id="GIOITINH">
                                                            <option value="">-- Chọn giới tính --</option>
                                                            <option value="Nam" <?php if (isset($row['GIOITINH']) && $row['GIOITINH'] == 'Nam') echo 'selected' ?>>Nam</option>
                                                            <option value="Nữ" <?php if (isset($row['GIOITINH']) && $row['GIOITINH'] == 'Nữ') echo 'selected' ?>>Nữ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Số điện thoại</label></label>
                                                        <small class="text-danger">
                                                            <?php if (isset($_GET['sdt_error']))
                                                            echo $_GET['sdt_error'] ?>
                                                        </small>
                                                    </div>
                                                    <div>
                                                        <input type="text" class="form-control" name="SDT" id="SDT" value="<?php if (isset($row['SDT']))
                                                            echo $row['SDT'] ?>">

                                                    </div>
                                                </div>
                                                <div class="col form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Địa chỉ</label>
                                                        <small class="text-danger">
                                                        <?php if (isset($_GET['diachi_error']))
                                                            echo $_GET['diachi_error'] ?>
                                                        </small>
                                                    </div>
                                                    <div>
                                                        <input type="text" class="form-control" name="DIACHI" id="DIACHI" value="<?php if (isset($row['DIACHI']))
                                                            echo $row['DIACHI'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Tỉnh</label></label>
                                                        <small class="text-danger">
                                                            <?php if (isset($_GET['tinh_error']))echo $_GET['tinh_error'] ?>
                                                        </small>
                                                    </div>
                                                    <div>
                                                    <select class="form-control" id="selectTinh">
                                                        <option value=""><?php if (isset($row['tenTinh']))echo $row['tenTinh'] ?></option>
                                                        <?php foreach ($tinhList as $tinh): ?>
                                                            <option value="<?php echo $tinh; ?>"><?php echo $tinh; ?></option>
                                                            <?php endforeach ?>
                                                    </select> 
                                                    </div>
                                                </div>
                                                <div class="col form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Huyện</label>
                                                        <small class="text-danger">
                                                        <?php if (isset($_GET['huyen_error']))echo $_GET['huyen_error'] ?>
                                                        </small>
                                                    </div>
                                                    <div>
                                                    <select class="form-control" id="selectHuyen">
                                                        <option value=""><?php if (isset($row['tenHuyen']))echo $row['tenHuyen'] ?></option>
                                                        <?php foreach ($huyenList as $huyen): ?>
                                                            <option value="<?php echo $huyen; ?>"><?php echo $huyen; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">  
                                                 <div class="col form-group">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Xã</label></label>
                                                        <small class="text-danger">
                                                            <?php if (isset($_GET['xa_error']))
                                                            echo $_GET['xa_error'] ?>
                                                        </small>
                                                    </div>
                                                    <div>
                                                    <select class="form-control" id="selectXa" name="tenXa">
                                                        <option value=""><?php if (isset($row['tenXa']))echo $row['tenXa'] ?></option>
                                                        <?php foreach ($xaList as $xa): ?>
                                                            <option  id="tenXa" value="<?php echo $xa; ?>"><?php echo $xa; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    </div>
                                                </div>                                          
                                                <div class="col form-group">
                                                    <label>Email đăng nhập</label>
                                                    <div>
                                                        <input disabled type="text" class="form-control" name="EMAIL"
                                                            id="EMAIL" value="<?php if (isset($row['EMAIL']))
                                                            echo $row['EMAIL'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <input type="submit" value="Lưu" name="saveChanges"
                                                        class="btn btn-primary mr-2" id="save_info" />
                                                        <a href="DoiMatKhau.php" class="btn btn-light">Đổi mật khẩu</a>
                                                </div>
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </main> <!-- col.// --> <!-- col.// -->
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

</section>

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

<?php
include '../Shared_Layout/footer.php';
?>

