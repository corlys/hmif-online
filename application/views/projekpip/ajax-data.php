<?php if (!empty($posts)) : ?>
    <?php foreach ($posts as $row) : ?>
        <div class="card horizontal">
            <div class="card-image">
                <img src="https://lorempixel.com/100/190/nature/6">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <span class="card-title"><?= $row['nama_repo']; ?></span>
                    <p><?= $row['description']; ?></p>
                </div>
                <div class="card-action">
                    <a href="#">This is a link</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h1>Post Not Found</h1>
<?php endif; ?>
<?= $this->ajax_pagination->create_links(); ?>