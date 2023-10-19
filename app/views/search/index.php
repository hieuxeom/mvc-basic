<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>
<section id="list-section">
    <div class="side-container">
        <ul>
            <li><a href="#">All</a></li>
            <?php
            foreach ($listCategories as $category) {
                echo "<li><a href='index.php?url=product/category&filter=$category[category_id]'>$category[category_name]</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="search-container">
        <?php
        if (!empty($listProducts)) {
            foreach ($listProducts as $prod) {
                echo "<div class='box'>
                <a href='index.php?url=product/show&id=" . $prod['product_id'] . "' class='box-wrapper'></a>
                <img src='" . BASEPATH . "/public/img/product/prod_$prod[product_id]/$prod[thumbnail_path]" . "' alt='' />
                <h3>$prod[product_name]</h3>
    
                <div class='content'>
                    <span>" . number_format($prod['price']) . "đ</span>
                    <span>$prod[views] Lượt xem</span>
                </div>
            </div>
                ";
            }
        } else {
            echo "<h3>Không tìm thấy sản phẩm nào!</h3>";
        }
        ?>
    </div>
</section>