<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link href="/dist/styles.css" rel="stylesheet">
    <script src="/dist/bundle.js"></script>
</head>
<body>
<header>
    <div class="container header">
        <a class="header__link" href="/" target="_blank" rel="noopener">
            <img class="header__logo"
                 src="https://static.tildacdn.com/tild3039-3661-4636-b835-313839623532/Intensa_logo_medium_.png"
                 imgfield="img"
                 style="max-width: 150px; width: 150px;"
                 alt="Intensa">
        </a>
        <div class="contact-block header__contact-block">
            <a class="contact-block__contact-link contact-link" href="tel:+79000000000">+7(900)00-00-000</a>
            <a class="contact-block__contact-link contact-link" href="mailto:test@gmail.com">test@gmail.com</a>
        </div>
        <div class="header__text">Приложение для парсинга картинок</div>
    </div>
</header>
<div class="container" id="app">