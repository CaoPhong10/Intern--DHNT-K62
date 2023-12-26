<?php
$rowsPerPage = 5;// lấy 5 bản ghi trên một trang
if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
}
$offset = ($_GET['page'] - 1) * $rowsPerPage;
$sqlUser = 'SELECT MAND, TENND, SDT, EMAIL, GIOITINH, DIACHI, xa.tenXa, huyen.tenHuyen, tinh.tenTinh 
FROM ((nguoidung INNER JOIN xa ON nguoidung.maXa = xa.maXa) INNER JOIN huyen ON xa.maHuyen = huyen.maHuyen) 
JOIN tinh on huyen.maTinh = tinh.maTinh WHERE ISADMIN = 0 LIMIT '.$rowsPerPage.' OFFSET '.$offset.' ';


$result = mysqli_query($conn, $sqlUser);
while ($row = mysqli_fetch_assoc($result)){
        $mand = $row['MAND'];
        $tennd = $row['TENND'];
        $sdt = $row['SDT'];
        $email = $row['EMAIL'];
        $gioitinh = $row['GIOITINH'];
        $diachi = $row['DIACHI'] . ', ' .$row['tenXa'] .', ' .$row['tenHuyen'] . ', ' .$row['tenTinh'];
        echo '<tr>
        <td>'.$mand.'</td>
        <td>'.$tennd.'</td>
        <td>'.$sdt.'</td>
        <td>'.$email.'</td>
        <td>'.$gioitinh.'</td>
        <td>'.$diachi.'</td>
        <td style="min-width: 120px; display: flex; ">
        <a href="./Edit.php?maND='.$row["MAND"].'">
            <button class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i> Sửa</button>
        </a>
        <a href="./Delete.php?maND='.$row["MAND"].'">
            <button class="btn btn-danger btn-sm delete btn-flat"><i class="fa fa-trash"></i> Xoá</button>
        </a>
        </td>
</tr>';
}
echo '</table>';
?>
<style>
    .btn-sm {
    width: 100%; /* Điều chỉnh chiều rộng cố định cho các nút */
    margin-bottom: 5px; /* Khoảng cách giữa các nút */
}
    </style>


