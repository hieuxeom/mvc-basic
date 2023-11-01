<?php

class HomeController extends BaseController
{
    private $homeModel;

    public function __construct()
    {
        $this->loadModel("HomeModel");
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        return $this->view(viewPath: "home.index", params: [
            "pageTitle" => "Test title",
            "usersData" => $this->homeModel->getAllUser()
        ]);
    }

}