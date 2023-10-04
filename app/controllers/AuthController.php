<?php

class AuthController extends BaseController
{

    private $authModel;

    public function __construct()
    {
        $this->loadModel('AuthModel');
        $this->authModel = new AuthModel;
    }

    public function index()
    {
        if ($_SESSION['is_login'] == false) {

            return $this->view('auth.index');
        } else {
            return $this->view('base.log', [
                "status" => "Oops!",
                "status_code" => "404",
                "message" => "Bạn đã đăng nhập rồi!",
                "url_back" => "index.php?url=home",
                "btn_title" =>  "Quay lại trang chủ",
            ]);
        }
    }

    public function logout() {
        $this->authModel->logout();
        return header("Location: index.php?url=auth");
    }
    public function signup()
    {
        // print_r($_REQUEST);
        $fullname = $_REQUEST['fullname'];
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $checkStatusCreateAccount = $this->authModel->createAccount($fullname, $username, $email, $password);
        
        if ($checkStatusCreateAccount == 1) {
            return $this->view('auth.log', [
                'status' => 'Đăng kí thành công',
            ]);
        } else if ($checkStatusCreateAccount == 3) {
            return $this->view('auth.log', [
                'status' => 'Đã tồn tại Email trên hệ thống, vui lòng thử Email khác',
            ]);
        } else if ($checkStatusCreateAccount == 4) {
            return $this->view('auth.log', [
                'status' => 'Đã tồn tại Username này trên hệ thống, vui lòng thử Username khác',
            ]);
        }

    }

    public function signin()
    {
        print_r($_REQUEST);
        $username = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $checkSignIn = $this->authModel->signIn($username, $password);

        if ($checkSignIn) {
            return $this->view('base.log', [
                "status" => "Success!",
                "status_code" => "",
                "message" => "Đăng nhập thành công",
                "url_back" => "index.php?url=home",
                "btn_title" => "Đến trang chủ"
            ]);
        } else {
            return $this->view('base.log', [
                "status" => "Thất bại!",
                "status_code" => "",
                "message" => "Đăng nhập thất bại, vui lòng kiểm tra lại thông tin đăng nhập",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Quay trở lại"
            ]);
        }

    }


}