<?php
class CartModel extends BaseModel
{
    const CART_TABLE = 'carts';
    const ITEM_TABLE = 'cart_items';
    const VOUCHERS_TABLE = 'vouchers';

    const PROD_TABLE = 'products';

    public function getCartItems($user_id)
    {
        $cart_id = $this->getCartActive($user_id)['cart_id'];

        $all = $this->getTwoTable(self::ITEM_TABLE, self::PROD_TABLE, 'product_id', [
            'cart_id',
            'product_id',
            'quantity'
        ], [
            'product_name',
            'price',
            'thumbnail_path'
        ], [
            'cart_id' => $cart_id
        ]);
        // print_r()
        return $all;
    }

    public function addItemToCart($user_id, $prod_id, $quantity)
    {
        $cart_id = $this->getCartActive($user_id)['cart_id'];

        if (!$this->checkItemExists($cart_id, $prod_id)) {
            return $this->insert(self::ITEM_TABLE, [
                'cart_id' => $cart_id,
                'product_id' => $prod_id,
                'quantity' => $quantity
            ]);
        } else {
            return $this->update(self::ITEM_TABLE, [
                'quantity' => $this->getOne(self::ITEM_TABLE, [
                    'cart_id' => $cart_id,
                    'product_id' => $prod_id,
                ], ['quantity'])['quantity'] + $quantity
            ], [
                'cart_id' => $cart_id,
                'product_id' => $prod_id,
            ]);
        }
    }

    public function deleteItemFromCart($user_id, $prod_id)
    {
        $cart_id = $this->getCartActive($user_id)['cart_id'];
        return $this->delete(self::ITEM_TABLE, [
            'product_id' => $prod_id,
            'cart_id' => $cart_id,
        ]);
    }

    public function updateQuantity($cart_id, $prod_id, $quantity)
    {
        return $this->update(self::ITEM_TABLE, [
            'quantity' => $quantity,
        ], [
            'cart_id' => $cart_id,
            'product_id' => $prod_id
        ]);
    }


    public function getCartVoucher($user_id)
    {
        // print_r($this->getCartActive($user_id));
        return $this->getCartActive($user_id)['voucher_code'] ?? null;

    }

    public function addCartVoucher($cart_id, $voucher_code)
    {
        return $this->update(self::CART_TABLE, [
            'voucher_code' => $voucher_code,
        ], [
            'cart_id' => $cart_id,
        ]);

    }

    public function getVoucherInfo($voucher_code)
    {
        return $this->getOne(self::VOUCHERS_TABLE, [
            'code' => $voucher_code,
        ]);
    }

    private function checkItemExists($cart_id, $prod_id)
    {
        $rs = $this->getOne(self::ITEM_TABLE, [
            'cart_id' => $cart_id,
            'product_id' => $prod_id
        ]);

        if (empty($rs)) {
            return false;
        } else {
            return true;
        }
    }


    private function isVoucherValid($voucherData)
    {
        print_r($voucherData);
        // Assuming $voucherData is an associative array with 'valid_from' and 'valid_to' keys
        // and that these keys contain date strings in 'YYYY-MM-DD' format.

        // Get the current date
        $currentDate = date('Y-m-d');

        // Compare the current date with the validity period of the voucher
        if ($currentDate >= $voucherData['valid_from'] && $currentDate <= $voucherData['valid_to']) {
            return true; // Voucher is valid
        } else {
            return false; // Voucher is expired or not yet valid
        }
    }

    private function createCard($user_id)
    {
        $this->insert(self::CART_TABLE, [
            'user_id' => $user_id
        ]);
        return $this->getCartActive($user_id)['cart_id'];
    }
    private function getCartActive($user_id)
    {
        $rs = $this->getOne(self::CART_TABLE, [
            'user_id' => $user_id,
            'status' => 'active'

        ], ['cart_id', 'status', 'voucher_code']);
        if (empty($rs)) {
            return $this->createCard($user_id);
        } else {
            return $rs;
        }
        ;
    }
}


?>