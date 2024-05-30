<?php

use Core\Language;

?>
<form method="post">
    <?php foreach ($getData as $key => $item): ?>
        <div>
            <label for="new-<?=$key?>"><?=Language::__(ucfirst($key))?></label>
            <input type="text" id="new-<?=$key?>" name="<?=$key?>" placeholder="Title" value="<?=$item?>">
        </div>
    <?php endforeach ?>
    <div>
        <button class="btn btn-secondary" type="submit" name="yes-edit">
            <?=Language::__('Save')?>
        </button>
        <button class="p-0 border-0">
            <a class="btn btn-primary" href="<?=BASE_URL?>">
                <?=Language::__('Back')?>
            </a>
        </button>
    </div>
</form>