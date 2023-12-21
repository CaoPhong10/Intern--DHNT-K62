<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>VNPAY RESPONSE</title>
        <!-- Bootstrap core CSS -->
        <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">         
        <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
    </head>
    <body>
    <?php 
        require_once("./config.php"); 
        include("../LOGIN_REQUIRED/LogIn_Required.php"); 
        include '../Shared_Layout/header.php';       
        include("../../db_connect.php");
        function LayMaHoaDon($db) {
            // Lấy danh sách các MAND từ bảng HOADON
            $query = "SELECT MAHOADON FROM hoadon";
            $result = mysqli_query($db, $query);
        
            // Lấy MAHOADON lớn nhất
            $maMax = '';
            while ($row = mysqli_fetch_assoc($result)) {
                $maHD = $row['MAHOADON'];
                if ($maHD > $maMax) {
                    $maMax = $maHD;
                }
            }
        
            // Tạo mã ND mới
            $maHD = intval(substr($maMax, 2)) + 1;
            $HD = str_pad($maHD, 4, '0', STR_PAD_LEFT);
            return 'HD' . $HD;
        }
        $mahd = LayMaHoaDon($conn);
        
        //Thêm vào bảng hóa đơn
        mysqli_query($conn,"INSERT INTO `hoadon` (`MAHOADON`, `MAND`, `NGAYTAO`, `TINHTRANGDONHANG`) 
        VALUES ('$mahd', '{$_SESSION['MAND']}', NOW(), 'Đang xử lý');");
        
        
        $selectedProducts = $_SESSION['selectedProducts'];
        //Thêm từng chi tiết hóa đơn
        foreach ($selectedProducts as $product) {
            $masp = $product['MASP'];
            $soluong = $product['SOLUONG'];
            
            // Lấy số lượng sản phẩm hiện tại trong bảng SANPHAM
            $soluonghientai_query = mysqli_query($conn,"SELECT SOLUONG FROM sanpham WHERE MASP = '$masp' LIMIT 1");
            $row = mysqli_fetch_assoc($soluonghientai_query);
            $soluonghientai = $row['SOLUONG'];
            
            // Kiểm tra tình trạng đơn hàng
            $tinhtrangdonhang_query = mysqli_query($conn,"SELECT TINHTRANGDONHANG FROM hoadon WHERE MAHOADON = '$mahd' LIMIT 1");
            $row = mysqli_fetch_assoc($tinhtrangdonhang_query);
            $tinhtrangdonhang = $row['TINHTRANGDONHANG'];
            
            // Nếu tình trạng đơn hàng là "Đã giao thành công" thì trừ số lượng sản phẩm
            if ($tinhtrangdonhang == "Đang giao hàng" || $tinhtrangdonhang == "Đang xử lý" || $tinhtrangdonhang == "Giao hàng thành công") {
                $soluongmoi = $soluonghientai - $soluong;
                
                // Cập nhật số lượng sản phẩm trong bảng SANPHAM
                mysqli_query($conn,"UPDATE sanpham SET SOLUONG = $soluongmoi WHERE MASP = '$masp'");
            }
            else if($tinhtrangdonhang == "Giao hàng thất bại"){
                $soluongmoi = $soluonghientai;
                // Cập nhật số lượng sản phẩm trong bảng SANPHAM
                mysqli_query($conn,"UPDATE sanpham SET SOLUONG = $soluongmoi WHERE MASP = '$masp'");
                }
            
            // Thêm chi tiết hóa đơn vào bảng chitiethoadon
            $dongiaxuat_query = mysqli_query($conn,"SELECT DONGIA FROM giohang WHERE MASP = '$masp' AND MAND = '{$_SESSION['MAND']}' LIMIT 1");
            $row = mysqli_fetch_assoc($dongiaxuat_query);
            $dongia = $row['DONGIA'];
            mysqli_query($conn,"INSERT INTO `chitiethoadon` (`MAHOADON`, `MASP`, `SOLUONG`, `DONGIAXUAT`) 
        VALUES ('$mahd', '$masp', $soluong,  $dongia)");
        }
      
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        ?>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY RESPONSE</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?php echo $_GET['vnp_Amount'] ?></label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label>Kết quả:</label>
                    <label>
                        <?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "<span style='color:blue'>GD Thanh cong</span>";
                            } else {
                                echo "<span style='color:red'>GD Khong thanh cong</span>";
                            }
                        } else {
                            echo "<span style='color:red'>Chu ky khong hop le</span>";
                        }
                        ?>

                    </label>
                </div> 
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                   <p>&copy; VNPAY <?php echo date('Y')?></p>
            </footer>
        </div>  
    </body>
</html>