<?php
    ?>
<section id="search-section products">
    <div class="search-container">
        <?php
        foreach ($products as $prod) {
            echo "<div class='box'>
                <a href='#' class='box-wrapper'></a>
                <img src='" . BASEPATH . "/public/img/$prod[thumbnail_path]" . "' alt='' />
                <h3>$prod[product_name]</h3>
    
                <div class='content'>
                    <span>".number_format($prod['price'])."đ</span>
                    <span>$prod[views] Lượt xem</span>
                </div>
            </div>
                ";
        }
        ?>

        <!-- <div class='box'>
            <a href='#' class='box-wrapper'></a>
            <img src='img/p1.png' alt='' />
            <h3>Ten san pham</h3>

            <div class='content'>
                <span>100,000đ</span>
                <span>50 Lượt xem</span>
            </div>
        </div>
        <div class="box">
            <a href="#" class="box-wrapper"></a>
            <img src="img/p1.png" alt="" />
            <h3>Ten san pham</h3>

            <div class="content">
                <span>100,000đ</span>
                <span>50 Lượt xem</span>
            </div>
        </div> -->
    </div>
</section>