<?php
require_once './config/config.php';
require_once './app/core/Database.php';
require_once './app/controllers/BaseController.php';
require_once './app/models/BaseModel.php';


session_start();

if (!isset($_SESSION['is_login'])) {
    $_SESSION['is_login'] = false;
}


// Parse the URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = explode('/', $url);

// Load the appropriate controller and execute the action
$controllerName = ucfirst($url[0]) . 'Controller';
$controllerFile = './app/controllers/' . $controllerName . '.php';



if ($controllerName == 'AuthController') {
    require_once './app/views/base/auth_header.php';
} else {
    require_once './app/views/base/header.php';
}


if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();

    $action = isset($url[1]) ? $url[1] : 'index';

    if (method_exists($controller, $action)) {
        $controller->{$action}();
    } else {
        showError();
    }
} else {

    showError();
}

if ($controllerName == 'AuthController') {
    require_once './app/views/base/auth_footer.php';
} else {
    require_once './app/views/base/footer.php';
}

function showError()
{
    $controllerError = 'ErrorController';
    $controllerErrorFile = './app/controllers/' . $controllerError . '.php';
    require_once $controllerErrorFile;
    $action = 'index';
    $controller = new $controllerError();
    $controller->{$action}();
}