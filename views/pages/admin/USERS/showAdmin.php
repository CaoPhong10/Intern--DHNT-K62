<?php
$sqlAdmin = 'SELECT MAND, TENND, SDT, ISADMIN, EMAIL, GIOITINH, DIACHI, xa.tenXa, huyen.tenHuyen, tinh.tenTinh 
FROM ((nguoidung INNER JOIN xa ON nguoidung.maXA = xa.maXa) INNER JOIN huyen ON xa.maHuyen = huyen.maHuyen) 
JOIN tinh on huyen.maTinh = tinh.maTinh WHERE NOT ISADMIN = 0';
$result = mysqli_query($conn, $sqlAdmin);
while ($row = mysqli_fetch_assoc($result)){
        $mand = $row['MAND'];
        $tennd = $row['TENND'];
        $loaiTK = ($row['ISADMIN']==1)? "Quản lý": "Nhân viên bán hàng";
        $sdt = $row['SDT'];
        $email = $row['EMAIL'];
        $gioitinh = $row['GIOITINH'];
        $diachi = $row['DIACHI'] . ', ' .$row['tenXa'] .', ' .$row['tenHuyen'] . ', ' .$row['tenTinh'];
        echo '<tr>
        <td>'.$mand.'</td>
        <td>'.$tennd.'</td>
        <td>'.$loaiTK.'</td>
        <td>'.$sdt.'</td>
        <td>'.$email.'</td>
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