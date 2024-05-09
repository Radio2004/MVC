<main>
    <div>
        <button class="btn btn-primary">
            Add
        </button>
    </div>
    <hr>
    <?php foreach ($getAll as $word): ?>
    <div class="censorship-container">
        <div class="wrapper-censorship d-flex flex-column">
            <p class="text-center border-bottom censorship-word">
                <?= $word['censorship_word'] ?>
            </p>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary">Edit</button>
                <button class="btn btn-secondary">Delete</button>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</main>