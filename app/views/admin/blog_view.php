<?php

$listCategoriesName = [];

foreach ($listCategories as $category) {
    if (isset($category['category_name'])) {
        $listCategoriesName[] = $category['category_name'];
    }
}
?>
<section id="admin-section">
    <div class="head">
        <h1>Quản lí bài viết</h1>
        <div class="button-box">
            <a href="index.php?url=admin/blog&action=add" class="btn btn-primary">Bài viết mới</a>
        </div>
    </div>
    <main>
        <table class="table">
            <thead>
            <tr>
                <th class="col-id">ID</th>
                <th class="col-category">Danh mục</th>
                <th class="col-title">Tiêu đề</th>
                <th class="col-desc">Mô tả ngắn</th>
                <th class="col-author">Tác giả</th>
                <th class="col-publish-date">Ngày đăng</th>
                <th class="col-action">Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($listPosts as $post) {
                // $category_name =
                echo "<tr>
                        <td class='col-id'>$post[post_id]</td>
                        <td class='col-category'>" . $listCategoriesName[$post['category_id'] - 1] . " </td>
                        <td class='col-name'>$post[title]</td>
                        <td class='col-desc'>
                        $post[short_content]
                        </td>
                        <td class='col-price'>$post[username]</td>
                        <td class='col-stock'>$post[publish_date]</td>
                        <td class='col-action'>
                            <a href='index.php?url=admin/blog&action=edit&post_id=$post[post_id]' class='action-btn edit'>Sửa</a>
                            <a href='index.php?url=admin/blog&action=delete&post_id=$post[post_id]' class='action-btn delete'>Xóa</a>
                        </td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </main>
</section>