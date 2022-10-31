<?php

use App\IndexController;

require_once __DIR__ . "/../vendor/autoload.php";

$indexController = new IndexController();
if (isset($_GET['parse'])) {
    $indexController->renderResult();
} else {
    $indexController->renderMain();
}
