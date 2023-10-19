<?php

class BlogModel extends BaseModel
{
    const POST_TABLE = 'blog_posts';
    const POST_CMT_TABLE = 'post_comments';
    const POST_CAT_TABLE = 'post_categories';
    const USER_TABLE = 'users';

    public function getAllPost($order = ['publish_date' => 'asc'])
    {
        return $this->getTwoTable(table1: self::POST_TABLE, table2: self::USER_TABLE, joinColumn: 'user_id',
            table1Select: [
                'post_id',
                'title',
                'content',
                'short_content',
                'publish_date',
                'thumbnail_path',
                'category_id',
            ], table2Select: [
                'username',
                'fullname'
            ], order: $order);
    }

    public function getAllPostOfCategory($category_id, $order = ['publish_date' => 'asc'])
    {
        return $this->getTwoTable(table1: self::POST_TABLE, table2: self::USER_TABLE, joinColumn: 'user_id',
            table1Select: [
                'post_id',
                'title',
                'content',
                'short_content',
                'publish_date',
                'thumbnail_path',
                'category_id',
            ], table2Select: [
                'username',
                'fullname'
            ], order: $order, conditions: [
                'category_id' => $category_id,
            ]);
    }

    public function getAllBlogCategories()
    {
        return $this->getAll(table: self::POST_CAT_TABLE);
    }

    public function getPostDetails($post_id = null)
    {
        if ($post_id != null) {
            return $this->getTwoTable(table1: self::POST_TABLE, table2: self::POST_CAT_TABLE, joinColumn: 'category_id',
                table1Select: [
                    'post_id',
                    'title',
                    'content',
                    'publish_date',
                    'category_id',
                    'thumbnail_path',
                    'short_content'
                ],
                table2Select: [
                    'category_name',
                ], conditions: [
                    'post_id' => $post_id
                ])[0];
        } else {
            return $this->getTwoTable(table1: self::POST_TABLE, table2: self::USER_TABLE, joinColumn: 'user_id',
                table1Select: [
                    'post_id',
                    'title',
                    'content',
                    'publish_date',
                    'category_id',
                    'thumbnail_path',
                    'short_content'
                ],
                table2Select: [
                    'username',
                ]);
        }
    }

    public function createPost($title, $content, $short_content, $user_id, $category_id, $thumbnail_path)
    {
        $this->insert(self::POST_TABLE, [
            'title' => $title,
            'content' => $content,
            'short_content' => $short_content,
            'user_id' => $user_id,
            'category_id' => $category_id,
            'thumbnail_path' => $thumbnail_path['post_thumbnail']['name']
        ]);
        return $this->findPostByTitle($title);
    }

    public function deletePost($post_id)
    {
        $this->delete(table: self::POST_TABLE, conditions: [
            'post_id' => $post_id
        ]);
    }

    public function updatePost($post_id, $title, $content, $short_content, $category_id, $thumbnail_path)
    {
        $updateData = [
            'title' => $title,
            'content' => $content,
            'short_content' => $short_content,
            'category_id' => $category_id,
        ];

        if (!empty($thumbnail_path['post_thumbnail']['name'])) {
            $updateData['thumbnail_path'] = $thumbnail_path['post_thumbnail']['name'];
        }
        return $this->update(self::POST_TABLE, $updateData, [
            'post_id' => $post_id
        ]);
    }

    private function findPostByTitle($title)
    {
        return $this->getOne(table: self::POST_TABLE, conditions: [
            'title' => $title,
        ]);
    }
}