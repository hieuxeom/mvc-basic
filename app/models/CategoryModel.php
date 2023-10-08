<?php
class CategoryModel extends BaseModel
{
    const PROD_CAT_TABLE = 'product_categories';

    public function getAllCategories()
    {
        $value = $this->getAll(self::PROD_CAT_TABLE);
        return $value;
    }

    public function getCategoryInfo($category_id)
    {
        $value = $this->getOne(self::PROD_CAT_TABLE, ['category_id' => $category_id]);
        return $value;
    }

    public function getCategoryName($category_id)
    {
        $value = $this->getOne(self::PROD_CAT_TABLE, ['category_id' => $category_id], ['category_name']);
        return $value['category_name'];
    }

    public function addCategory($category_name)
    {
        $checkExistCategoryName = $this->isExistCategoryName($category_name);

        if (!$checkExistCategoryName) {
            $this->insert(self::PROD_CAT_TABLE, [
                'category_name' => $category_name
            ]);
            return 1;
        } else {
            return 2;

        }
    }

    public function deleteCategory($category_id)
    {
        return $this->delete(self::PROD_CAT_TABLE, [
            'category_id' => $category_id
        ]);
    }

    public function updateCategory($category_id, $category_name) {
        return $this->update(self::PROD_CAT_TABLE, [
            'category_name' => $category_name
        ], [
            'category_id' => $category_id
        ]);
    }

    private function isExistCategoryName($category_name)
    {
        $querryProd = $this->getOne(self::PROD_CAT_TABLE, [
            'category_name' => $category_name
        ]);

        if (empty($querryProd)) {
            return false;
        } else {
            return true;
        }
    }

}
?>