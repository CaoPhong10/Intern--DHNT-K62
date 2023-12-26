<?php
include("../LOGIN_REQUIRED/LogIn_Required.php");
include("../../db_connect.php");

if (isset($_POST["saveChanges"])) {
    $tennd = $_POST["TENND"];
    $diachi = $_POST["DIACHI"];
    $sdt = $_POST["SDT"];
    $gioitinh = $_POST["GIOITINH"];
    $tenxa = $_POST["tenXa"];
    $tennd_error = $diachi_error = $sdt_error = $tenxa_error = $email_error = "";
    $error_check = false;
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    $tennd = validate($_POST['TENND']);
    $gioitinh = validate($_POST['GIOITINH']);
    $sdt = validate($_POST['SDT']);
    $diachi = validate($_POST['DIACHI']);
    $email = validate($_POST['EMAIL']);
    $tenXa = validate($_POST['tenXa']);

    if (empty($tennd)) {
        $tennd_error = "tennd_error=Tên không được để trống";
        $error_check = true;
    }
    if (empty($diachi)) {
        $diachi_error = "diachi_error=Địa chỉ không được để trống";
        $error_check = true;
    }
    if (empty($sdt)) {
        $sdt_error = "sdt_error=Số điện thoại không được để trống";
        $error_check = true;
    }
    if (empty($tenxa)) {
        $tenxa_error = "tenxa_error=Tên xã không được để trống";
        $error_check = true;
    }
    
    if ($error_check) {
        $error_query = $tennd_error . "&" . $diachi_error . "&" . $sdt_error . "&" . $tenxa_error . "&" . $email_error;
        header("Location: CaiDatThongTin.php?" . $error_query);
        exit();
    } else {
        $sql2 = "SELECT maXa FROM xa WHERE tenXa='$tenxa'";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) == 0) {
            header("Location: CaiDatThongTin.php?error=Tên xã không tồn tại");
            exit();
        } else {
            $row = mysqli_fetch_assoc($result2);
            $maXa = $row['maXa'];

            $mand = $_SESSION['MAND'];
            $update_query = "UPDATE nguoidung SET TENND = '$tennd', DIACHI = '$diachi', SDT = '$sdt', GIOITINH = '$gioitinh', maXa = '$maXa' WHERE MAND = '$mand'";
            if (mysqli_query($conn, $update_query)) {
                // Cập nhật thành công
                header("Location: CaiDatThongTin.php?success=true");
                exit();
            } else {
                // Lỗi khi cập nhật
                header("Location: CaiDatThongTin.php?error=true");
                exit();
            }
        }
    }
}
?>