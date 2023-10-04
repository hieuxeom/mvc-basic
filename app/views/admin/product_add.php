<section id="admin-section">
    <div class="head">
        <h1>Thêm sản phẩm mới</h1>
        <div class="button-box">
        <a href="index.php?url=admin/product&action=view" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
    <main>
        <form action="index.php?url=admin/product&action=submit" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <label for="">Danh mục sản phẩm</label>
                <select name="select_category" id="select-category">
                    <?php
                    foreach ($list_categories as $item) {
                        echo "<option value='$item[category_id]'>$item[category_name]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label for="">Tên sản phẩm</label>
                <input name="prod_name" type="text" class="form-control" />
            </div>
            <div class="form-row">
                <label for="">Mô tả ngắn sản phẩm</label>
                <input name="prod_desc" type="text" class="form-control" />
            </div>
            <div class="form-row">
                <label for="">Giá sản phẩm</label>
                <input name="prod_price" type="text" class="form-control" />
            </div>
            <div class="form-row">
                <label for="">Số lượng sản phẩm</label>
                <input name="prod_stock" type="text" class="form-control" />
            </div>
            <div class="form-row">
                <label for="">Hình ảnh sản phẩm</label>
                <input name="prod_thumbnail" type="file" class="form-control" />
            </div>
            <div class="form-row">
                <input type="submit" value="Thêm sản phẩm" class="btn">
            </div>
        </form>
    </main>
</section>