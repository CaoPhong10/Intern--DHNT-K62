<?php
include("../../db_connect.php");

// Lấy danh sách tỉnh
$sqlTinh = "SELECT DISTINCT tenTinh FROM tinh";
$resultTinh = $conn->query($sqlTinh);

$tinhList = array();
while ($rowTinh = $resultTinh->fetch_assoc()) {
    $tinhList[] = $rowTinh['tenTinh'];
}

if (isset($_POST['selectedTinh'])) {
    $selectedTinh = $_POST['selectedTinh'];

    // Lấy mã tỉnh
    $sqlMaTinh = "SELECT maTinh FROM tinh WHERE tenTinh = '$selectedTinh'";
    $resultMaTinh = $conn->query($sqlMaTinh);
    $rowMaTinh = $resultMaTinh->fetch_assoc();
    $maTinh = $rowMaTinh['maTinh'];

    // Lấy danh sách huyện
    $sqlHuyen = "SELECT DISTINCT tenHuyen FROM huyen WHERE maTinh = '$maTinh'";
    $resultHuyen = $conn->query($sqlHuyen);

    $huyenOptions = '<option value="">-- Chọn Huyện --</option>';
    while ($rowHuyen = $resultHuyen->fetch_assoc()) {
        $huyenOptions .= '<option value="' . $rowHuyen['tenHuyen'] . '">' . $rowHuyen['tenHuyen'] . '</option>';
    }

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode(['huyenOptions' => $huyenOptions]);
} else if (isset($_POST['selectedHuyen'])) {
    $selectedHuyen = $_POST['selectedHuyen'];

    // Lấy mã huyện
    $sqlMaHuyen = "SELECT maHuyen FROM huyen WHERE tenHuyen = '$selectedHuyen'";
    $resultMaHuyen = $conn->query($sqlMaHuyen);
    $rowMaHuyen = $resultMaHuyen->fetch_assoc();
    $maHuyen = $rowMaHuyen['maHuyen'];

    // Lấy danh sách xã
    $sqlXa ="SELECT DISTINCT tenXa FROM xa WHERE maHuyen = '$maHuyen'";
    $resultXa = $conn->query($sqlXa);

    $xaOptions = '<option value="">-- Chọn Xã --</option>';
    while ($rowXa = $resultXa->fetch_assoc()) {
        $xaOptions .= '<option value="' . $rowXa['tenXa'] . '">' . $rowXa['tenXa'] . '</option>';
    }

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode(['xaOptions' => $xaOptions]);
}

$conn->close();
?>