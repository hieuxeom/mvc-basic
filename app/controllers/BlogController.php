<?php

class BlogController extends BaseController
{
    private $blogModel;

    public function __construct()
    {
        $this->loadModel('BlogModel');
        $this->blogModel = new BlogModel;
    }


}