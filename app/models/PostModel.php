<h1>load post model</h1>
<?php
class PostModel extends BaseModel
{
    const TABLE = 'posts';

    public function createPost($title, $content) {
        echo __METHOD__;
    }

    public function getAllPosts()
    {
        // die($table);
        // return $this->getAll(self::TABLE);
        return $this->getAll(self::TABLE, ['post_id', 'topic_id', 'post_title']);
    }

    public function getPostById($post_id)
    {
        echo __METHOD__;
    }
}
?>