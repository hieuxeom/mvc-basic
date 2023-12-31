<?php
$listLiked = [];
if (isset($listCommentsLiked)) {
    foreach ($listCommentsLiked as $item) {
        if (isset($item['comment_id'])) {
            $listLiked[] = $item['comment_id'];
        }
    }
}

?>

<?php
echo "<script>
    document.title =  '" . ($pageTitle ?? ' ') . "';
</script>";
?>

<section class="product-section" id="product-section">
    <div class="product-container">
        <div class="product-image-container">
            <div class="product-image">
                <img src="<?php echo BASEPATH . "/public/img/product/prod_$_GET[id]/" . $thumbnail_path ?>" alt=""/>
            </div>
        </div>
        <div class="product-info-container">
            <h1 class="product-name">
                <?php echo $product_name ?>
            </h1>
            <div class="product-price">
                <p class="product-price__main">
                    <?php echo number_format($price) ?>đ
                </p>
                <p class="product-price__sub">
                    <?php echo number_format($price) ?>đ
                </p>
            </div>
            <form action="index.php?url=cart/add" method="post" class="amount-box">
                <input type="hidden" name="prod_id" value="<?php echo $_GET['id'] ?>">
                <input type="number" name="product_amount" class="product-amount" value="1" min="1" max="100"/>
                <input type="submit" value="Thêm vào giỏ hàng" class="btn"/>
            </form>

            <div class="product-desc">
                <p class="product-desc__header">Mô tả</p>
                <div class="product-desc__body">
                    <?php echo $product_description ?>
                </div>
            </div>
        </div>
    </div>

    <div class="comment-container">
        <h1>Comment</h1>
        <?php
        if (isset($_SESSION['user_id'])) {
            echo "
        <div class='comment-block'>
            <form action='index.php?url=comment/create' method='post'>
                <input type='hidden' name='prod_id' value='<?php
                echo $_GET[id];
                ?>'/>
                <textarea class='comment-content' name='comment-content' id='comment-content'></textarea>
                <input class='btn' type='submit' value='Đăng bình luận'>
            </form>
        </div>";
        }
        foreach ($list_comments as $comment) {
            echo "
                <div class='comment-block'>
                    <div class='comment-header'>
                        <img src='" . BASEPATH . '/public/img/default-avatar.png' . "' alt='' />
                        <p class='user-name'>$comment[username]</p>
                    </div>
                    <div class='comment-body'>
                        <p class='comment-text'>
                            $comment[comment_text]
                        </p>
                    </div>
                    <div class='comment-footer'>
                        <form action='index.php?url=comment/like' method='post'>
                        <input type='hidden' name='prod_id' value='$_GET[id]' />    
                        <input type='hidden' name='comment_id' value='$comment[comment_id]' />
                            <button " . (in_array($comment['comment_id'], $listLiked) ? 'class="active"' : "") . " " . (!isset($_SESSION['user_id']) ? "disabled" : '') . ">
                                <i class='bx bx-like'></i><span>Hữu ích - $comment[likes] đánh giá </span>
                            </button>
                        </form>
                    </div>
                </div>";
        }
        ?>
    </div>
</section>
</section>