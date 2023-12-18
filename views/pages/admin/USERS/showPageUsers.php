<?php
include("./showUsers.php");
$numRows = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM nguoidung'));
$maxPage = ($numRows % $rowsPerPage) ? floor($numRows / $rowsPerPage) + 1 : floor($numRows / $rowsPerPage);
?>
<div style="display: flex; width: 100%;">
        <?php
        if ($_GET['page'] > 1)
                echo "<a class='btn btn-primary' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($_GET['page'] - 1) . "'>Back</a> ";
        else
                echo "<button class='btn btn-default' disabled>Back</button>";
        //Trang đầu
        echo "<a class=' btn btn-primary' href='"
        . $_SERVER['PHP_SELF'] . "?page=" . "1". "'>Trang đầu" . "</a> ";
        
        echo "<div style = 'display: flex ; justify-content: center; align-items: center; flex-grow: 1;'>";
        if ($maxPage < 10) {
                for ($i = 1; $i <= $maxPage; $i++) //tạo link tương ứng tới các trang
                {
                        if ($i == $_GET['page'])
                                echo '<b class="btn btn-default" >Trang ' . $i . '</b> '; //trang hiện tại
                        else
                                echo "<a class=' btn btn-primary' href='"
                                        . $_SERVER['PHP_SELF'] . "?page=" . $i. "'>" . $i . "</a> ";
                }
        } else {
                for ($i = $_GET['page'] - $delta; $i <= $_GET['page'] + $delta; $i++) //tạo link tương ứng tới các trang
                {
                        if ($i == $_GET['page'])
                                echo '<b class="btn btn-default w-40" >Trang ' . $i . '</b> '; //trang hiện tại
                        else if ($i > 0 && $i <= $maxPage)
                                echo "<a class=' btn btn-primary w-40' href='"
                                        . $_SERVER['PHP_SELF'] . "?page=" . $i. "'>" . $i . "</a> ";
                }
        }
        echo "</div>";
                // Trang cuối
                echo "<a class=' btn btn-primary' href='"
                        . $_SERVER['PHP_SELF'] . "?page=" . $maxPage . "'>Trang cuối" . "</a> ";
                //gắn thêm nút Next
                if ($_GET['page'] < $maxPage)
                        echo "<a class='btn btn-primary' href='" . $_SERVER['PHP_SELF'] . "?page="
                                . ($_GET['page'] + 1) . "'>Next</a>";
                else
                        echo "<button class='btn btn-default' disabled>Next</button>";
        ?>

</div>