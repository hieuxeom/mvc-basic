<?php
    class CommentController extends BaseController {
        private $commentModel;

        public function __construct() {
            $this->loadModel("CommentModel");
            $this->commentModel = new CommentModel;
        }

        public function create() {
            $checkCreateComment = $this->commentModel->createComment($_REQUEST["prod_id"], $_SESSION["user_id"], $_REQUEST["comment-content"]);
            return header("Location: index.php?url=product/show&id=$_REQUEST[prod_id]");
        }

        public function like() {
            $checkLiked = $this->commentModel->likeComment($_REQUEST["comment_id"], $_SESSION["user_id"], $_REQUEST["prod_id"]);
            return header("Location: index.php?url=product/show&id=$_REQUEST[prod_id]");
        }
    }
?>