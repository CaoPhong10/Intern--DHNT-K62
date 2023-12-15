<?php
include("../../../header_admin.php");
require("../../../db_connect.php");

$maTH = $_GET['maTH'];
$sql = "SELECT * FROM thuonghieu
WHERE thuonghieu.MATH = '$maTH'";
$result = mysqlI_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["xoa"])) {
        $sql = "DELETE FROM thuonghieu WHERE MATH = '$maTH'";
        $result = mysqli_query($conn, $sql);
        echo "
        <div class='alert alert-success alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-check'></i> Thành công!</h4>
            Xoá thành công
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'Index.php';
            }, 2000); // Chuyển hướng sau 2 giây
        </script>
        ";
       
    } 

?>

<h2 style="text-align:center">Xóa sản phẩm</h2>


<div class="container">
        <h3>Bạn có chắc muốn xóa?</h3>
        <hr />

        <dl class="dl-horizontal">
                <dt>
                        Tên sản phẩm
                </dt>

                <dd>
                        <?php
                        echo $row['TENTHUONGHIEU'];
                        ?>
                </dd>

                <dt>
                        Quốc gia
                </dt>

                <dd>
                        <?php
                        echo $row['QUOCGIA'];
                        ?>
                </dd>

        </dl>


        <form action="" method="post">
                <div class="form-actions no-color">
                        <input type="submit" value="Xóa" name="xoa" class="btn btn-danger" /> |
                        <a href="./Index.php" class="btn btn-primary"   >Trở về trang danh sách</a>
                </div>
        </form>
</div>
<?php
include("../../../footer_admin.php");
?>