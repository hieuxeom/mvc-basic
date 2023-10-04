<?php

class ProductController extends BaseController
{

    private $productModel;
    private $categoryModel;

    private $commentModel;

    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->productModel = new ProductModel;
        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel;
        $this->loadModel('CommentModel');
        $this->commentModel = new CommentModel;
    }

    public function index()
    {
        return $this->view('product.index');
    }

    public function show()
    {
        $product_id = $_GET['id'];
        $product_info = $this->productModel->getProductInfo($product_id);
        $product_name = $product_info['product_name'];
        $product_description = $product_info['product_description'];
        ;
        $price = $product_info['price'];
        ;
        $category = $product_info['category_id'];
        $thumbnail_path = $product_info['thumbnail_path'];

        // update view
        $this->productModel->updateView($product_id);

        $category_name = $this->categoryModel->getCategoryName($category);

        $list_comments = $this->commentModel->getAllComments($product_id);
        $list_comments_liked = $this->commentModel->getLikeComment($_SESSION['user_id'],$product_id );
        return $this->view('products.index', [
            'product_name' => $product_name,
            'product_description' => $product_description,
            'price' => $price,
            'category' => $category_name,
            'thumbnail_path' => $thumbnail_path,
            'list_comments' => $list_comments,
            'list_comments_liked' => $list_comments_liked,
        ]);
    }

    public function create()
    {
        echo __METHOD__;
    }

}