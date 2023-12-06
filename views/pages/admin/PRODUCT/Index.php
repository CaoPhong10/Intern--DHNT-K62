<?php
require("../../../db_connect.php");
include("../../../header_admin.php");

if (isset($_GET['search'])) {
    if (isset($_GET['input'])) {
        $input = $_GET['input'];
    } else {
        $input = '';
    }

    $sql = "SELECT MASP, TENSP, DONGIA, SOLUONG, TENLOAISP, TENTHUONGHIEU , ANH
            FROM (sanpham 
                JOIN loaisanpham ON sanpham.MALOAISP = loaisanpham.MALOAISP) 
                JOIN thuonghieu ON thuonghieu.MATH = sanpham.MATH 
            WHERE TENSP LIKE '%$input%'               
                OR DONGIA = '$input' 
                OR TENTHUONGHIEU LIKE '%$input%'               
            ORDER BY sanpham.MASP ASC";
} else {
    $input = '';
    $sql = "SELECT MASP, TENSP, DONGIA, SOLUONG, TENLOAISP, TENTHUONGHIEU , ANH 
            FROM (sanpham 
                JOIN loaisanpham ON sanpham.MALOAISP = loaisanpham.MALOAISP) 
                JOIN thuonghieu ON thuonghieu.MATH = sanpham.MATH 
            ORDER BY sanpham.MASP ASC";
}

$result = mysqli_query($conn, $sql);
$rowsPerPage = 10; //số mẩu tin trên mỗi trang

if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}

//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset = ($_GET['page'] - 1) * $rowsPerPage;

//lấy $rowsPerPage mẩu tin, bắt đầu từ vị trí $offset
$list = mysqli_fetch_all($result, MYSQLI_NUM);
?>

<div class="container">
    <h2 style="text-align:center">Danh sách sản phẩm</h2>

    <div class="d-flex justify-content-between">
        <a href="Create.php" class="btn btn-primary m-2">Tạo mới</a>
        <form action="" method="get">
            <input type="text" name="input" value="<?php echo isset($_GET['input']) ? $_GET['input'] : ''; ?>" placeholder="Tìm kiếm">
            <input type="submit" value="Tìm" name="search" class="btn btn-primary">
        </form>
    </div>
    <table class="table">
        <form action="" method="post">
            <!-- Code để sắp xếp -->
            <tr align = "center">
                <th>
                    Mã sản phẩm
                </th>
                <th>
                    Tên sản phẩm
                </th>
                <th>
                    Đơn giá
                </th>
                <th>
                    Số lượng
                </th>
                <th>
                    Loại sản phẩm
                </th>
                <th>
                    Thương hiệu
                </th>
                <th>
                    Ảnh
                </th>
                <th>
                    Chức năng
                </th>
            </tr>
        </form>

        <?php
        for ($i = 0; $i < $rowsPerPage; $i++) {
            if ($offset + $i == count($list)) break;
            $row = $list[$offset + $i];
        ?>
            <tr align = "center">
                <td>
                    <?php echo $row[0] ?>
                </td>
                <td>
                    <?php echo $row[1] ?>
                </td>
                <td>
                    <?php echo $row[2] ?>
                </td>
                <td>
                    <?php echo $row[3] ?>
                </td>
            
                <td>
                    <?php echo $row[4] ?>
                </td>
                <td>
                    <?php echo $row[5] ?>
                </td>
                <td style="width: 10%;">
                <img class="" style="max-width: 100%; height: auto;" src="<?php $anh = $row[6]; echo "../../../Images/" . $anh ?>">
            </td>

                <td style="min-width: 120px;">
                    <a href="./Edit.php?maSP=<?php echo $row[0] ?>">
                        <img src="../../../Images/edit.png" alt="Edit" class="icon" width="30px">
                    </a>
                    <a href="./Details.php?maSP=<?php echo $row[0] ?>">
                        <img src="../../../Images/details.png" alt="Detail" class="icon" width="30px">
                    </a>
                    <a href="./Delete.php?maSP=<?php echo $row[0] ?>">
                        <img src="../../../Images/delete.png" alt="Delete" class="icon" width="30px">
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div style="display: flex; width: 100%;">
        <?php
        $numRows = count($list);
        // gắn thêm nút back
        if ($_GET['page'] > 1)
            echo "<a class='btn btn-primary' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "&input=" . $input . "'>Back</a> ";
        else
            echo "<button class='btn btn-default' disabled>Back</button>";
        //Trang đầu
        echo "<a class=' btn btn-primary' href='"
            . $_SERVER['PHP_SELF'] . "?page=" . "1" . "&input=" . $input . "'>Trang đầu" . "</a> ";
        //tổng số trang
        $maxPage = ($numRows % $rowsPerPage) ? floor($numRows / $rowsPerPage) + 1 : floor($numRows / $rowsPerPage);
        $delta = 3; // số lượng trang hiển thị 2 bên
        echo "<div style = 'display: flex ; justify-content: center; align-items: center; flex-grow: 1;'>";
        if ($maxPage < 10) {
            for ($i = 1; $i <= $maxPage; $i++) //tạo link tương ứng tới các trang
            {
                if ($i == $_GET['page'])
                    echo '<b class="btn btn-default" >Trang ' . $i . '</b> '; //trang hiện tại
                else
                    echo "<a class=' btn btn-primary' href='"
                        . $_SERVER['PHP_SELF'] . "?page=" . $i . "&input=" . $input . "'>" . $i . "</a> ";
            }
        } else {
            for ($i = $_GET['page'] - $delta; $i <= $_GET['page'] + $delta; $i++) //tạo link tương ứng tới các trang
            {
                if ($i == $_GET['page'])
                    echo '<b class="btn btn-default w-40" >Trang ' . $i . '</b> '; //trang hiện tại
                else if ($i > 0 && $i <= $maxPage)
                    echo "<a class=' btn btn-primary w-40' href='"
                        . $_SERVER['PHP_SELF'] . "?page=" . $i . "&input=" . $input . "'>" . $i . "</a> ";
            }
        }
        echo "</div>";
        // Trang cuối
        echo "<a class=' btn btn-primary' href='"
            . $_SERVER['PHP_SELF'] . "?page=" . $maxPage . "&input=" . $input . "'>Trang cuối" . "</a> ";
        //gắn thêm nút Next
        if ($_GET['page'] < $maxPage)
            echo "<a class='btn btn-primary' href='" . $_SERVER['PHP_SELF'] . "?page="
                . ($_GET['page'] + 1) . "&input=" . $input . "'>Next</a>";
        else
            echo "<button class='btn btn-default' disabled>Next</button>";
        ?>
    </div>
</div>

<?php
include("../../../footer_admin.php");
?>