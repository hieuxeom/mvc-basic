<?php

class ProfileController extends BaseController
{
    private $profileModel;

    public function __construct()
    {
        $this->loadModel("ProfileModel");
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $arrayData = [];

        if (!isset($_REQUEST["user_id"])) {
            header("Location: index.php?url=profile&user_id=$_SESSION[user_id]");
        }

        if ($_REQUEST["user_id"] != $_SESSION["user_id"]) {
            $arrayData = [
                "status" => "Failed!",
                "message" => "Bạn không thể xem thông tin của người dùng khác",
                "url_back" => "index.php?url=profile&user_id=$_SESSION[user_id]",
                "btn_title" => "Đến trang thông tin của bạn",
            ];
            return $this->view("base.log", $arrayData);
        }

        if (!isset($_SESSION["user_id"])) {
            $arrayData = [
                "status" => "Failed!",
                "message" => "Bạn chưa đăng nhập, hãy đăng nhập để xem thông tin của mình nhé",
                "url_back" => "index.php?url=auth",
                "btn_title" => "Đăng nhập",
            ];
            return $this->view("base.log", $arrayData);
        }


        $userData = $this->profileModel->getUserInfo($_REQUEST["user_id"]);
        $arrayData = [
            "userInfo" => $userData,
        ];
        return $this->view("profiles.index", $arrayData);
    }

    public function update()
    {
        $action = $_REQUEST["action"];
        switch ($action) {
            case "info":
                $checkUpdate = $this->profileModel->changeUserInfo($_SESSION["user_id"], $_REQUEST["username"], $_REQUEST["fullname"], $_REQUEST["email"]);
                $arrayData = [
                    "status" => "Successful!",
                    "message" => "Cập nhật thông tin thành công",
                    "url_back" => "index.php?url=profile&user_id=$_SESSION[user_id]",
                    "btn_title" => "Quay lại trang thông tin",
                ];
                return $this->view("base.log", $arrayData);
            case "pwd":
                print_r($_POST);
                if ($this->profileModel->verifyOldPassword($_SESSION["user_id"], $_POST["old_password"])) {
                    if ($this->profileModel->checkDiffPassword($_SESSION["user_id"], $_POST["new_password"])) {
                        if ($this->profileModel->isMatchPassword($_POST["new_password"], $_POST["re_new_password"])) {
                            $this->profileModel->changePassword($_SESSION["user_id"], $_POST["new_password"]);
                            $arrayData = [
                                "status" => "Successful!",
                                "message" => "Đổi mật khẩu thành công",
                                "url_back" => "index.php?url=profile&user_id=$_SESSION[user_id]",
                                "btn_title" => "Quay lại trang thông tin",
                            ];
                            return $this->view("base.log", $arrayData);
                        } else {
                            $arrayData = [
                                "status" => "Failed",
                                "message" => "Mật khẩu mới không trùng khớp, vui lòng nhập lại",
                                "url_back" => "index.php?url=profile&user_id=$_SESSION[user_id]",
                                "btn_title" => "Quay lại trang thông tin"
                            ];
                        }
                    } else {
                        $arrayData = [
                            "status" => "Failed!",
                            "message" => "Đổi mật khẩu thất bại do mật khẩu mới giống với mật khẩu cũ, vui lòng thử lại với mật khẩu khác!",
                            "url_back" => "index.php?url=profile&user_id=$_SESSION[user_id]",
                            "btn_title" => "Quay lại trang thông tin",
                        ];
                        return $this->view("base.log", $arrayData);
                    }
                } else {
                    $arrayData = [
                        "status" => "Failed!",
                        "message" => "Mật khẩu cũ không đúng",
                        "url_back" => "index.php?url=profile&user_id=$_SESSION[user_id]",
                        "btn_title" => "Quay lại trang thông tin",
                    ];
                    return $this->view("base.log", $arrayData);
                }
        }
    }

    public function password()
    {

    }
}