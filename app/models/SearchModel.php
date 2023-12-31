<?php
    class SearchModel extends BaseModel {
        const PRODUCT_TABLE = 'products';
        public function searchKeyword($keyword)
        {
            return $this->getAll(self::PRODUCT_TABLE, null, ['*'], [], null, [
                'product_name' => $keyword,
            ]);
        }      
    }
?>