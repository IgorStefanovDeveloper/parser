<?php

namespace App;

class IndexController
{
    public function renderResult(): void
    {
        $parser = new ParserController();
        $userData = $_REQUEST['usedata'] ?? false;
        $userType = $_REQUEST['usetype'] ?? false;
        $types = $_REQUEST['types'] ?? false;

        $images = $parser->parseUrl($_REQUEST['parse'], $userData, $userType, $types);
        include __DIR__ . "/../view/header.php";
        include __DIR__ . "/../view/result.php";
        include __DIR__ . "/../view/footer.php";
    }

    public function renderMain(): void
    {
        $title = "Главная";
        include __DIR__ . "/../view/header.php";
        include __DIR__ . "/../view/main.php";
        include __DIR__ . "/../view/footer.php";
    }
}