<?php
include("../../../header_admin.php");
include("../../../db_connect.php");
?>

<div class="container">
        <h2 style="text-align:center">Danh sách khách hàng</h2>
        <table class="table">
                <tr>
                        <th>
                                Mã người dùng
                        </th>
                        <th style="min-width: 150px;">
                                Họ tên
                        </th>

                        <th>
                                Số điện thoại
                        </th>
                        <th>
                                Email
                        </th>
                        <th>
                                Giới tính
                        </th>

                        <th>
                                Địa chỉ
                        </th>

                        <th>Chức năng</th>
                </tr>
                <?php
                require("./showPageUsers.php");
                ?>

</div>

<?php
include("../../../footer_admin.php");
?>