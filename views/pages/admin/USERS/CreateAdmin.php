<?php
include("../../../header_admin.php");
include("../../../db_connect.php");
$sql = "SELECT MAND from nguoidung WHERE NOT ISADMIN = 0 ORDER BY MAND DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$maND = (int) substr($row['MAND'], 2);
$maND = $maND + 1;
$maND = "AD" . str_pad($maND, 2, "0", STR_PAD_LEFT);
$get_tinh = "SELECT `maTinh`, `tenTinh` FROM `tinh`";
$kq_tinh = mysqli_query($conn, $get_tinh);

?>
<div class="container">
        <h2>Tạo tài khoản quản trị viên</h2>
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
                        function getUsername(userNameAdmin) {
                                jQuery.ajax({
                                        url: '../includes/get_register.php',
                                        type: 'POST',
                                        data: { userNameAdmin: userNameAdmin },
                                        success: function (data) {
                                                $('#userName_message').html(data);
                                                updateRegisterButtonState();
                                        }
                                });
                        }
                        function updateRegisterButtonState() {
                                var userNameMessage = $('#userName_message').text();
                                // Kiểm tra nếu tên đăng nhập đã tồn tại thì không cho bấm đăng ký
                                $('#registerButton').prop('disabled', userNameMessage != "");
                        }

                        $('#userName').on('input', function () {
                                var userNameValue = $(this).val();
                                userNameValue = userNameValue.replace(/[^A-Za-z0-9_]/g, '');
                                $(this).val(userNameValue);

                                // Cập nhật thông tin từ server khi người dùng nhập liệu
                                getUsername(userNameValue);
                        });
                });
        </script>
        <form action="" method="POST">
                <div class="form-horizontal CreateAdmin">
                        <div class="form-group">
                                <label>Mã nhân viên</label>
                                <input type="text" name="manv" class="form-control ml-2 textfile"
                                        value="<?php echo $maND ?>" disabled>
                        </div>
                        <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control ml-2 textfile">
                                <label for="" class="name_form_field">Mật khẩu mặc định admin123 </label>
                                <input hidden class="textfile" type="password" id="password" name="matKhau" value="admin159"
                                        style="width: 400px;">
                                <span class="error_message"></span>
                        </div>
                        <div class="form-group">
                                <label>Loại nhân viên</label>
                                <select name="loainv" id="" class="form-control ml-2 textfile">
                                        <option value="" disabled selected>Chọn loại</option>
                                        <option value=1>Quản lý</option>
                                        <option value=2>Nhân viên bán hàng</option>
                                </select>
                                <span class="error_message"></span>
                        </div>
                        <div class="form-group">
                                <label>Họ và tên</label>
                                <input type="text" name="tennv" class="form-control ml-2 textfile">
                        </div>
                        <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="sdt" class="form-control ml-2 textfile">
                        </div>
                        <div class="form-group">
                                <label>Giới tính</label>
                                <select name="gioitinh" id="" class="textfile">
                                        <option selected disabled value="">Chọn giới tính</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                </select>
                        </div>
                        <div style="display: flex; justify-content: space-between; width: 400px;">
                                <div class="form_field">
                                        <label for="" class="name_form_field">Tỉnh: </label>
                                        <select id='provinces' class="textfile" name="provinces" style="width: 195px;">
                                                <option value="" disabled selected>Chọn tỉnh/Thành phố</option>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($kq_tinh))
                                                        echo "<option value='{$row['maTinh']}'>{$row['tenTinh']}</option>";
                                                ?>
                                        </select>
                                        <span class="error_message"></span>
                                </div>
                                <div class="form_field">
                                        <label for="" class="name_form_field">Huyện: </label>
                                        <select id='districts' class="textfile" name="districts" style="width: 195px;">
                                                <option disabled selected value="">Chọn Huyện</option>
                                        </select>
                                        <span class="error_message"></span>
                                </div>
                        </div>
                        <div style="display: flex; justify-content: space-between; width: 400px;">

                                <div class="form_field">
                                        <label for="" class="name_form_field">Xã: </label>
                                        <select required id="wards" class="textfile" style="width: 195px;">
                                                <option value="">Chọn Xã</option>
                                        </select>
                                        <input hidden type="text" name="maXa" id="maXaInput">
                                        <span class="error_message"></span>
                                </div>
                                <div class="form_field">
                                        <label for="" class="name_form_field">Địa chỉ cụ thể: </label>
                                        <input type="diaChi" class="textfile" id="diaChi" name="diaChi"
                                                style="width: 195px;" required>
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                        <input type="submit" value="Thêm" class="btn btn-success" name="create" />
                                        <a href="javascript:history.go(-1);"><input type="button" value="Quay lại"
                                                        class="btn btn-success" name="Quay lại" /></a>
                                </div>
                        </div>
        </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "INSERT INTO nguoidung VALUES ('$maND', '{$_POST['email']}', '{$_POST['matKhau']}', '{$_POST['tennv']}'
        , '{$_POST['gioitinh']}', '{$_POST['sdt']}', '{$_POST['diaChi']}', '{$_POST['loainv']}', '{$_POST['maXa']}')";
        mysqli_query($conn, $sql);
        echo '<script>window.location.href = "../USERS/ds_admin.php";</script>';
}
include("../../../footer_admin.php");
?>