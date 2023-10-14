<?php

class SearchController extends BaseController
{
    private $searchModel;

    public function __construct()
    {
        $this->loadModel("SearchModel");
        $this->searchModel = new SearchModel;
        $this->loadModel("ProductCategoryModel");
        $this->productCategoryModel = new ProductCategoryModel;
    }

    public function index()
    {
        $keyword = $_REQUEST["keyword"] ?? "";
        $listCategories = $this->productCategoryModel->getAllCategories();
        $resultSearch = $this->searchModel->searchKeyword($keyword);
        $arrayData = [
            "listCategories" => $listCategories,
            "listProducts" => $resultSearch,
            "pageTitle" => "Tìm kiếm: $keyword"
        ];
        return $this->view("search.index", $arrayData);
    }


}

?>