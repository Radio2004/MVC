<?php

use Core\Language;

?>
<nav class="site-nav">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>"><?= Language::__('Home')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>messages/add"><?= Language::__('Add')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>contacts"><?= Language::__('Contacts')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=BASE_URL?>contacts"><?= Language::__('Not Exists')?></a>
            </li>
        </ul>
    </div>
</nav>
<div class="site-content">
    <div class="container">
        <main>
            <h1><?=$title?></h1>
            <hr>
