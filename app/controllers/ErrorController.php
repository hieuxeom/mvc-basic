<?php
    class ErrorController extends BaseController {
        public function index()
        {
            return $this->view('base.log', [
                "status" => "Oops!",
                "status_code" => "404",
                "message" => "",
                "url_back" => "index.php?url=home",
                "btn_title" =>  "Quay lại trang chủ",
            ]);
        }
    }
?>