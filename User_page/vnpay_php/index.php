<?php
session_start();

if (isset($_SESSION['tongtien'])) {
    $tongtien = $_SESSION['tongtien'];
} else {
    $tongtien = 0; // Giá trị mặc định nếu không có giá trị trong session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">  
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
    <style>
        .table-responsive{
            width: 100px;
        }
    </style>
</head>

<body>
    <?php 
    require_once("./config.php"); 
    include("../LOGIN_REQUIRED/LogIn_Required.php"); 
    include '../Shared_Layout/header.php';
    ?>   
                
    <div class="container" style="align-center">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY</h3>
        </div>
        <h3>Tạo hóa đơn</h3>
        <div class="col-md-4">
            <form action="vnpay_create_payment.php" id="create_form" method="post">       

                <div class="form-group">
                    <label for="language">Loại hàng hóa </label>
                    <select name="order_type" id="order_type" class="form-control">
                        <option value="billpayment">Thanh toán hóa đơn</option>
                        <option value="topup">Nạp tiền điện thoại</option>
                        <option value="fashion">Thời trang</option>
                        <option value="other">Khác - Xem thêm tại VNPAY</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="order_id">Mã hóa đơn</label>
                    <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="amount">Số tiền</label>
                    <input class="form-control" id="amount" name="amount" type="number" value="<?php echo $tongtien ?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="order_desc">Nội dung thanh toán</label>
                    <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Noi dung thanh toan</textarea>
                </div>
                <div class="form-group">
                    <label for="bank_code">Ngân hàng</label>
                    <select name="bank_code" id="bank_code" class="form-control">
                        <option value="">Không chọn</option>
                        <option value="NCB"> Ngân hàng NCB</option>
                        <option value="AGRIBANK"> Ngân hàng Agribank</option>
                        <option value="SCB"> Ngân hàng SCB</option>
                        <option value="SACOMBANK">Ngân hàng SacomBank</option>
                        <option value="EXIMBANK"> Ngân hàng EximBank</option>
                        <option value="MSBANK"> Ngân hàng MSBANK</option>
                        <option value="NAMABANK"> Ngân hàng NamABank</option>
                        <option value="VNMART"> Vi dien tu VnMart</option>
                        <option value="VIETINBANK">Ngân hàng Vietinbank</option>
                        <option value="VIETCOMBANK"> Ngân hàng VCB</option>
                        <option value="HDBANK">Ngân hàng HDBank</option>
                        <option value="DONGABANK"> Ngân hàng Dong A</option>
                        <option value="TPBANK"> Ngân hàng TPBank</option>
                        <option value="OJB"> Ngân hàng OceanBank</option>
                        <option value="BIDV"> Ngân hàng BIDV</option>
                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                        <option value="VPBANK"> Ngân hàng VPBank</option>
                        <option value="MBBANK"> Ngân hàng MBBank</option>
                        <option value="ACB"> Ngân hàng ACB</option>
                        <option value="OCB"> Ngân hàng OCB</option>
                        <option value="IVB"> Ngân hàng IVB</option>
                        <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="language">Ngôn ngữ</label>
                    <select name="language" id="language" class="form-control">
                        <option value="vn">Tiếng Việt</option>
                        <option value="en">English</option>
                    </select>
                </div>
                <div class="form-group">
                    <label >Thời hạn thanh toán</label>
                    <input class="form-control" id="txtexpire"
                            name="txtexpire" type="text" value="<?php echo $expire; ?>" readonly/>
                </div>
                <button type="submit" name="redirect" id="redirect" class="btn btn-primary">Thanh toán</button>

            </form>
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
