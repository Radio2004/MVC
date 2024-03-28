<?php

use Core\Language;

?>
<form method="post">
    <div>
        <label for="messageName"><?= Language::__('User Name') ?></label>
        <input id="messageName" name="name" value="<?= $fields['name'] ?>">
    </div>
    <div>
        <label for="messageName"><?= Language::__('Title') ?></label>
        <input id="messageName" name="title" value="<?= $fields['title'] ?>">
    </div>
    <div>
        <label for="messageId"><?= Language::__('Message') ?></label>
        <textarea type="text" name="message" id="messageId"><?= $fields['message'] ?></textarea>
    </div>

    <input name="submit" value="<?= Language::__('Save') ?>" type="submit">
</form>
<div>
    <?php foreach($validateErrors as $error): ?>
        <p><?=$error?></p>
    <?php endforeach; ?>
</div>