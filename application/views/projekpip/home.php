<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <link rel="stylesheet" href="<?= base_url('assets/pip/css/Projek.css') ?>">
    <title>Projek PIP</title>
</head>

<body>
    <header class="App-header">
        <h1>ProjekPIP</h1>
        <h1><?= $total_rows; ?> projects ...</h1>
    </header>
    <main class="App">
        <div class="search-wrapper">
            <form action="<?= base_url('projekpip/'); ?>" method="GET">
                <div class="input-field">
                    <input id="keywords" type="text" class="validate" name="keywords">
                    <label for="keywords">Search Bar</label>
                </div>
                <div id="post-submit">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit" id="submitform">Search</button>
                </div>
            </form>
        </div>
        <div class="profile-wrapper">
            <div id="profile-card" class="card">
                <div class="card-content">
                    <?php if ($this->session->userdata('nim')) : ?>
                        <span class="card-title">Welcome, <?= $this->session->userdata('github_name'); ?></span>
                    <?php else : ?>
                        <span class="card-title">Welcome, Anon</span>
                    <?php endif; ?>
                </div>
                <div class="card-action">
                    <?php if ($this->session->userdata('nim')) : ?>
                        <a href="<?= base_url('projekpip/newpost') ?>">POST</a>
                        <a href="<?= base_url('projekpip/logout') ?>">Logout</a>
                    <?php else : ?>
                        <a href="<?= base_url('projekpip/login') ?>">Login</a>
                        <a href="<?= base_url('projekpip/register') ?>">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="projects-wrapper" id="dataList">
            <?php if (empty($posts)) : ?>
                <h3>No Data Found<h3>
                    <?php else : ?>
                        <?php foreach ($posts as $post) : ?>
                            <div class="card horizontal">
                                <div class="card-image">
                                    <img src="https://lorempixel.com/100/190/nature/6">
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <span class="card-title"><?= $post['nama_repo']; ?></span>
                                        <p><?= $post['description']; ?></p>
                                    </div>
                                    <div class="card-action">
                                        <a href="https://github.com/<?= $post['github_name']; ?>/<?= $post['nama_repo']; ?>">Made By <?= $post['github_name']; ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
        </div>
        <div class="pagination-wrapper">
            <?= $this->pagination->create_links(); ?>
        </div>
        <!-- Loading Image -->
        <!-- <div class="loading" style="display: none;">
            <div class="content"><img src="<?php echo base_url('assets/images/loading.gif'); ?>" /></div>
        </div> -->

    </main>
    <footer class="App-footer">
        <h1>Footer</h1>
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        function searchFilter(page_num) {
            page_num = page_num ? page_num : 0;
            var keywords = $('#keywords').val();
            var sortBy = $('#sortBy').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('projekpip/ajaxPaginationData/'); ?>',
                data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function(html) {
                    $('#dataList').html(html);
                    $('.loading').fadeOut("slow");
                }
            });
        };
    </script>
    <script>
        $(document).ready(function() {

            $('select').formSelect();


        });
    </script>
</body>

</html>