<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <link rel="stylesheet" href="<?= base_url() ?>assets/css/projekpip.css">
    <title>Projek PIP</title>
</head>

<body>
    <header class="App-header">
        <div class="logo"><a href="<?= base_url() ?>projekpip"><span class="thin">projek</span><span class="bold">pip</span></a></div>
        <div class="nav">
            <ul class="nav_links">
                <li><a href="<?= base_url('projekpip') ?>">HOME</a></li>
                <?php if ($this->session->userdata('nim')) : ?>
                    <li><a href="<?= base_url('projekpip/newpost') ?>">POST</a></li>
                    <li><a href="<?= base_url('projekpip/logout') ?>">LOGOUT</a></li>
                <?php else : ?>
                    <li><a href="<?= base_url('projekpip/login') ?>">LOGIN</a></li>
                    <li><a href="<?= base_url('projekpip/register') ?>">REGISTER</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <a class="cta" href="http://hmif.filkom.ub.ac.id/hubungi-kami"><button>Contacts</button></a>
        <a class="menu" onclick="openNav()"><button>Menu</button></a>
    </header>
    <div id="mobile_menu" class="overlay">
        <a class="close" onclick="closeNav()">&times;</a>
        <div class="overlay_content">
            <a href="<?= base_url('projekpip') ?>">HOME</a>
            <?php if ($this->session->userdata('nim')) : ?>
                <a href="<?= base_url('projekpip/newpost') ?>">POST</a>
                <a href="<?= base_url('projekpip/logout') ?>">LOGOUT</a>
            <?php else : ?>
                <a href="<?= base_url('projekpip/login') ?>">LOGIN</a>
                <a href="<?= base_url('projekpip/register') ?>">REGISTER</a>
            <?php endif; ?>
        </div>
    </div>
    <script type="text/javascript">
        function openNav() {
            document.getElementById('mobile_menu').style.width = "100%"
        }

        function closeNav() {
            document.getElementById('mobile_menu').style.width = "0%"
        }
    </script>
    <main class="App">
        <div class="search-wrapper">
            <form id="search-form" action="<?= base_url('projekpip/'); ?>" method="GET">
                <div class="search-bar input-field">
                    <input id="keywords" type="text" class="validate" name="keywords">
                    <label for="keywords">Search Bar</label>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="submit" id="submitform">Search</button>
            </form>
        </div>
        <div class="profile-wrapper">
            <!-- bye bye -->
        </div>
        <div class="projects-wrapper" id="dataList">
            <?php if (empty($posts)) : ?>
                <h3>No Data Found<h3>
                    <?php else : ?>
                        <?php foreach ($posts as $post) : ?>
                            <div class="item-card card horizontal">
                                <!-- <div class="card-image">
                                    <img src="https://lorempixel.com/100/190/nature/6">
                                </div> -->
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <span class="card-title"><?= $post['nama_repo']; ?></span>
                                        <p><?= $post['description']; ?></p>
                                    </div>
                                    <div class="card-action">
                                        <a href="https://github.com/<?= $post['github_name']; ?>/<?= $post['nama_repo']; ?>"><span class="blue-text text-darken-2">Made By <?= $post['github_name']; ?></span></a>
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
        <span id="copyright">2020 © Kabinet Rumah.</span>
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