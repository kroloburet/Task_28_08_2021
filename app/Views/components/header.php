<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <title><?= $title ?></title>
</head>
<body>

<!--
//////////////////////
// Top navigation
//////////////////////
-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Головна</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/task_1">Тестове завдання 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/task_2">Тестове завдання 2</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--
//////////////////////
// Layout
//////////////////////
-->

<div class="container-fluid layout">

<?php if (isset($aside) && !empty($aside)): ?>
<!--
//////////////////////
// Aside column
//////////////////////
-->

    <aside>
        <div id="aside_links" class="list-group">
            <?php foreach ($aside as $item): ?>
                <a href="<?= $item['src'] ?>" class="list-group-item list-group-item-action"><?= $item['title'] ?>
                <?php if(isset($item['count'])): ?>
                    <span class="badge bg-primary rounded-pill"><?= $item['count'] ?></span>
                <?php endif ?>
                </a>
            <?php endforeach ?>
        </div>
    </aside>
<?php endif ?>

<!--
//////////////////////
// Main column
//////////////////////
-->
    <div id="main_wrapper">
        <main id="main">
            <h1><?= $title ?></h1>
            <hr>
