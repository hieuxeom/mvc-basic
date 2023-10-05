<?php
class ProductModel extends BaseModel
{
    const PROD_TABLE = 'products';

    public function getProductInfo($id)
    {
        $value = $this->getOne(self::PROD_TABLE, ['product_id' => $id]);
        return $value;
    }

    public function getAllProducts($limit, $order = [])
    {
        $value = $this->getAll(self::PROD_TABLE, limit: $limit, order: $order);
        return $value;
    }

    public function getIdProduct($prod_name, $category_id)
    {
        $querryProd = $this->getOne(self::PROD_TABLE, [
            'product_name' => $prod_name,
            'category_id' => $category_id
        ]);
        if (empty($querryProd)) {
            return false;
        } else {
            return $querryProd['product_id'];
        }
    }

    public function addProduct($category_id, $prod_name, $prod_desc, $prod_price, $prod_stock, $prod_thumbnail)
    {
        $checkExistProdName = $this->isExistProductName($prod_name, $category_id);

        if (!$checkExistProdName) {
            $validPrice = $this->convertToIntegerAndCheck($prod_price);
            $validStock = $this->convertToIntegerAndCheck($prod_stock);

            if ($validPrice && $validStock) {
                $this->insert(self::PROD_TABLE, [
                    'category_id' => $category_id,
                    'product_name' => $prod_name,
                    'product_description' => $prod_desc,
                    'price' => $prod_price,
                    'stock_quantity' => $prod_stock,
                    'thumbnail_path' => $prod_thumbnail["prod_thumbnail"]["name"]
                ]);
            } else {
                return 0;
            }
            return 1;
        } else {
            return 3;
        }
    }

    public function deleteProduct($product_id) {
        return $this->delete(self::PROD_TABLE, [
            'product_id' => $product_id
        ]);
    }

    public function updateProduct($prod_id, $category_id, $prod_name, $prod_desc, $prod_price, $prod_stock, $prod_thumbnail) 
    {
        if (empty($prod_thumbnail['prod_thumbnail']['name'])) {
            return $this->update(self::PROD_TABLE, [
                'category_id' => $category_id,
                'product_name' => $prod_name,
                'product_description' => $prod_desc,
                'price' => $prod_price,
                'stock_quantity' => $prod_stock,
            ], [
                'product_id' => $prod_id,
            ]);
        } else {
            return $this->update(self::PROD_TABLE, [
                'category_id' => $category_id,
                'product_name' => $prod_name,
                'product_description' => $prod_desc,
                'price' => $prod_price,
                'stock_quantity' => $prod_stock,
                'tumbnail_path' => $prod_thumbnail["prod_thumbnail"]["name"]
            ], [
                'product_id' => $prod_id,
            ]);
        }
        
    }

    public function updateView($prod_id)
    {

        return $this->update(self::PROD_TABLE, [
            'views' => $this->getOne(self::PROD_TABLE, [
                    'product_id' => $prod_id
                ], ['views'])['views'] + 1
        ], [
            'product_id' => $prod_id,
        ]);
    }

    private function isExistProductName($prod_name, $category_id)
    {
        $querryProd = $this->getOne(self::PROD_TABLE, [
            'product_name' => $prod_name,
            'category_id' => $category_id
        ]);
        if (empty($querryProd)) {
            return false;
        } else {
            return true;
        }
    }

    private function convertToIntegerAndCheck($value)
    {
        $integerValue = intval($value);

        if ($integerValue != $value) {
            return null;
        } else if ($integerValue < 0) {
            return null;
        } else {
            return $integerValue;
        }
    }
}
?>