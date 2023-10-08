<?php
?>

<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>

<section class="home" id="home">
    <div class="home-text">
        <h1>Khởi động ngày mới cùng tách cà phê</h1>
        <p>Một tách cà phê được pha từ những hạt cà phê chất lượng cao sẽ mang đến cho bạn có một ngày tuyệt vời</p>
        <a href="#" class="btn">Xem sản phẩm</a>
    </div>
    <div class="home-img">
        <img src="<?php echo BASEPATH ?>/public/img/main.png" alt="">
    </div>
</section>
<!-- About -->
<section class="about" id="about">
    <div class="about-img">
        <img src="<?php echo BASEPATH?>/public/img/about.jpg" alt="">
    </div>
    <div class="about-text">
        <h2>Câu chuyện của chúng tôi</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis alias pariatur assumenda illo animi
            nostrum dolorum provident autem exercitationem.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis alias pariatur assumenda illo animi
            nostrum dolorum provident autem exercitationem.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora tempore odit officia labore cumque?</p>
        <a href="#" class="btn">Tìm hiểu thêm về chúng tôi</a>
    </div>

</section>
<!-- Products -->
<section class="products" id="products">
    <div class="heading">
        <h2>Sản phẩm nổi bật</h2>
    </div>
    <!-- Container -->
    <div class="products-container">
        <?php
            foreach ($listProduct as $item) {
                echo "<div class='box'>
                <a href='index.php?url=product/show&id=$item[product_id]' class='box-wrapper'></a>
                " . ($item['is_best_seller'] ? "<span class='best-seller-tag'>Bán chạy nhất</span>" : '') . "
                <img src='" . BASEPATH . "/public/img/product/prod_$item[product_id]/$item[thumbnail_path]' alt=''>
                <h3>$item[product_name]</h3>
                
                <div class='content'>
                    <span>". number_format($item['price']) . "đ</span>
                    <span>$item[views] Lượt xem</span>
                </div>
            </div>";
            }
        ?>
    </div>
</section>
<!-- Customers -->
<section class="customers" id="customers">
    <div class="heading">
        <h2>Phản hồi từ khách hàng</h2>
    </div>
    <!-- Container -->
    <div class="customers-container">
        <div class="box">
            <div class="stars">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star-half'></i>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad accusantium voluptate officia totam
                obcaecati ducimus?</p>
            <h2>Yasin Arafat</h2>
            <img src="<?php echo BASEPATH?>/public/img/rev1.jpg" alt="">
        </div>
        <div class="box">
            <div class="stars">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star-half'></i>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad accusantium voluptate officia totam
                obcaecati ducimus?</p>
            <h2>Yasin Arafat</h2>
            <img src="<?php echo BASEPATH?>/public/img/rev2.jpg" alt="">
        </div>
        <div class="box">
            <div class="stars">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star-half'></i>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad accusantium voluptate officia totam
                obcaecati ducimus?</p>
            <h2>Yasin Arafat</h2>
            <img src="<?php echo BASEPATH?>/public/img/rev3.jpg" alt="">
        </div>
    </div>
</section>