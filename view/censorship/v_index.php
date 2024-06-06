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
            <div class="d-flex justify-content-between">
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