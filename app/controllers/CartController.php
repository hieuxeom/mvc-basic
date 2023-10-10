<?php
class CartController extends BaseController
{
    private $cartModel;

    public function __construct()
    {
        $this->loadModel("CartModel");
        $this->cartModel = new CartModel;
    }

    public function index()
    {
        if (isset($_SESSION["user_id"])) {
            $cartVoucher = $this->cartModel->getCartVoucher($_SESSION["user_id"]);
            $voucherInfo = $this->cartModel->getVoucherInfo($cartVoucher);
            $cartItems = $this->cartModel->getCartItems($_SESSION["user_id"]);
            print_r($cartItems);
            $cartDetails = $this->cartModel->getCartActive($_SESSION["user_id"]);
            $arrayData = [
                "cartVoucher" => $cartVoucher,
                "voucherInfo" => $voucherInfo,
                "cartItems" => $cartItems,
                "cartDetails" => $cartDetails,
                "pageTitle" => "Giỏ hàng"
            ];
            return $this->view("cart.index", $arrayData);
        } else {
            $arrayData = [
                "status" => "Error!",
                "status_code" => "",
                "message" => "Đăng nhập để xem giỏ hàng",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Đăng nhập"
            ];
            return $this->view("base.log", $arrayData);
        }
    }

    public function voucher()
    {
        $action = $_REQUEST["action"];
        if ($_POST["voucher_code"] == "") {
            $action = "delete";
        }
        switch ($action) {
            case "add":
                $this->cartModel->addCartVoucher($_POST["cart_id"], $_POST["voucher_code"]);
                return header("Location: index.php?url=cart");
            case "delete":
                $this->cartModel->removeCartVoucher($_POST["cart_id"]);
                return header("Location: index.php?url=cart");
        }
    }

    public function add()
    {
        if (isset($_SESSION["user_id"])) {
            $this->cartModel->addItemToCart($_SESSION["user_id"], $_POST["prod_id"], $_POST["product_amount"]);
            return header("Location: index.php?url=product/show&id=$_POST[prod_id]");
        } else {
            $arrayData = [
                "status" => "Error!",
                "message" => "Đăng nhập để thêm sản phẩm vào giỏ hàng",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Đăng nhập",
            ];
            return $this->view("base.log", $arrayData);
        }
    }

    public function delete()
    {
        $checkDelete = $this->cartModel->deleteItemFromCart($_SESSION["user_id"], $_POST["prod_id"]);
        return header("Location: index.php?url=cart");
    }

    public function update()
    {
        $POST_DATA = json_decode(file_get_contents("php://input"), true);

        $this->cartModel->updateQuantity($POST_DATA["cart_id"], $POST_DATA["prod_id"], $POST_DATA["quantity"]);;
    }
}
?>