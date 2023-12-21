<?php
require("../../../db_connect.php");
include("../../../header_admin.php");
?>



<div class="pl-4 pt-4 pb">
        <h1 style="text-align:center">Tính toán số sản phẩm bán được theo loại</h1>

        <div style="display:flex;justify-content:center">
                <form action="" method="post" class="form-inline" autocomplete="off">
                        <div class="form-group">
                                <label for="startDate" class="mr-2">Ngày bắt đầu:</label>
                                <div class="input-group">
                                        <div class="datepicker-container">
                                                <input id="ngayBatDau" name="ngayBatDau" type="date"
                                                        class="form-control datepicker" autocomplete="off"
                                                        required="required"
                                                        value="<?php echo (isset($_POST['ngayBatDau'])) ? $_POST['ngayBatDau'] : "" ?>">
                                        </div>
                                </div>
                        </div>
                        <div class="form-group ml-4">
                                <label for="endDate" class="mr-2">Ngày kết thúc:</label>
                                <div class="input-group">
                                        <div class="datepicker-container">
                                                <input id="ngayKetThuc" name="ngayKetThuc" type="date"
                                                        class="form-control datepicker" autocomplete="off"
                                                        required="required"
                                                        value="<?php echo (isset($_POST['ngayKetThuc'])) ? $_POST['ngayKetThuc'] : "" ?>">
                                        </div>
                                </div>
                        </div>
                        <div class="form-group">
                                <?php
                                $sql_sp = "SELECT MALOAISP, TENLOAISP FROM loaisanpham";
                                $result_sp = mysqli_query($conn, $sql_sp);
                                ?>
                                <label for="loaiSanPham" class="mr-2">Loại sản phẩm:</label>
                                <select id="loaisp" name="loaisp" class="form-control">
                                        <option value="">-- Chọn loại sản phẩm --</option>
                                        <?php
                                        while ($row_sp = mysqli_fetch_assoc($result_sp)) {
                                                ?>
                                                <option value="<?php echo $row_sp['MALOAISP'] ?>">
                                                        <?php echo $row_sp['TENLOAISP'] ?>
                                                </option>
                                                <?php
                                        }
                                        ?>
                                </select>
                        </div>

                        <button type="submit" class="btn btn-primary ml-4" name="tinhtoan">Tính toán</button>
                </form>

        </div>

        <?php
        if (isset($_POST['tinhtoan'])) {
            $sql_tt = "SELECT sanpham.TENSP, chitiethoadon.SOLUONG AS TONGSOLUONG , chitiethoadon.SOLUONG * chitiethoadon.DONGIAXUAT AS TONGBANDUOC
                       FROM ((hoadon JOIN chitiethoadon ON hoadon.MAHOADON = chitiethoadon.MAHOADON)
                       JOIN sanpham ON chitiethoadon.MASP = sanpham.MASP)
                       JOIN loaisanpham ON sanpham.MALOAISP = loaisanpham.MALOAISP
                       WHERE (sanpham.MALOAISP = '" . $_POST["loaisp"] . "') 
                       AND (NGAYTAO <= '" . $_POST['ngayKetThuc'] . "') 
                       AND (NGAYTAO >= '" . $_POST['ngayBatDau'] . "') 
                       AND hoadon.TINHTRANGDONHANG = 'Giao hàng thành công'
                       GROUP BY sanpham.TENSP
                       ORDER BY TONGBANDUOC DESC";  // Thêm mệnh đề ORDER BY để sắp xếp giảm dần
        
            $result_tt = mysqli_query($conn, $sql_tt);
            ?>
            <table class="table table-striped mt-2">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng bán được</th>
                        <th>Tổng tiền bán được</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Duyệt qua tất cả các dòng kết quả
                    while ($row = mysqli_fetch_assoc($result_tt)) {
                    ?>
                        <tr>
                            <td><?php echo $row['TENSP'] ?></td>
                            <td><?php echo $row['TONGSOLUONG'] ?></td>
                            <td><?php echo number_format($row['TONGBANDUOC']) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>

</div>
<?php
include("../../../footer_admin.php");
?>