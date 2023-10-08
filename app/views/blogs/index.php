<?php
$listCategoryName = [];
foreach ($listCategories as $category) {
    $listCategoryName[$category['category_id']] = $category['category_name'];
}
?>

<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>
<section id="blog-section">
    <div class="post-filter container">
        <?php
        echo "<a href='index.php?url=blog' class='filter-item " . ($categoryActive == 0 ? "active-filter" : "") . "' >Tất cả</a>";
        foreach ($listCategories as $category) {
            echo "<a href='index.php?url=blog&filter=$category[category_id]' class='filter-item " . ($category['category_id'] == $categoryActive ? "active-filter" : "") . "'>$category[category_name]</a>";
        }
        ?>
    </div>
    <!-- Post Box 1 -->
    <div class="post container">
        <?php
        foreach ($listPosts as $post) {
            echo "<div class='post-box'>
            <img src='" . BASEPATH . "/public/img/blog/post_$post[post_id]/$post[thumbnail_path]' alt='' class='post-img'>
            <h2 class='category'>" . $listCategoryName[$post['category_id']] . "</h2>
            <a href='index.php?url=blog/post&post_id=$post[post_id]' class='post-title'>
                $post[title]
            </a>
            <span class='post-date'>$post[publish_date]</span>
            <p class='post-decription'>$post[short_content]</p>
            <!-- Profile -->
            <div class='profile'>
                <img src='" . BASEPATH . "/public/img/default-avatar.png' alt='profile-avatar' class='profile-img'>
                <span class='profile-name'>$post[fullname]</span>
            </div>
        </div>";
        }
        ?>
    </div>
</section>