<?php

class BlogController extends BaseController
{
    private $blogModel;

    public function __construct()
    {
        $this->loadModel('BlogModel');
        $this->blogModel = new BlogModel;
    }

    public function index()
    {
        $listBlogCategories = $this->blogModel->getAllBlogCategories();
        $listPost = $this->blogModel->getAllPost(['publish_date' => 'desc']);
        return $this->view('blogs.index', [
            'listCategories' => $listBlogCategories,
            'listPosts' => $listPost,
            'categoryActive' => $_REQUEST['filter'] ?? '0'
        ]);
    }

    public function post()
    {
        if (!isset($_REQUEST['post_id'])) {
            $postDetails = [
                'post_id' => '0',
                'thumbnail_path' => 'demo-banner.png',
            ];
        } else {
            $postDetails = $this->blogModel->getPostDetails($_REQUEST['post_id']);

        }
        return $this->view('blogs.post', [
            'postDetails' => $postDetails,
        ]);
    }

}