<?php
class SearchController extends BaseController
{
    private $searchModel;

    public function __construct()
    {
        $this->loadModel('SearchModel');
        $this->searchModel = new SearchModel;
    }

    public function index() {
        $keyword = $_REQUEST['keyword'] ?? "";
        $resultSearch = $this->searchModel->searchKeyword($keyword);
        return $this->view('search.index', [
            'products' => $resultSearch
        ]);
    }


}
?>