<?php

use Core\Language;

?>
<div>
    <h2><?=Language::__('Are you sure you want to delete the message?')?></h2>
    <form method="post">
        <button class="btn btn-secondary" type="submit" name="yes-delete"><?=Language::__("Yes, I want to delete")?></button>
    </form>
    <hr>
    <button class="p-0 border-0">
        <a class="btn btn-primary" href="<?=BASE_URL?>"><?=Language::__("No, I don't want to delete")?></a>
    </button>
</div>