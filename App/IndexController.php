<?php

namespace App;

class IndexController
{
    public function renderResult(): void
    {
        $parser = new ParserController();
        $images = $parser->parseUrl($_REQUEST['parse'], $_REQUEST['usedata'], $_REQUEST['usetype'], $_REQUEST['types']);

        include __DIR__ . "/../view/result.php";
    }

    public function renderMain(): void
    {
        $title = "Главная";
        include __DIR__ . "/../view/header.php";
        include __DIR__ . "/../view/main.php";
        include __DIR__ . "/../view/footer.php";
    }
}