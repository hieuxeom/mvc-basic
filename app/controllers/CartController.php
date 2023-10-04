<?php
class CartController extends BaseController
{
    private $cartModel;

    public function __construct()
    {
        $this->loadModel('CartModel');
        $this->cartModel = new CartModel;
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $cartVoucher = $this->cartModel->getCartVoucher($_SESSION['user_id']);
            $voucherInfo = $this->cartModel->getVoucherInfo($cartVoucher);
            $cartItems = $this->cartModel->getCartItems($_SESSION['user_id']);
            return $this->view('cart.index', [
                'cartVoucher' => $cartVoucher,
                'voucherInfo' => $voucherInfo,
                'cartItems' => $cartItems,
            ]);
        } else {
            return $this->view('base.log', [
                'status' => 'Error!',
                'status_code' => '',
                'message' => "Đăng nhập để xem giỏ hàng",
                'url_back' => 'index.php?url=auth',
                'btn_title' => 'Đăng nhập'
            ]);
        }
    }

    public function voucher()
    {
        $action = $_REQUEST['action'];
        switch ($action) {
            case 'add':
                // print_r($_POST);
                $this->cartModel->addCartVoucher($_POST['cart_id'], $_POST['voucher_code']);
                return header("Location: index.php?url=cart");

        }
    }

    public function add()
    {
        $this->cartModel->addItemToCart($_SESSION['user_id'], $_POST['prod_id'], $_POST['product_amount']);
        return header("Location: index.php?url=product/show&id=$_POST[prod_id]");
    }

    public function delete()
    {
        $this->cartModel->deleteItemFromCart($_SESSION['user_id'], $_POST['prod_id']);
        return header("Location: index.php?url=cart");
    }

    public function update()
    {
        $post_data = json_decode(file_get_contents('php://input'),true);
        
        $this->cartModel->updateQuantity($post_data['cart_id'],$post_data['prod_id'], $post_data['quantity'] );

        // $newData = $this->get;

        // return ;
    }
}
?>