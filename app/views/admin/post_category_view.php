<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>

<section id="admin-section">
    <div class="head">
        <h1>Quản lí danh mục tin tức</h1>
        <div class="button-box">
            <a href="index.php?url=admin/postcat&action=add" class="btn btn-primary">Thêm danh mục mới</a>
        </div>
    </div>
    <main>
        <table class="table">
            <thead>
            <tr>
                <th class="col-cat-id">ID</th>
                <th class="col-cat-name">Loại</th>
                <th class="col-action">Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($listCategories as $item) {
                echo "<tr>
                        <td class='col-cat-id'>$item[category_id]</td>
                        <td class='col-cat-name'>$item[category_name]</td>
                        <td class='col-action'>
                            <a href='index.php?url=admin/postcat&action=edit&category_id=$item[category_id]' class='action-btn edit'>Sửa</a>
                            <a href='index.php?url=admin/postcat&action=delete&category_id=$item[category_id]' class='action-btn delete'>Xóa</a>
                        </td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </main>
</section>