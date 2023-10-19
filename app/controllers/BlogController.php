<?php

class BlogController extends BaseController
{
    private $blogModel;

    public function __construct()
    {
        $this->loadModel("BlogModel");
        $this->blogModel = new BlogModel;
    }

    public function index()
    {
        $listBlogCategories = $this->blogModel->getAllBlogCategories();
        if (isset($_REQUEST['filter'])) {
            $listPost = $this->blogModel->getAllPostOfCategory($_REQUEST['filter']);
        } else {

            $listPost = $this->blogModel->getAllPost(["publish_date" => "desc"]);
        }

        $arrayData = [
            "listCategories" => $listBlogCategories,
            "listPosts" => $listPost,
            "categoryActive" => $_REQUEST["filter"] ?? "0",
            "pageTitle" => "Tin tức"
        ];

        return $this->view("blogs.index", $arrayData);
    }

    public function post()
    {
        if (!isset($_REQUEST["post_id"])) {
            $postDetails = [
                "post_id" => "0",
                "thumbnail_path" => "demo-banner.png",
            ];
        } else {
            $postDetails = $this->blogModel->getPostDetails($_REQUEST["post_id"]);

        }

        $arrayData = [
            "postDetails" => $postDetails,
            "pageTitle" => $postDetails["title"],
        ];

        return $this->view("blogs.post", $arrayData);
    }

}