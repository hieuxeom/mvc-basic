<h1>Post Controller</h1>
<?php

class PostController extends BaseController
{
    private $postModel;

    public function __construct()
    {
        $this -> loadModel('PostModel');
        $this -> postModel = new PostModel;
    }

    public function index()
    {
        echo __METHOD__;
    }

    public function show()
    {
        $post_data = $this->postModel->getAllPosts();

        return $this->view('posts.index', [
            'post_data' => $post_data,
            'page_title' => "Post data"
        ]);
    }

    public function create()
    {
        echo __METHOD__;
    }
}