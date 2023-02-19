<!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <!-- Main Footer Area -->
        <div class="main-footer-area section-padding-100-0">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-70 wow fadeInUp" data-wow-delay="100ms">
                            <div class="widget-title">
                                <a href="index.html"><img src="img/core-img/logo2.png" alt=""></a>
                            </div>
                            <div class="widget-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit arcu, scelerisque dignissim massa quis, mattis facilisis erat. Aliquam erat volutpat. Sed efficitur diam ut interdum ultricies.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-70 wow fadeInUp" data-wow-delay="300ms">
                            <div class="widget-title">
                                <h4>Laptop Reviews</h4>
                            </div>
                            <div class="widget-content">
                                <nav>
                                    <ul>
                                        <?php
                                            $ambilLapRev = $conn->query("SELECT * FROM produk WHERE harga_produk BETWEEN 5000000 AND 50000000 ORDER BY id_produk DESC LIMIT 5");
                                            while($pecahLapRev = $ambilLapRev->fetch_assoc()) {
                                        ?>
                                        <li>
                                            <a href="laptop_detail.php?id=<?=base64_encode($pecahLapRev['id_produk']); ?>"><?=$pecahLapRev["nama_produk"]; ?>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-70 wow fadeInUp" data-wow-delay="500ms">
                            <div class="widget-title">
                                <h4>Usefull Links</h4>
                            </div>
                            <div class="widget-content">
                                <nav>
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="#monthly-picks-area">Reviews</a></li>
                                        <li><a href="#egames-video-area">Videos</a></li>
                                        <li><a href="#latest-articles-area">Category</a></li>
                                        <li><a href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-70 wow fadeInUp" data-wow-delay="700ms">
                            <div class="widget-title">
                                <h4>What’s new</h4>
                            </div>
                            <div class="widget-content">
                                <nav>
                                    <ul>
                                        <?php
                                            $ambilWhatNew = $conn->query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 5");
                                            while($pecahWhatNew = $ambilWhatNew->fetch_assoc()) {
                                        ?>
                                        <li>
                                            <a href="laptop_detail.php?id=<?=base64_encode($pecahWhatNew['id_produk']); ?>"><?=$pecahWhatNew["nama_produk"]; ?>     
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-content">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 col-sm-5">
                        <!-- Copywrite Text -->
                        <p class="copywrite-text"><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Presented by <a href="#" target="_blank">AlbumiComp</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
                    </div>
                    <div class="col-12 col-sm-7">
                        <!-- Footer Nav -->
                        <div class="footer-nav">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- ##### Footer Area End ##### -->