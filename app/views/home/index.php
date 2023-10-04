<?php
?>

<section class="home" id="home">
    <div class="home-text">
        <h1>Start your day <br> with coffee</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores soluta obcaecati laborum, adipisci qui
            nobis.</p>
        <a href="#" class="btn">Shop Now</a>
    </div>
    <div class="home-img">
        <img src="<?php echo BASEPATH?>/public/img/main.png" alt="">
    </div>
</section>
<!-- About -->
<section class="about" id="about">
    <div class="about-img">
        <img src="<?php echo BASEPATH?>/public/img/about.jpg" alt="">
    </div>
    <div class="about-text">
        <h2>Our History</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis alias pariatur assumenda illo animi
            nostrum dolorum provident autem exercitationem.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis alias pariatur assumenda illo animi
            nostrum dolorum provident autem exercitationem.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora tempore odit officia labore cumque?</p>
        <a href="#" class="btn">Learn More</a>
    </div>

</section>
<!-- Products -->
<section class="products" id="products">
    <div class="heading">
        <h2>Our popular products</h2>
    </div>
    <!-- Container -->
    <div class="products-container">
        <?php
            foreach ($listProduct as $item) {
                echo "<div class='box'>
                <a href='index.php?url=product/show&id=$item[product_id]' class='box-wrapper'></a>
                <img src='". BASEPATH . "/public/img/$item[thumbnail_path]' alt=''>
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
        <h2>Our customer's</h2>
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