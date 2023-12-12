<?php
include '../Shared_Layout/header.php';
$id = "";
if (isset($_GET["id"])) {
    $id = $_GET["id"];

}
$result = mysqli_query($conn, "SELECT * FROM sanpham join thuonghieu on sanpham.MATH = thuonghieu.MATH join thongsokythuat on 
sanpham.MATSKT = thongsokythuat.MATSKT join loaisanpham on sanpham.MALOAISP = loaisanpham.MALOAISP
WHERE MASP = '$id'
LIMIT 1"
);

?>
<!-- ========================= SECTION CONTENT ========================= -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<?php if (mysqli_num_rows($result) <> 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
<section class="section-content bg-white padding-y">
    <div class="container">
        <!-- ============================ ITEM DETAIL ======================== -->
        <div class="row">
            <aside class="col-md-7">
                <div class="card">
                    <article class="gallery-wrap">
                        <div class="img-big-wrap">
                            <div> <a href="#"><img src="../../Images/<?php echo $row['ANH']; ?>"></a></div>
                        </div> <!-- slider-product.// -->

                    </article> <!-- gallery-wrap .end// -->
                </div> <!-- card.// -->
            </aside>
            <main class="col-md-5" style="padding-left:7%">
                <article class="product-info-aside">

                    <h2 class="title mt-3"> <?php echo $row['TENSP']; ?></h2>

                    <div class="rating-wrap my-3">
                        <ul class="rating-stars">
                            <li style="width:80%" class="stars-active">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
                    </div> <!-- rating-wrap.// -->

                    <div class="mb-3">
                        <var class="price h4"><?php echo formatCurrencyVND($row['DONGIA']); ?>"</var>

                    </div> <!-- price-detail-wrap .// -->


                    <dl class="row">
                        <dt class="col-sm-4">Thương hiệu</dt>
                        <dd class="col-sm-8"><a href="#"><?php echo $row['TENTHUONGHIEU']; ?></a></dd>

                        <dt class="col-sm-4">Mã sản phẩm</dt>
                        <dd class="col-sm-8"><?php echo $row['MASP']; ?></dd>

                        <dt class="col-sm-4">Bảo hành</dt>
                        <dd class="col-sm-8">2 năm</dd>

                        <dt class="col-sm-4">Thời gian giao hàng</dt>
                        <dd class="col-sm-8">3-4 ngày</dd>

                        <dt class="col-sm-4">Có sẵn</dt>
                        <dd class="col-sm-8">Còn <?php echo $row['SOLUONG']; ?> sản phẩm</dd>
                    </dl>

                    <div class="form-row  mt-4">
                        <div class="form-group col-md flex-grow-0">
                            <div class="input-group mb-3 input-spinner">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="button" id="button-minus"> &minus; </button>
                                </div>
                                <input id="ipQuantity" type="text" class="form-control" value="1" readonly="readonly">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light" type="button" id="button-plus"> + </button>
                                </div>


                            </div>
                        </div> <!-- col.// -->
                        <div class="form-group col-md">
                            <a class="btn btn-primary text-white" id="addtocart">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="text">Thêm vào giỏ hàng</span>
                            </a>

                        </div> <!-- col.// -->
                    </div> <!-- row.// -->

                </article> <!-- product-info-aside .// -->
            </main> <!-- col.// -->
        </div> <!-- row.// -->
        <!-- ================ ITEM DETAIL END .// ================= -->


    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<!-- ========================= SECTION  ========================= -->
<section class="section-name padding-y bg">
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <h5 class="title-description">Mô tả sản phẩm</h5>
                <p>
                <?php echo $row['MOTA']; ?>
                </p>


                <h5 class="title-description">Thông số kỹ thuật</h5>
                <table class="table table-bordered">
                    <tr> <th colspan="2">Thông số</th> </tr>
                    <tr> <td>Hệ điều hành</td><td><?php echo $row['HEDIEUHANH']; ?></td> </tr>
                    <tr> <td>RAM</td><td><?php echo $row['RAM']; ?></td> </tr>
                    <tr> <td>ROM</td><td> <?php echo $row['ROM']; ?></td></tr>


                    <tr> <td>Kích cỡ màn hình</td><td><?php echo $row['KICHCOMANHINH']; ?></td> </tr>
                    <tr> <td>Vi xử lí</td><td><?php echo $row['VIXULY']; ?></td> </tr>
                    <tr> <td>Pin	</td><td><?php echo $row['PIN']; ?></td> </tr>


                    <tr> <td>Camera</td><td> <?php echo $row['CAMERA']; ?></td> </tr>
                    <tr> <td>Thương hiệu</td><td><?php echo $row['TENTHUONGHIEU']; ?></td> </tr>


                    <tr> <td>Xuất xứ</td><td><?php echo $row['QUOCGIA']; ?></td> </tr>


                </table>
            </div> <!-- col.// -->

            <aside class="col-md-4">

                <div class="box">


                    <h5 class="title-description">Videos</h5>


                    <article class="media mb-3">
                        <a href="#"><img class="img-sm mr-3" src="../../Content/images/posts/3.jpg"></a>
                        <div class="media-body">
                            <h6 class="mt-0"><a href="#">Iphone 15 rớt giá</a></h6>
                            <p class="mb-2"> Vì trông không khác gì Iphone 14 nên Iphone 15 rớt giá thảm hại,... </p>
                        </div>
                    </article>

                    <article class="media mb-3">
                        <a href="#"><img class="img-sm mr-3" src="../../Content/images/posts/2.jpg"></a>
                        <div class="media-body">
                            <h6 class="mt-0"><a href="#">Xiaomi 14 pro ra mắt</a></h6>
                            <p class="mb-2">Buổi lễ ra mắt Xiaomi 14 pro ra măt ở Thường Châu, Trung Quốc,.... </p>
                        </div>
                    </article>

                    <article class="media mb-3">
                        <a href="#"><img class="img-sm mr-3" src="../../Content/images/posts/1.jpg"></a>
                        <div class="media-body">
                            <h6 class="mt-0"><a href="#">Điện thoại màn hình gập có phải xu thế</a></h6>
                            <p class="mb-2"> Những chiếc điện thoại màn hình gập hiện nay..... </p>
                        </div>
                    </article>



                </div> <!-- box.// -->
            </aside> <!-- col.// -->
        </div> <!-- row.// -->

    </div> <!-- container .//  -->
</section>
<?php endwhile; ?>
                <?php endif; ?>
<script>
    // Lấy đối tượng input và button
    var input = document.getElementById('ipQuantity');
    var buttonMinus = document.getElementById('button-minus');
    var buttonPlus = document.getElementById('button-plus');

    // Xử lý sự kiện khi button "minus" được bấm
    buttonMinus.addEventListener('click', function () {

        var value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        } else {
            input.value = 1;
        }
    });

    // Xử lý sự kiện khi button "plus" được bấm
    buttonPlus.addEventListener('click', function () {
        var value = parseInt(input.value);
        input.value = value + 1;
    });

    // Xử lý sự kiện khi giá trị trong input thay đổi
    input.addEventListener('change', function () {
        var value = parseInt(input.value);
        if (value < 1 || isNaN(value)) {
            input.value = 1;
        }
    });
    $(function () {
        $("#addtocart").click(function () {
            var masp = '<?php echo $id?>'; // Lấy mã sản phẩm 
            var soluong = $('#ipQuantity').val(); // Lấy số lượng từ input
          
            $.ajax({
                url: '../GIOHANG/ThemVaoGioHang.php', // URL của phương thức "ThemVaoGioHang" trong controller
                type: 'POST',
                data: { MASP: masp, SOLUONG: soluong }, // Truyền dữ liệu masp và soluong
                success: function (response) {
                
                    var result = JSON.parse(response); 
                
                    if (result.success) {        
                       $("#CartCount").text(result.slgh);                   
                       showSuccessToast("Đã thêm sản phẩm vào giỏ hàng");
                    } 
                    else{
                        alert("Không thể thêm vào giỏ hàng!");
                    }
                },
                error: function () {
                    
                    alert("Có lỗi xảy ra khi thêm vào giỏ hàng!");
                }
            });

            return false;
        });
    });
</script>
<?php include '../Shared_Layout/footer.php' ?>