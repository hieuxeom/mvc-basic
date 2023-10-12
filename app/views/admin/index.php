<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>


<section id="admin-section">
    <div class="admin-select-container">
        <a href="index.php?url=admin/prodcat&action=view" class="admin-select">
            <i class='bx bxs-package'></i>
            <span>Quản lí danh mục sản phẩm</span>
        </a>
        <a href="index.php?url=admin/product&action=view" class="admin-select">
            <i class='bx bxs-package'></i>
            <span>Quản lí sản phẩm</span>
        </a>
        <a href="index.php?url=admin/user&action=view" class="admin-select">
            <i class='bx bxs-package'></i>
            <span>Quản lí khách hàng</span>
        </a>
        <a href="index.php?url=admin/postcat&action=view" class="admin-select">
            <i class='bx bxs-package'></i>
            <span>Quản lí danh mục tin tức</span>
        </a>
        <a href="index.php?url=admin/blog&action=view" class="admin-select">
            <i class='bx bxs-package'></i>
            <span>Quản lí tin tức</span>
        </a>
    </div>
</section>