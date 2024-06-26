<?php
    $isNullCensoreMess = true;
?>

<main>
    <div>
        <form method="post">
            <input type="hidden" name="action" value="addcensore">
            <label>
                <input type="text" name="new-censor" class="border p-2" placeholder="Add New Word">
            </label>
            <button type="submit" class="btn btn-primary">
                Add
            </button>
        </form>
    </div>
    <hr>
    <div class="censorship-container">
    <?php foreach ($getAll as $word): ?>
        <div class="wrapper-censorship d-flex flex-column">
            <p class="text-center border-bottom censorship-word">
                <?= $word['censorship_word'] ?>
            </p>
            <div>
                <h5>Id Messages:</h5>
                <?php foreach ($getCensoreMessages as $message) : ?>

                <?php if ($message['censorship_id'] === $word['censorship_id']) : ?>

                    <?php $isNullCensoreMess = false ?>
                    <a href="<?=BASE_URL?>#message-<?=$message['message_id']?>">Id <?=$message['message_id']?></a>

                <?php endif ?>

                <?php endforeach ?>

                <?php if ($isNullCensoreMess) : ?>
                    <span>Null</span>
                <?php endif ?>
            </div>
            <div class="d-flex justify-content-between border-top pt-2">
                <form method="post">
                    <button class="p-0 border-0">
                        <a class="btn btn-primary messages-link" href="<?=BASE_URL?>censorship/<?=$word['censorship_id']?>/edit">Edit</a>
                    </button>
                </form>
                <form method="post">
                    <input type="hidden" name="action" value="deletecensore">
                    <input type="hidden" name="id" value="<?= $word['censorship_id']?>">
                    <button class="btn btn-secondary">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach ?>
    </div>
</main>