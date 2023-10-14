<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>
<section id="admin-section">
    <div class="head">
        <h1>Thêm danh mục mới</h1>
        <div class="button-box">
            <a href="index.php?url=admin/postcat&action=view" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
    <main>
        <form action="index.php?url=admin/postcat&action=submit" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <label for="">Tên danh mục mới</label>
                <input name="category_name" type="text" class="form-control"/>
            </div>

            <div class="form-row">
                <input type="submit" value="Thêm danh mục" class="btn">
            </div>
        </form>
    </main>
</section>