<?php

use Core\Language;

?>
<form method="post">
    <div>
        <label for="new-title"><?=Language::__('Title')?></label>
        <input type="text" id="new-title" name="message-title" placeholder="Title" value="<?=$checkIsExist['title']?>">
    </div>
    <div>
        <label for="new-message"><?=Language::__('Message')?></label>
        <input type="text" id="new-message" name="message-content" placeholder="Message" value="<?=$checkIsExist['message']?>">
    </div>
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