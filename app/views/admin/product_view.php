<?php
    // print_r($list_products);
    $list_category_name = [];
    foreach ($list_categories as $item) {
        if (isset($item['category_name'])) {
            $list_category_name[] = $item['category_name'];
        }
    }
?>
<section id="admin-section">
    <div class="head">
        <h1>Quản lí sản phẩm</h1>
        <div class="button-box">
            <a href="index.php?url=admin/product&action=add" class="btn btn-primary">Thêm sản phẩm mới</a>
        </div>
    </div>
    <main>
        <table class="table">
            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-category">Loại</th>
                    <th class="col-name">Tên sản phẩm</th>
                    <th class="col-desc">Mô tả sản phẩm</th>
                    <th class="col-price">Giá</th>
                    <th class="col-stock">Số lượng còn</th>
                    <th class="col-action">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($list_products as $item) {
                        // $category_name = 
                        echo "<tr>
                        <td class='col-id'>$item[product_id]</td>
                        <td class='col-category'>" . $list_category_name[$item['category_id']-1] . " </td>
                        <td class='col-name'>$item[product_name]</td>
                        <td class='col-desc'>
                        $item[product_description]
                        </td>
                        <td class='col-price'>$ $item[price]</td>
                        <td class='col-stock'>$item[stock_quantity]</td>
                        <td class='col-action'>
                            <a href='index.php?url=admin/product&action=edit&product_id=$item[product_id]' class='action-btn edit'>Sửa</a>
                            <a href='index.php?url=admin/product&action=delete&product_id=$item[product_id]' class='action-btn delete'>Xóa</a>
                        </td>
                    </tr>";
                    }
                ?>
            </tbody>
        </table>
    </main>
</section>