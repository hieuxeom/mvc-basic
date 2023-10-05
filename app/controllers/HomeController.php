<?php

class HomeController extends BaseController
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;
        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;
    }

    public function index()
    {
        $listProduct = $this->productModel->getAllProducts(limit: 10, order: ['views' => 'desc']);


        return $this->view(
            'home.index',
            [
                'listProduct' => $listProduct
            ]
        );
    }
}