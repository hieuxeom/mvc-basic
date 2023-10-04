<?php
class CommentModel extends BaseModel
{
    const PROD_CMT_TABLE = 'product_comments';
    const LIKE_TABLE = 'liked_comments';
    const USER_TABLE = 'users';

    public function createComment($prod_id, $user_id, $comment_text)
    {
        return $this->insert(self::PROD_CMT_TABLE, [
            'product_id' => $prod_id,
            'user_id' => $user_id,
            'comment_text' => $comment_text
        ]);
    }

    public function getAllComments($prod_id)
    {
        return $this->getTwoTable(self::PROD_CMT_TABLE, self::USER_TABLE, 'user_id', [
            'comment_id',
            'product_id',
            'user_id',
            'comment_text',
            'likes'], [
            'username',
            'fullname'
        ], [
            'product_id' => $prod_id,
        ], null, ['created_at' => 'desc']);
    }

    public function likeComment($comment_id, $user_id, $product_id)
    {
        if (!$this->checkLiked($comment_id, $user_id, $product_id)) {
            $this->insert(self::LIKE_TABLE, [
                'comment_id' => $comment_id,
                'user_id' => $user_id,
                'product_id' => $product_id
            ]);

            $this->update(self::PROD_CMT_TABLE, [
                'likes' => $this->getOne(self::PROD_CMT_TABLE, [
                        'comment_id' => $comment_id,
                    ], ['likes'])['likes'] + 1,
            ], [
                'comment_id' => $comment_id,
            ]);
            return true;
        } else {
            $this->delete(self::LIKE_TABLE, [
                'comment_id' => $comment_id,
                'user_id' => $user_id,
                'product_id' => $product_id
            ]);

            $this->update(self::PROD_CMT_TABLE, [
                'likes' => $this->getOne(self::PROD_CMT_TABLE, [
                        'comment_id' => $comment_id,
                    ], ['likes'])['likes'] - 1,
            ], [
                'comment_id' => $comment_id,
            ]);
        }
    }

    public function getLikeComment($user_id, $prod_id)
    {
        return $this->getAll(self::LIKE_TABLE, null, ['*'], [
            'user_id' => $user_id,
            'product_id' => $prod_id
        ]);
    }

    private function checkLiked($comment_id, $user_id, $product_id)
    {
        $check = $this->getOne(self::LIKE_TABLE, [
            'comment_id' => $comment_id,
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);

        if (empty($check)) {
            return false;
        } else {
            return true;
        }
    }
}
?>