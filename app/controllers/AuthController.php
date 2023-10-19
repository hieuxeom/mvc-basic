<?php

class AuthController extends BaseController
{

    private $authModel;

    public function __construct()
    {
        $this->loadModel("AuthModel");
        $this->authModel = new AuthModel;
    }

    public function index()
    {
        $arrayData = [];
        if ($_SESSION["is_login"] == false) {
            $arrayData = [
                "pageTitle" => "Đăng nhập/Đăng kí"
            ];
            return $this->view("auth.index", $arrayData);
        } else {
            $arrayData = [
                "status" => "Oops!",
                "status_code" => "404",
                "message" => "Bạn đã đăng nhập rồi!",
                "url_back" => "index.php?url=home",
                "btn_title" => "Quay lại trang chủ",
            ];
            return $this->view("base.log", $arrayData);
        }
    }

    public function logout()
    {
        $this->authModel->logout();
        return header("Location: index.php?url=auth");
    }

    public function signup()
    {
        $fullName = $_REQUEST["fullname"];
        $userName = $_REQUEST["username"];
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];

        $checkStatusCreateAccount = $this->authModel->createAccount($fullName, $userName, $email, $password);

        if ($checkStatusCreateAccount == 1) {
            $arrayData = [
                "status" => "Success!",
                "message" => "Đăng kí thành công",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Quay lại"
            ];
            return $this->view("base.log", $arrayData);
        } else if ($checkStatusCreateAccount == 3) {
            $arrayData = [
                "status" => "Failed!",
                "message" => "Đã tồn tại Email trên hệ thống, vui lòng thử lại với Email khác",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Quay lại"
            ];
            return $this->view("base.log", $arrayData);
        } else if ($checkStatusCreateAccount == 4) {
            $arrayData = [
                "status" => "Failed!",
                "message" => "Đã tồn tại Username này trên hệ thống, vui lòng thử Username khác",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Quay lại"
            ];
            return $this->view("base.log", $arrayData);
        }

    }

    public function signin()
    {
        $userName = $_REQUEST["email"];
        $password = $_REQUEST["password"];

        $checkSignIn = $this->authModel->signIn($userName, $password);

        if ($checkSignIn) {
            return $this->view("base.log", [
                "status" => "Success!",
                "status_code" => "",
                "message" => "Đăng nhập thành công",
                "url_back" => "index.php?url=home",
                "btn_title" => "Đến trang chủ"
            ]);
        } else {
            return $this->view("base.log", [
                "status" => "Thất bại!",
                "status_code" => "",
                "message" => "Đăng nhập thất bại, vui lòng kiểm tra lại thông tin đăng nhập",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Quay trở lại"
            ]);
        }

    }


}