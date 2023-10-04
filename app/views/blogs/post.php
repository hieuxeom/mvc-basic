<?php

?>
<!-- Post Content -->
<section
        style="--background-img: url('<?php echo "../img/blog/post_$postDetails[post_id]/$postDetails[thumbnail_path]" ?>')"
        class="post-header">
    <div class="header-content post-container">
        <!-- Back To Home -->
        <a href="index.php?url=blog" class="btn back-home">Quay lại</a>
        <!-- Title -->
        <h1 class="header-title">How To Create Best UX Design With Adobe Xd</h1>
        <!-- Post Image -->
        <img src="<?php echo BASEPATH . "/public/img/blog/post_$postDetails[post_id]/$postDetails[thumbnail_path]" ?>"
             alt="" class="header-img">
    </div>
</section>
<!-- Posts -->
<section class="post-content">
    <div class="post-text">
        <?php
        echo $postDetails['content'] ?? "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis commodi exercitationem maxime optio quos ullam veritatis voluptatibus. Alias consequatur ea excepturi exercitationem fugit, hic, pariatur quod suscipit vel voluptates voluptatum!.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis commodi exercitationem maxime optio quos ullam veritatis voluptatibus. Alias consequatur ea excepturi exercitationem fugit, hic, pariatur quod suscipit vel voluptates voluptatum!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis commodi exercitationem maxime optio quos ullam veritatis voluptatibus. Alias consequatur ea excepturi exercitationem fugit, hic, pariatur quod suscipit vel voluptates voluptatum!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis commodi exercitationem maxime optio quos ullam veritatis voluptatibus. Alias consequatur ea excepturi exercitationem fugit, hic, pariatur quod suscipit vel voluptates voluptatum!"
        ?>
    </div>

</section>
<!-- Share -->
<div class="share post-container">
    <span class="share-title">Chia sẻ bài viết</span>
    <div class="social">
        <a href="#"><i class='bx bxl-facebook'></i></a>
        <a href="#"><i class='bx bxl-twitter'></i></a>
        <a href="#"><i class='bx bxl-instagram'></i></a>
        <a href="#"><i class='bx bxl-linkedin'></i></a>
    </div>
</div>