
    <footer class="section-footer bg-secondary">
        <div class="container">
            <section class="footer-top padding-y-lg text-white">
                <div class="row">
                    <aside class="col-md-5 col-6">
                        <h6 class="title">Thương hiệu</h6>
                        <ul class="list-unstyled">
                            <li> <a href="../LOAISANPHAM/DanhSachSanPham.php?id=apple">Apple</a></li>
                            <li> <a href="../LOAISANPHAM/DanhSachSanPham.php?id=samsung">Samsung</li>
                            <li> <a href="../LOAISANPHAM/DanhSachSanPham.php?id=xiaomi">Xiaomi</li>
                            <li> <a href="../LOAISANPHAM/DanhSachSanPham.php?id=lenovo">Lenovo</li>
                        </ul>
                    </aside>

                    <aside class="col-md-5 col-6">
                        <h6 class="title" style="color:white">Trợ giúp</h6>
                        <ul class="list-unstyled">
                            <li> <a href="#">Liên hệ</a></li>
                            <li> <a href="#">Tình trạng đơn hàng</a></li>
                        </ul>
                    </aside>

                    <aside class="col-md-2 col-6">
                        <h6 class="title">Mạng xã hội</h6>
                        <ul class="list-unstyled">
                            <li><a href="https://www.facebook.com/"> <i class="fab fa-facebook"></i> Facebook </a></li>
                            <li><a href="https://twitter.com/i/flow/login?redirect_after_login=%2Fdang_nhap%2F"> <i class="fab fa-twitter"></i> Twitter </a></li>
                            <li><a href="https://www.instagram.com/?hl=vi"> <i class="fab fa-instagram"></i> Instagram </a></li>

                        </ul>
                    </aside>
                </div> <!-- row.// -->
            </section>	<!-- footer-top.// -->
        </div><!-- //container -->
    </footer>
    <script>
      
         $(".close").click(function () {
        $("#toast_updateCart").removeClass("active");
        setTimeout(function () {
            $(".progress").removeClass("active");
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
    });
    </script>
    <!-- ========================= FOOTER END // ========================= -->
</body>
</html>