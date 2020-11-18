<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://codeseven.github.io/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/pip/css/Projek.css') ?>">
    <title>Projek PIP</title>
</head>

<body>
    <header class="App-header">
        <div class="logo"><span class="thin">projek</span><span class="bold">pip</span></div>
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
    <main>
        <form class="App-form" id="form" action="" method="POST">
            <div class="input-field">
                <input id="repo_name" type="text" class="validate" name="repo_name">
                <label for="repo_name">Nama Repositori</label>
            </div>
            <div class="input-field">
                <textarea id="description" class="materialize-textarea" name="description"></textarea>
                <label for="description">Deskripsi Singkat</label>
            </div>
            <div id="loading">
                <div class="preloader-wrapper small active">
                    <div class="spinner-layer spinner-green-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="post-submit">
                <button type="submit" class="btn btn-primary" name="submit" id="submitform">POST</button>
            </div>
        </form>
    </main>
    <footer class="App-footer">
        <h1>Footer</h1>
    </footer>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.1/dist/sweetalert2.all.min.js"></script>
    <!-- Toastr -->
    <script src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
    <script>
        $(document).ready(function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 2000
            });

            $('#loading').hide();

            $('form').submit(function(e) {
                e.preventDefault();

                $('button[type=submit], input[type=submit]').prop('disabled', true);

                $('.form-group').removeClass('has-error'); // remove the error class
                $('.help-block').remove(); // remove the error text
                $('.alert-success').remove();

                $("#loading").fadeIn("slow");
                var formData = new FormData(this);
                // console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("projekpip/handlenewpost") ?>',
                    data: formData, // data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: true,
                    error: function(data) {
                        alert(data);
                        console.log(data)
                    }

                }).done(function(data) {
                    console.log(data)
                    $("#loading").hide();
                    // $('button[type=submit], input[type=submit]').prop('disabled', false);
                    // grecaptcha.reset();

                    if (!data.success) {

                        Toast.fire({
                            type: 'error',
                            title: data.message ? data.message : "Mohon lengkapi data pada form"
                        });
                        console.log(data)
                        console.log('error di done fucntion')
                    } else {

                        Toast.fire({
                            type: 'success',
                            title: data.message
                        });

                        $("#form").trigger("reset");
                        setInterval(() => {
                            window.location.replace("<?= base_url() ?>projekpip");
                        }, 2000);
                    }
                })

            });
        });
    </script>
</body>

</html>