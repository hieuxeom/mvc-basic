<?php

class AdminController extends BaseController
{
    private $adminModel;
    private $productModel;
    private $productCategoryModel;
    private $blogModel;

    private $blogCategoryModel;

    public function __construct()
    {
        $this->loadModel("AdminModel");
        $this->adminModel = new AdminModel;
        $this->loadModel("ProductModel");
        $this->productModel = new ProductModel;
        $this->loadModel("ProductCategoryModel");
        $this->productCategoryModel = new ProductCategoryModel;
        $this->loadModel("BlogCategoryModel");
        $this->blogCategoryModel = new BlogCategoryModel;
        $this->loadModel("BlogModel");
        $this->blogModel = new BlogModel;
    }

    public function index()
    {
        if ($this->checkPermission()) {
            $arrayData = [
                "pageTitle" => "Trang quản trị"
            ];
            return $this->view(
                "admin.index", $arrayData
            );
        } else {
            return $this->blockView();
        }

    }

    public function product()
    {
        $arrayData = [];
        if ($this->checkPermission()) {
            $action = $_REQUEST["action"];
            switch ($action) {
                case "view":
                    $listProduct = $this->productModel->getAllProducts(null);
                    $listCategories = $this->productCategoryModel->getAllCategories();
                    $arrayData = [
                        "listProducts" => $listProduct,
                        "listCategories" => $listCategories,
                        "pageTitle" => "Danh sách sản phẩm"
                    ];
                    return $this->view("admin.product_view", $arrayData);
                case "add":
                    $listCategories = $this->productCategoryModel->getAllCategories();
                    $arrayData = [
                        "listCategories" => $listCategories,
                        "pageTitle" => "Thêm sản phẩm mới"
                    ];

                    return $this->view("admin.product_add", $arrayData);
                case "delete":
                    $checkDelete = $this->productModel->deleteProduct($_REQUEST["product_id"]);

                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Xóa thành công",
                        "url_back" => "index.php?url=admin/product&action=view",
                        "btn_title" => "Quay lại",
                    ];
                    return $this->view("base.log", $arrayData);

                case "edit":
                    $productDetails = $this->productModel->getProductInfo($_REQUEST["product_id"]);
                    $listCategories = $this->productCategoryModel->getAllCategories();
                    $arrayData = [
                        "productDetails" => $productDetails,
                        "listCategories" => $listCategories,
                        "pageTitle" => "Sửa sản phẩm - $productDetails[product_name]",
                    ];
                    return $this->view("admin.product_edit", $arrayData);

                case "update":
                    $checkUpdate = $this->productModel->updateProduct($_REQUEST["prod_id"], $_REQUEST["select_category"], $_REQUEST["prod_name"], $_REQUEST["prod_desc"], $_REQUEST["prod_price"], $_REQUEST["prod_stock"], $_FILES);

                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Cập nhật thành công",
                        "url_back" => "index.php?url=admin/product&action=view",
                        "btn_title" => "Quay lại"
                    ];

                    return $this->view("base.log", $arrayData);
                case "submit":
                    $checkInsert = $this->productModel->addProduct($_REQUEST["select_category"], $_REQUEST["prod_name"], $_REQUEST["prod_desc"], $_REQUEST["prod_price"], $_REQUEST["prod_stock"], $_FILES);
                    if ($checkInsert == 1) {
                        $arrayData = [
                            "status" => "Success!",
                            "message" => "Thêm sản phẩm thành công",
                            "url_back" => "index.php?url=admin/product&action=view",
                            "btn_title" => "Quay lại"
                        ];

                        $checkMoveFile = $this->adminModel->moveFileProduct($_FILES, $this->productModel->getIdProduct($_REQUEST["prod_name"], $_REQUEST["select_category"]));

                        return $this->view("base.log", $arrayData);
                    } else if ($checkInsert == 3) {
                        $arrayData = [
                            "status" => "Failed!",
                            "message" => "Loại sản phẩm đã tồn tại một sản phẩm có tên $_REQUEST[prod_name], vui lòng sử dụng tên khác",
                            "url_back" => "index.php?url=admin/product&action=add",
                            "btn_title" => "Quay lại"
                        ];

                        return $this->view("base.log", $arrayData);
                    } else {
                        $arrayData = [
                            "status" => "Failed!",
                            "message" => "Thêm thất bại, kiểm tra lại dữ liệu vừa nhập",
                            "url_back" => "index.php?url=admin/product&action=add",
                            "btn_title" => "Quay lại",
                        ];

                        return $this->view("base.log", $arrayData);
                    }
            }
        } else {
            return $this->blockView();
        }
        return $this->blockView();
    }

    public function prodcat()
    {
        $arrayData = [];
        if ($this->checkPermission()) {
            $action = $_REQUEST["action"];
            switch ($action) {
                case "view":
                    $arrayData = [
                        "listCategories" => $this->productCategoryModel->getAllCategories(),
                        "pageTile" => "Danh sách danh mục sản phẩm"
                    ];

                    return $this->view("admin.category_view", $arrayData);
                case "add":
                    $arrayData = [
                        "pageTitle" => "Thêm danh mục mới"
                    ];
                    return $this->view("admin.category_add", $arrayData);
                case "delete":
                    $checkDelete = $this->productCategoryModel->deleteCategory($_REQUEST["category_id"]);

                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Xóa thành công danh mục",
                        "url_back" => "index.php?url=admin/prodcat&action=view",
                        "btn_title" => "Quay lại"
                    ];
                    return $this->view("base.log", $arrayData);

                case "edit":
                    $categoryDetails = $this->productCategoryModel->getCategoryInfo($_REQUEST["category_id"]);

                    $arrayData = [
                        "category" => $categoryDetails,
                        "pageTitle" => "Sửa danh mục - $categoryDetails[category_name]",
                    ];

                    return $this->view("admin.category_edit", $arrayData);

                case "update":
                    $checkUpdate = $this->productCategoryModel->updateCategory($_REQUEST["cat_id"], $_REQUEST["category_name"]);
                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Cập nhật thành công tên danh mục mới",
                        "url_back" => "index.php?url=admin/prodcat&action=view",
                        "btn_title" => "Quay lại"
                    ];

                    return $this->view("base.log", $arrayData);
                case "submit":
                    $checkInsert = $this->productCategoryModel->addCategory($_REQUEST["category_name"]);
                    print_r($checkInsert);
                    if ($checkInsert == 1) {
                        $arrayData = [
                            "status" => "Success!",
                            "message" => "Thêm thành công danh mục",
                            "url_back" => "index.php?url=admin/prodcat&action=view",
                            "btn_title" => "Quay lại"
                        ];
                        return $this->view("base.log", $arrayData);
                    } else {
                        $arrayData = [
                            "status" => "Failed!",
                            "message" => "Đã có danh mục $_REQUEST[category_name], vui lòng thử tên danh mục khác!",
                            "url_back" => "index.php?url=admin/prodcat&action=add",
                            "btn_title" => "Quay lại"
                        ];
                        return $this->view("base.log", $arrayData);
                    }
            }
        } else {
            return $this->blockView();
        }
        return $this->blockView();
    }

    public function blog()
    {
        $arrayData = [];
        if ($this->checkPermission()) {
            $action = $_REQUEST["action"];
            switch ($action) {
                case "view":
                    $listPost = $this->blogModel->getAllPost();
                    $listCategories = $this->blogModel->getAllBlogCategories();
                    $arrayData = [
                        "listPosts" => $listPost,
                        "listCategories" => $listCategories,
                        "pageTitle" => "Danh sách bài viết"
                    ];
                    return $this->view("admin.blog_view", $arrayData);
                case "add":
                    $listCategories = $this->blogModel->getAllBlogCategories();
                    $arrayData = [
                        "listCategories" => $listCategories,
                        "pageTitle" => "Thêm bài viết mới"
                    ];
                    return $this->view("admin.blog_add", $arrayData);
                case "delete":
                    $checkDelete = $this->blogModel->deletePost($_REQUEST["post_id"]);
                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Xóa bài viết thành công",
                        "url_back" => "index.php?url=admin/blog&action=view",
                        "btn_title" => "Quay lại"
                    ];
                    return $this->view("base.log", $arrayData);
                case "edit":
                    $postDetails = $this->blogModel->getPostDetails($_REQUEST["post_id"]);
                    $listCategories = $this->blogModel->getAllBlogCategories();
                    $arrayData = [
                        "postDetails" => $postDetails,
                        "listCategories" => $listCategories,
                        "pageTitle" => "Sửa bài viết - $postDetails[title]"
                    ];
                    return $this->view("admin.blog_edit", $arrayData);
                case "update":
                    $checkMoveFile = false;
                    if (!empty($_FILES["post_thumbnail"]["name"])) {
                        $checkMoveFile = $this->adminModel->moveFileBlog($_FILES, $_REQUEST["post_id"]);
                    }

                    $checkUpdate = $this->blogModel->updatePost($_REQUEST["post_id"], $_REQUEST["post_title"], $_REQUEST["post_content"], $_REQUEST["post_short_desc"], $_REQUEST["post_category"], $_FILES);
                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Cập nhật bài viết thành công, truy cập trang tin tức để xem bài viết",
                        "url_back" => "index.php?url=admin/blog&action=view",
                        "btn_title" => "Quay lại"
                    ];
                    return $this->view("base.log", $arrayData);
                case "submit":
                    if (empty($_FILES["post_thumbnail"]["name"])) {
                        $arrayData = [
                            "status" => "Failed!",
                            "message" => "Chưa có hình ảnh cho bài viết, vui lòng thêm hình ảnh và thử lại!",
                            "url_back" => "index.php?url=admin/blog&action=add",
                            "btn_title" => "Quay lại"
                        ];
                        return $this->view("base.log", $arrayData);
                    }

                    $newPost = $this->blogModel->createPost(title: $_REQUEST["post_title"], content: $_REQUEST["post_content"], short_content: $_REQUEST["post_short_desc"], user_id: $_SESSION["user_id"], category_id: $_REQUEST["post_category"], thumbnail_path: $_FILES);
                    $checkMoveFile = $this->adminModel->moveFileBlog($_FILES, $newPost["post_id"]);

                    $arrayData = [
                        "status" => "Success",
                        "message" => "Đăng bài thành công, truy cập trang tin tức để xem bài viết",
                        "url_back" => "index.php?url=admin/blog&action=view",
                        "btn_title" => "Quay lại trang quản lí bài viết"
                    ];
                    return $this->view("base.log", $arrayData);

            }
        } else {
            return $this->blockView();
        }
        return $this->blockView();
    }

    public function postcat()
    {
        $arrayData = [];
        if ($this->checkPermission()) {
            $action = $_REQUEST["action"];
            switch ($action) {
                case "view":
                    $arrayData = [
                        "listCategories" => $this->blogCategoryModel->getAllCategories(),
                        "pageTile" => "Danh sách danh mục sản phẩm"
                    ];
                    return $this->view("admin.post_category_view", $arrayData);
                case "add":
                    $arrayData = [
                        "pageTitle" => "Thêm danh mục mới"
                    ];
                    return $this->view("admin.post_category_add", $arrayData);
                case "delete":
                    $checkDelete = $this->blogCategoryModel->deleteCategory($_REQUEST["category_id"]);
                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Xóa thành công danh mục",
                        "url_back" => "index.php?url=admin/postcat&action=view",
                        "btn_title" => "Quay lại"
                    ];
                    return $this->view("base.log", $arrayData);

                case "edit":
                    $categoryDetails = $this->blogCategoryModel->getCategoryInfo($_REQUEST["category_id"]);

                    $arrayData = [
                        "category" => $categoryDetails,
                        "pageTitle" => "Sửa danh mục - $categoryDetails[category_name]",
                    ];

                    return $this->view("admin.post_category_edit", $arrayData);

                case "update":
                    $checkUpdate = $this->blogCategoryModel->updateCategory($_REQUEST["cat_id"], $_REQUEST["category_name"]);
                    $arrayData = [
                        "status" => "Success!",
                        "message" => "Cập nhật thành công tên danh mục mới",
                        "url_back" => "index.php?url=admin/postcat&action=view",
                        "btn_title" => "Quay lại"
                    ];

                    return $this->view("base.log", $arrayData);
                case "submit":
                    $checkInsert = $this->blogCategoryModel->addCategory($_REQUEST["category_name"]);
                    print_r($checkInsert);
                    if ($checkInsert == 1) {
                        $arrayData = [
                            "status" => "Success!",
                            "message" => "Thêm thành công danh mục",
                            "url_back" => "index.php?url=admin/postcat&action=view",
                            "btn_title" => "Quay lại"
                        ];
                        return $this->view("base.log", $arrayData);
                    } else {
                        $arrayData = [
                            "status" => "Failed!",
                            "message" => "Đã có danh mục $_REQUEST[category_name], vui lòng thử tên danh mục khác!",
                            "url_back" => "index.php?url=admin/postcat&action=add",
                            "btn_title" => "Quay lại"
                        ];
                        return $this->view("base.log", $arrayData);
                    }
            }
        } else {
            return $this->blockView();
        }
        return $this->blockView();
    }


    private function checkPermission()
    {
        return $_SESSION["permission"] == "admin";
    }

    private function blockView()
    {
        return $this->view("base.log", [
            "status" => "Blocked!",
            "status_code" => "",
            "message" => "Bạn không có quyền truy cập trang web này!",
            "url_back" => "index.php?url=home",
            "btn_title" => "Quay lại trang chủ",
        ]);
    }
}