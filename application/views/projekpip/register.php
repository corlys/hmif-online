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
        <h1>ProjekPIP</h1>
    </header>
    <main>
        <form class="App-form" id="form" action="" method="POST">
            <div class="input-field">
                <input id="github" type="text" class="validate" name="github">
                <label for="github">GitHub Username</label>
            </div>
            <div class="input-field">
                <input id="nim" type="text" class="validate" name="nim">
                <label for="nim">NIM</label>
            </div>
            <div class="input-field">
                <input id="password_siam" type="password" class="validate" name="password_siam">
                <label for="password_siam">Password</label>
            </div>
            <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div><br>
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
    <!-- google recapthca-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
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
                    url: '<?= base_url("projekpip/registerAuth") ?>',
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
                    grecaptcha.reset();

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
                        }, 3000);
                    }
                })

            });
        });
    </script>
</body>

</html>