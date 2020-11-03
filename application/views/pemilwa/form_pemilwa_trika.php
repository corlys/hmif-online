<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/advo/css/pendataan.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://codeseven.github.io/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Pendaftaran Pemilwa</title>

    <style>
        /* .form-group img {

            height: auto;
            width: 220px;
        }

        .card {
            align-content: center;
            align-items: center;
            padding-right: 50px;
            padding-left: 50px;
        } */

        .parent {
            height: auto;
            display: grid;
            place-items: center;
            grid-gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .card-img {
            height: 200px;
            width: 100%;
        }

        .card {
            width: clamp(23ch, 50%, 46ch);
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 1rem;
        }

        h3 {
            margin: 0
        }

        .btn-wrap {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .header2 {
            padding-top: 100px;
        }
    </style>

<body>
    <div class="header2">
        <h4 id="title_calon" style="text-align:center;">Selamat Memilih</h4>
        <h5 style="text-align:center;">NIM</h5>
    </div>


    <!-- <div class="formBox">
        <form id="form" class="tengahin" action="" method="POST">
            <div class="form-group">

                <div class="card-group">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <img class="card-img" src="assets/img/calon1.jpg" alt="Card image cap">

                                <div class="card-body">

                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a><input class="with-gap" name="calon1" type="radio" id="calon1" value="175150207111016" />
                                        <label for="calon1">PILIH</label></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <img class="card-img" src="assets/img/calon1.jpg" alt="Card image cap">

                                <div class="card-body">

                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a><input class="with-gap" name="calon2" type="radio" id="calon2" value="175150207111016" />
                                        <label for="calon2">PILIH</label></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="loading" class="spinner-border text-primary" style="margin-left: 47.5%; margin-bottom: 20px;" role="status">
                <span class="sr-only">Loading...</span>
            </div>

            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" name="submit" id="submitform">VOTE</button>
            </div>
        </form>
    </div> -->

    <div class="formBox">
        <form id="form" class="tengahin" action="" method="POST">
            <div class="parent">
                <div class="card">
                    <h3>Title - Card 1</h3>
                    <p contenteditable>Medium length description with a few more words here.</p>
                    <img class="card-img" src="assets/keluargahmif/rumah/ketua.png" alt="Card image cap">
                    <!-- <input type="hidden" id="calon1" name="calon1" value="1111"> -->
                    <label>
                        <input type="checkbox" class="radio" value="jojo" name="calon" /><span>JoJo</span>
                    </label>
                    <!-- <input type="checkbox" class="radio" value="jojo" name="calon" /> -->
                    <!-- <div class="btn-wrap" style="text-align:center;">
                        <button type="submit" class="btn btn-primary" name="submit">VOTE</button>
                    </div> -->
                </div>

                <div class="card">
                    <h3>Title - Card 2</h3>
                    <p contenteditable>Long Description. Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                    <img class="card-img" src="assets/keluargahmif/rumah/wakil.png" alt="Card image cap">
                    <label>
                        <input type="checkbox" class="radio" value="hisyam" name="calon" /><span>Hisyam</span>
                    </label>
                    <!-- <input type="checkbox" class="radio" value="hisyam" name="calon" /> -->
                    <!-- <input type="hidden" id="calon2" name="calon2" value="2222">

                    <div class="btn-wrap" style="text-align:center;">
                        <button type="submit" class="btn btn-primary" name="submit">VOTE</button>
                    </div> -->
                </div>
            </div>
            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" name="submit" id="submitform">VOTE</button>
            </div>
        </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> -->
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.1/dist/sweetalert2.all.min.js"></script>
    <!-- Toastr -->
    <script src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
    <script>
        $(document).ready(function() {

            $("input:checkbox").on('click', function() {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                } else {
                    $box.prop("checked", false);
                }
            });

            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 2000
            });

            $('#loading').hide();

            $('form').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah anda sudah yakin dengan pilihan anda?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Sudah`,
                    denyButtonText: `Belum`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $('button[type=submit], input[type=submit]').prop('disabled', true);

                        $('.form-group').removeClass('has-error'); // remove the error class
                        $('.help-block').remove(); // remove the error text
                        $('.alert-success').remove();

                        $("#loading").fadeIn("slow");
                        var formData = new FormData(this);
                        // console.log(formData);
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url("pemilwa/vote") ?>',
                            data: formData, // data object
                            dataType: 'json', // what type of data do we expect back from the server
                            encode: true,
                            processData: false,
                            contentType: false,
                            cache: false,
                            async: true,
                            error: function(data) {
                                alert(error);
                            }

                        }).done(function(data) {
                            console.log(data)

                            if (!data.success) {
                                Toast.fire({
                                    type: 'error',
                                    title: data.message
                                });
                            } else {
                                Toast.fire({
                                    type: 'success',
                                    title: data.message
                                });

                                setInterval(() => {
                                    window.location.replace("<?= base_url() ?>");
                                }, 3000);
                            }

                        })
                    } else {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })



            });

        });
    </script>
</body>

</html>