<?php

class AdminController extends BaseController
{
    private $adminModel;
    private $productModel;
    private $categoryModel;
    public function __construct()
    {
        $this->loadModel('AdminModel');
        $this->adminModel = new AdminModel;
        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;
        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;
    }

    public function index()
    {
        if ($this->checkPermission()) {
            return $this->view(
                'admin.index',
            );
        } else {
            return $this->blockView();
        }

    }

    public function product()
    {
        if ($this->checkPermission()) {
            $action = $_REQUEST['action'];
            switch ($action) {
                case 'view':
                    return $this->view('admin.product_view', [
                        "list_products" => $this->productModel->getAllProducts(null),
                        "list_categories" => $this->categoryModel->getAllCategories(),
                    ]);
                case 'add':
                    return $this->view('admin.product_add', [
                        "list_categories" => $this->categoryModel->getAllCategories(),
                    ]);
                case 'delete':
                    $this->productModel->deleteProduct($_REQUEST['product_id']);
                    return $this->view('admin.log', [
                        'status' => 'Xóa thành công sản phẩm',
                        'url_back' => 'index.php?url=admin/product&action=view'
                    ]);
                case 'edit':
                    return $this->view('admin.product_edit', [
                        "product" => $this->productModel->getProductInfo($_REQUEST['product_id']),
                        "list_categories" => $this->categoryModel->getAllCategories(),
                    ]);

                case 'update':
                    print_r($_REQUEST);
                    // $_FILES['prod_thumbnail']['name']
                    $this->productModel->updateProduct($_REQUEST['prod_id'], $_REQUEST['select_category'], $_REQUEST['prod_name'], $_REQUEST['prod_desc'], $_REQUEST['prod_price'], $_REQUEST['prod_stock'], $_FILES);
                    return $this->view('admin.log', [
                        'status' => 'Cập nhật thành công sản phẩm',
                        'url_back' => 'index.php?url=admin/product&action=view'
                    ]);
                case 'submit':
                    $checkInsert = $this->productModel->addProduct($_REQUEST['select_category'], $_REQUEST['prod_name'], $_REQUEST['prod_desc'], $_REQUEST['prod_price'], $_REQUEST['prod_stock'], $_FILES);
                    if ($checkInsert == 1) {
                        $this->adminModel->moveFile($_FILES, $this->productModel->getIdProduct($_REQUEST['prod_name'], $_REQUEST['select_category']));
                        return $this->view('admin.log', [
                            'status' => 'Thêm thành công sản phẩm',
                            'url_back' => 'index.php?url=admin/product&action=view'
                        ]);
                    } else if ($checkInsert == 3) {
                        return $this->view('admin.log', [
                            'status' => "Loại sản phẩm đã tồn tại một sản phẩm có tên $_REQUEST[prod_name], vui lòng sử dụng tên khác",
                            'url_back' => 'index.php?url=admin/product&action=add'
                        ]);
                    } else {
                        return $this->view('admin.log', [
                            'status' => 'Thêm thất bại, kiểm tra lại dữ liệu vừa nhập',
                            'url_back' => 'index.php?url=admin/product&action=add'
                        ]);
                    }
            }
        } else {
            return $this->blockView();
        }

    }

    public function category()
    {
        if ($this->checkPermission()) {
            $action = $_REQUEST['action'];
            switch ($action) {
                case 'view':
                    return $this->view('admin.category_view', [
                        "list_categories" => $this->categoryModel->getAllCategories()
                    ]);
                case 'add':
                    return $this->view('admin.category_add');
                case 'delete':
                    $this->categoryModel->deleteCategory($_REQUEST['category_id']);
                    return $this->view('admin.log', [
                        'status' => 'Xóa thành công danh mục',
                        'url_back' => 'index.php?url=admin/category&action=view'
                    ]);

                case 'edit':
                    return $this->view('admin.category_edit', [
                        "category" => $this->categoryModel->getCategoryInfo($_REQUEST['category_id']),
                    ]);

                case 'update':
                    $this->categoryModel->updateCategory($_REQUEST['cat_id'], $_REQUEST['category_name']);
                    return $this->view('admin.log', [
                        'status' => 'Cập nhật thành công tên danh mục mới',
                        'url_back' => 'index.php?url=admin/category&action=view'
                    ]);
                case 'submit':
                    $checkInsert = $this->categoryModel->addCategory($_REQUEST['category_name']);
                    if ($checkInsert == 1) {
                        return $this->view('admin.log', [
                            'status' => 'Thêm thành công danh mục',
                            'url_back' => 'index.php?url=admin/category&action=view'
                        ]);
                    } else {
                        return $this->view('admin.log', [
                            'status' => "Đã có danh mục $_REQUEST[category_name], vui lòng thử tên danh mục khác!"
                        ]);
                    }
            }
        } else {
            return $this->blockView();
        }
    }

    private function checkPermission()
    {
        return $_SESSION['permission'] == 'admin';
    }

    private function blockView()
    {
        return $this->view('base.log', [
            "status" => "Blocked!",
            "status_code" => "",
            "message" => "Bạn không có quyền truy cập trang web này!",
            "url_back" => "index.php?url=home",
            "btn_title" => "Quay lại trang chủ",
        ]);
    }
}