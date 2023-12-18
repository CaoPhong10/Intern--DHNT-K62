<?php
include("../../../header_admin.php");
include("../../../db_connect.php");
$maND = $_GET['maND'];
$sql_nguoidung = "SELECT EMAIL, TENND, GIOITINH, SDT, DIACHI, maXa FROM nguoidung WHERE MAND = '{$maND}'";
$kq_nguoidung = mysqli_query($conn, $sql_nguoidung);
$row_nguoidung = mysqli_fetch_assoc($kq_nguoidung);
$get_tinh = "SELECT `maTinh`, `tenTinh` FROM `tinh`";
$kq_tinh = mysqli_query($conn, $get_tinh);
$sql_diachi = "SELECT xa.maXa, xa.tenXa, huyen.maHuyen,huyen.tenHuyen, tinh.maTinh, tinh.tenTinh FROM nguoidung JOIN xa ON nguoidung.maXa=xa.maXa JOIN huyen ON xa.maHuyen=huyen.maHuyen JOIN tinh ON huyen.maTinh=tinh.maTinh WHERE nguoidung.MAND='{$maND}'";
$kq_diachi = mysqli_query($conn, $sql_diachi);
$row_diachi = mysqli_fetch_assoc($kq_diachi);
$get_huyen = "SELECT huyen.maHuyen, huyen.tenHuyen FROM huyen JOIN tinh ON huyen.maTinh = tinh.maTinh where huyen.maTinh ='{$row_diachi['maTinh']}'";
$kq_huyen = mysqli_query($conn, $get_huyen);
$get_xa = "SELECT xa.maXa, xa.tenXa FROM xa JOIN huyen ON xa.maHuyen = huyen.maHuyen WHERE xa.maHuyen ='{$row_diachi['maHuyen']}'";
$kq_xa = mysqli_query($conn, $get_xa);
?>
<div class="container">
        <h2>Chỉnh sửa thông tin người dùng</h2>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
                $(document).ready(function () {
                        function getDistricts(selectedProvince) {
                                jQuery.ajax({
                                        url: '../includes/get_register.php',
                                        type: 'POST',
                                        data: { province_id: selectedProvince },
                                        success: function (data) {
                                                $('#districts').html(data);
                                                $('#wards').html('<option value="">Chọn Xã</option>');
                                                $('#maXaInput').val('');
                                        }
                                });
                        }
                        function getWards(selectedDistrict) {
                                jQuery.ajax({
                                        url: '../includes/get_register.php',
                                        type: 'POST',
                                        data: { district_id: selectedDistrict },
                                        success: function (data) {
                                                $('#wards').html(data);
                                                // var selectedWard = $('#wards').val();
                                                // $('#maXaInput').val(selectedWard);
                                        }
                                });
                        }
                        $('#provinces').change(function () {
                                var selectedProvince = $(this).val();
                                getDistricts(selectedProvince);
                        });
                        $('#districts').change(function () {
                                var selectedDistrict = $(this).val();
                                getWards(selectedDistrict);
                        });
                        $('#wards').change(function () {
                                // Cập nhật giá trị của #maXaInput khi bạn thay đổi xã.
                                var selectedWard = $(this).val();
                                $('#maXaInput').val(selectedWard);
                        });

                        function getUsername(userName) {
                                jQuery.ajax({
                                        url: '../includes/get_register.php',
                                        type: 'POST',
                                        data: { userName: userName },
                                        success: function (data) {
                                                $('#userName_message').html(data);
                                        }
                                });
                        }
                        $('#userName').change(function () {
                                // cập nhật giá trị của #maXaInput khi thay đổi xã để gửi đi
                                var userName = $(this).val();
                                getUsername(userName);
                        });

                });


        </script>
        <form action="" method="POST" id="form-3">
                <div class="form-horizontal">

                        <div class="form-group">
                                <label>Họ và tên</label>
                                <input required type="text" name ="hoTen" class="form-control ml-2 textfile"
                                        value="<?php echo $row_nguoidung['TENND'] ?>" name="tenND" >
                                <span class="error_message"></span>
                        </div>
                        <div class="form-group">
                                <label>Số điện thoại</label>
                                <input required type="text" class="form-control ml-2 textfile" name="sdt" id=""
                                        value="<?php echo $row_nguoidung['SDT'] ?>">
                                <span class="error_message"></span>
                        </div>
                        <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control ml-2 textfile" name="EMAIL" id=""
                                        value="<?php echo $row_nguoidung['EMAIL'] ?>">
                                <span class="error_message"></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; width: 400px;">
                                <div class="form_field">
                                        <label for="" class="name_form_field">Tỉnh: </label>
                                        <select id='provinces' class="textfile" name="provinces" style="width: 195px;">
                                                <option value="<?php echo $row_diachi['maTinh']; ?>" disabled selected>
                                                        <?php echo $row_diachi['tenTinh']; ?>
                                                </option>
                                                <?php
                                                while ($row_tinh = mysqli_fetch_assoc($kq_tinh))
                                                        echo "<option value='{$row_tinh["maTinh"]}'>{$row_tinh["tenTinh"]}</option>";
                                                ?>
                                        </select>
                                        <span class="error_message"></span>
                                </div>
                                <div class="form_field">
                                        <label for="" class="name_form_field">Huyện: </label>
                                        <select id='districts' class="textfile" name="districts" style="width: 195px;">
                                                <option value="<?php echo $row_diachi['maHuyen'] ?>" disabled selected>
                                                        <?php echo $row_diachi['tenHuyen'] ?>
                                                </option>
                                                <?php
                                                while ($row_huyen = mysqli_fetch_assoc($kq_huyen))
                                                        echo "<option value='{$row_huyen["maHuyen"]}'>{$row_huyen["tenHuyen"]}</option>";
                                                ?>
                                        </select>
                                        <span class="error_message"></span>
                                </div>
                        </div>
                        <div style="display: flex; justify-content: space-between; width: 400px;">
                                <div class="form_field">
                                        <label for="" class="name_form_field">Xã: </label>
                                        <select required id="wards" class="textfile" style="width: 195px;">
                                                <option value="<?php echo $row_diachi['maXa'] ?>" disabled selected>
                                                        <?php echo $row_diachi['tenXa'] ?>
                                                </option>
                                                <?php
                                                while ($row_xa = mysqli_fetch_assoc($kq_xa))
                                                        echo "<option value='{$row_xa["maXa"]}'>{$row_xa["tenXa"]}</option>";
                                                ?>
                                        </select>
                                        <input hidden type="text" name="maXa" id="maXaInput"
                                                value="<?php echo $row_diachi['maXa'] ?>">
                                        <span class="error_message"></span>
                                </div>
                                <div class="form_field">
                                        <label for="" class="name_form_field">Địa chỉ cụ thể: </label>
                                        <input type="diaChi" class="textfile" id="diaChi" name="diachi"
                                                style="width: 195px;" required
                                                value="<?php echo $row_nguoidung['DIACHI'] ?>">
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                        <input type="submit" value="Chỉnh sửa" class="btn btn-success" name="edit" />
                                        <a href="javascript:history.go(-1);"><input type="button" value="Quay lại"
                                                        class="btn btn-success" name="Quay lại" /></a>
                                </div>
                        </div>
        </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "UPDATE nguoidung SET EMAIL = '{$_POST['EMAIL']}', TENND = '{$_POST['hoTen']}', SDT = '{$_POST['sdt']}',
        DIACHI = '{$_POST['diachi']}', maXa = '{$_POST['maXa']}' WHERE MAND = '$maND'";
        mysqli_query($conn, $sql);
        echo '<script>window.location.href = "../USERS";</script>'; 
    }
include("../../../footer_admin.php");
?>