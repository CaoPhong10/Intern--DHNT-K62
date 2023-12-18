<?php
include("../../../header_admin.php");
include("../../../db_connect.php");
?>
<div class="container">

        <div class="d-flex justify-content-between">
                <a href="CreateaAdmin.php" class="btn btn-primary m-2">Thêm ADMIN</a>
        </div>
        <table class="table">
                <tr>
                        <th>
                                Mã nhân viên
                        </th>
                        <th style="min-width: 150px;">
                                Họ tên
                        </th>

                        <th>
                                Loại tài khoản
                        </th>
                        <th>
                                Số điện thoại
                        </th>
                        <th>
                                Email
                        </th>

                        <th>
                                Địa chỉ
                        </th>

                        <th>Chức năng</th>
                </tr>
                <?php
                require("./showAdmin.php");
                ?>

</div>
<?php
include("../../../footer_admin.php");
?>