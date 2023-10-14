<?php

class ProductController extends BaseController
{

    private $productModel;
    private $productCategoryModel;

    private $commentModel;

    public function __construct()
    {
        $this->loadModel("ProductModel");
        $this->productModel = new ProductModel;
        $this->loadModel("ProductCategoryModel");
        $this->productCategoryModel = new ProductCategoryModel;
        $this->loadModel("CommentModel");
        $this->commentModel = new CommentModel;
    }

    public function index()
    {
        $listProducts = $this->productModel->getAllProducts();
        $listCategories = $this->productCategoryModel->getAllCategories();
        return $this->view("products.product", [
            "listProducts" => $listProducts,
            "listCategories" => $listCategories,
            "pageTitle" => "Trang sản phẩm",
        ]);
    }

    public function category()
    {
        $filter = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : "0";
        if ($filter != "0") {
            $listProducts = $this->productModel->getAllProductsOfCategory($filter);
        } else {
            $listProducts = $this->productModel->getAllProducts();
        }

        $listCategories = $this->productCategoryModel->getAllCategories();
        return $this->view("products.product", [
            "listProducts" => $listProducts,
            "listCategories" => $listCategories,
            "pageTitle" => "Trang sản phẩm",
        ]);
    }

    public function show()
    {
        $product_id = $_GET["id"];
        $product_info = $this->productModel->getProductInfo($product_id);
        $product_name = $product_info["product_name"];
        $product_description = $product_info["product_description"];;
        $price = $product_info["price"];;
        $category = $product_info["category_id"];
        $thumbnail_path = $product_info["thumbnail_path"];

        // update view
        $this->productModel->updateView($product_id);

        $category_name = $this->productCategoryModel->getCategoryName($category);

        $list_comments = $this->commentModel->getAllComments($product_id);

        $arrayData = [
            "product_name" => $product_name,
            "product_description" => $product_description,
            "price" => $price,
            "category" => $category_name,
            "thumbnail_path" => $thumbnail_path,
            "list_comments" => $list_comments,
            "pageTitle" => $product_name
        ];

        if (isset($_SESSION["user_id"])) {
            $list_comments_liked = $this->commentModel->getLikeComment($_SESSION["user_id"], $product_id);
            $arrayData["listCommentsLiked"] = $list_comments_liked;
        }

        return $this->view("products.index", $arrayData);
    }

}