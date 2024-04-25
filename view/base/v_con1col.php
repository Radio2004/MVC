<?php

use Core\Language;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$controller->getTitle()?></title>
    <link rel="stylesheet" href="<?=BASE_URL?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=BASE_URL?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="<?=BASE_URL?>assets/js/main.js" defer></script>
</head>
<body>
<header class="site-header">
    <div class="container">
        <div class="wrapper-header">
            <div class="logo">
                <div class="logo__title h3">Lesson site</div>
                <div class="logo__subtitle h6">About MVC</div>
                <div class="translate">
                    <p class="translate_switcher"><?=Language::__('Change The Language')?></p>
                    <div class="wrapper-change-ln change-ln-off">
                        <a href="?ln=ua">Ukraine </a>
                        <a href="?ln=pl">Polish</a>
                        <a href="?ln=en">English</a>
                    </div>
                </div>
            </div>
            <div class="wrapper-user d-flex align-items-center position-relative">
                <?php if (isset($_SESSION['user_id'])):?>
                    <p class="name-user"><?=$_SESSION['user_login']?></p>
                    <div class="position-absolute wrapper-user-menu hide">
                        <button class="p-0 border-0 button-logout">
                            <a class="btn btn-info btn-logout" href="<?=BASE_URL?>login?login-exit"><?=Language::__('Logout')?></a>
                        </button>
                    </div>
                <?php else: ?>
                <ul class="d-flex m-0 p-0 nav-user">
                    <li class="nav-user-item">
                        <a class="user-item-link" href="<?=BASE_URL?>register"><?=Language::__('Register')?></a>
                    </li>
                    <li class="nav-user-item">
                        <a class="user-item-link" href="<?=BASE_URL?>login"><?=Language::__('Login')?></a>
                    </li>
                </ul>
                <?php endif ?>
            </div>
        </div>
    </div>
</header>
<nav class="site-nav">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>"><?= Language::__('Home')?></a>
            </li>
            <?php if ($controller->getBoolRole([1,3])): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>messages/add"><?= Language::__('Add')?></a>
            </li>
            <li>
                <a class="nav-link" href="<?=BASE_URL?>censorship"><?= Language::__('Censorship') ?></a>
            </li>
            <?php endif ?>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>contacts"><?= Language::__('Contacts')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>ngfghj"><?= Language::__('Not Exists')?></a>
            </li>
        </ul>
    </div>
</nav>
<div class="site-content">
    <div class="container">
        <main>
            <h1><?=$controller->getTitle()?></h1>
            <hr>
            <?=$controller->getContent()?>
        </main>
    </div>
</div>
<footer class="site-footer">
    <div class="container">
        &copy; MVC site
    </div>
</footer>
<div class='position-fixed d-center bg-subbtle-opacity inset-0 d-none'>
    <div class="wrapper-command-line">
        <h2>
            Administration Terminal
        </h2>
        <form method="post" class='form-command'>
            <textarea name="command-line" class="command-line" cols="100" rows="10"></textarea>
        </form>
    </div>
</div>
</body>
</html>
