<?php
class HomeController extends BaseController
{
    private $productModel;
    private $productCategoryModel;

    public function __construct()
    {
        $this->loadModel("ProductModel");
        $this->productModel = new ProductModel;
        $this->loadModel("ProductCategoryModel");
        $this->productCategoryModel = new ProductCategoryModel;
    }

    public function index()
    {
        $listProduct = $this->productModel->getAllProducts(limit: 10, order: ["views" => "desc"]);


        return $this->view(
            "home.index",
            [
                "listProduct" => $listProduct,
                "pageTitle" => "Trang chủ"
            ]
        );
    }
}