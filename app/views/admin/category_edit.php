<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>
<section id="admin-section">
    <div class="head">
        <h1>Sửa danh mục</h1>
        <div class="button-box">
            <a href="index.php?url=admin/prodcat&action=view" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
    <main>
        <form action="index.php?url=admin/prodcat&action=update&cat_id=<?php echo $category['category_id'] ?>"
              method="post" enctype="multipart/form-data">
            <div class="form-row">
                <label for="">Tên danh mục mới</label>
                <input value="<?php echo $category['category_name'] ?>" name="category_name" type="text"
                       class="form-control"/>
            </div>

            <div class="form-row">
                <input type="submit" value="Sửa danh mục" class="btn">
            </div>
        </form>
    </main>
</section>