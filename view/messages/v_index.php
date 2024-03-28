<?php use Core\Language;

if ($successText): ?>
    <div class="alert alert-success" role="alert">
        <?= Language::__('The message has been successfully added!') ?>
    </div>
<?php endif; ?>
<ul>
    <?php foreach ($messages as $message): ?>
    <li>
        <label><strong><?= Language::__('Message id') ?>:</strong></label><em><?= $message['id'] ?></em><br>
        <label><strong><?= Language::__('User Name') ?>:</strong></label><em><?= $message['name'] ?></em><br>
        <label><strong><?= Language::__('Title') ?>:</strong></label><em><?= $message['title'] ?></em><br>
        <label><strong><?= Language::__('Message') ?>:</strong></label><em><?= $message['message'] ?></em><br>
        <label><strong><?= Language::__('Created At') ?>:</strong></label><em><?= $message['created_at'] ?></em><br>
        <?php if ($boolResult) : ?>
        <button class="p-0 border-0">
            <a class="btn btn-primary messages-link" href="<?=BASE_URL?>message/<?=$message['id']?>/edit"><?=Language::__('Edit')?></a>
        </button>
        <button class="p-0 border-0">
            <a class="btn btn-secondary messages-link" href="<?=BASE_URL?>message/<?=$message['id']?>/delete"><?=Language::__('Delete')?></a>
        </button>
        <?php endif ?>
        <hr>
    </li>
    <?php endforeach; ?>
</ul>
